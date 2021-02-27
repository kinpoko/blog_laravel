<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminBlogRequest;
use App\Models\Article;
use Illuminate\Support\Arr;

class AdminBlogController extends Controller
{
    /** @var Article */
    protected $article;

    function __construct(Article $article)
    {
        $this->article = $article;
    }

    /*ブログ記事入力フォーム*/
    public function form(int $article_id = null)
    {
        // メソッドの引数に指定すれば、ルートパラメータを取得できる

        // Eloquent モデルはクエリビルダとしても動作するので find メソッドで記事データを取得
        // 返り値は null か App\Models\Article Object
        $article = $this->article->find($article_id);

        // 記事データがあれば toArray メソッドで配列にしておき、フォーマットした post_date を入れる
        $input = [];
        if ($article) {
            $input = $article->toArray();
            $input['post_date'] = $article->post_date_text;
        } else {
            $article_id = null;
        }

        // old ヘルパーを使うと、直前のリクエストのフラッシュデータを取得できる
        // ここではバリデートエラーとなったときに、入力していた値を old ヘルパーで取得する
        // DBから取得した値よりも優先して表示するため、array_merge の第二引数に設定する
        $input = array_merge($input, old());

        // View テンプレートへ値を渡すときは、第二引数に連想配列を設定する
        // View テンプレートでは 連想配列のキー名で値を取り出せる
//        return view('admin_blog.form', ['input' => $input, 'article_id' => $article_id]);
        // compact 関数を使うと便利
        return view('admin_blog.form', ['input' => $input, 'article_id' => $article_id]);
    }

     /*ブログ記事保存処理*/


    public function post(AdminBlogRequest $request)
    {

       
        $input = $request->input();

        // array_get ヘルパは配列から指定されたキーの値を取り出すメソッド
        // 指定したキーが存在しない場合のデフォルト値を第三引数に設定できる
        // 指定したキーが存在しなくても、エラーにならずデフォルト値が返るのが便利
        $article_id = Arr::get($input, 'article_id');

        // Eloquent モデルから利用できる updateOrCreate メソッドは、第一引数の値でDBを検索し
        // レコードが見つかったら第二引数の値でそのレコードを更新、見つからなかったら新規作成します
        // ここでは article_id でレコードを検索し、第二引数の入力値でレコードを更新、または新規作成しています
        $article = $this->article->updateOrCreate(compact('article_id'), $input);

        // フォーム画面にリダイレクト。その際、route メソッドの第二引数にパラメータを指定できる
        return redirect()
            ->route('admin_form', ['article_id' => $article->article_id])
            ->with('status', '記事を保存しました');
    }


}

