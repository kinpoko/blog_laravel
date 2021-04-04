<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminBlogRequest;
use App\Models\Article;
use Illuminate\Support\Arr;
use App\Models\Category;
use App\Services\Markdown;

class AdminBlogController extends Controller
{
    /** @var Article */
    protected $article;
    /** @var Category */
    protected $category;

    // 1ページ当たりの表示件数
    const NUM_PER_PAGE = 10;

    function __construct(Article $article, Category $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /*ブログ記事入力フォーム*/
    public function form(int $article_id = null)
    {
        $article = $this->article->find($article_id);
        $input = [];
        if ($article) {
            $input = $article->toArray();
            $input['post_date'] = $article->post_date_text;
        } else {
            $article_id = null;
        }
        $input = array_merge($input, old());
        $category_list = $this->category->getCategoryList()->pluck('name', 'category_id');
        return view('admin-blog.form', compact('input', 'article_id', 'category_list'));
    }

     /*ブログ記事保存処理*/
    public function post(AdminBlogRequest $request)
    {
        $input = $request->input();
        $article_id = Arr::get($input, 'article_id');
        $input['body'] = Markdown::parse($input['body']);
        $article = $this->article->updateOrCreate(compact('article_id'), $input);
        return redirect()
        ->route('admin_form', ['article_id' => $article->article_id])
        ->with('message', '記事を保存しました');
    }




    /*ブログ記事削除*/
    public function delete(AdminBlogRequest $request)
    {
        $article_id = $request->input('article_id');
        $result = $this->article->destroy($article_id);
        $message = ($result) ? '記事を削除しました' : '記事の削除に失敗しました。';
        return redirect()->route('admin_list')->with('message', $message);
    }

     /* ブログ記事一覧 */
    public function list()
    {
        $list = $this->article->getArticleList(self::NUM_PER_PAGE);
        return view('admin-blog.list', compact('list'));
    }

    /* カテゴリ一覧画面 */
    public function category()
    {
        $list = $this->category->getCategoryList(self::NUM_PER_PAGE);
        return view('admin-blog.category', compact('list'));
    }

     /*カテゴリ編集・新規作成API */
    public function editCategory(AdminBlogRequest $request)
    {
        $input = $request->input();
        $category_id = $request->input('category_id');
        $category = $this->category->updateOrCreate(compact('category_id'), $input);
        return response()->json($category);
    }

    /* カテゴリ削除API */
    public function deleteCategory(AdminBlogRequest $request)
    {
        $category_id = $request->input('category_id');
        $this->category->destroy($category_id);
        return response()->json();
    }
}

