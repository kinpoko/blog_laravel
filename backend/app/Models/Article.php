<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    // 対象テーブルのプライマリキーのカラム名を指定する。デフォルトは 'id' というカラム名が想定されている。
    protected $primaryKey = 'article_id';

    // 「複数代入」を利用するときに指定する。追加・編集可能なカラム名のみを指定する。
    // $guarded プロパティを利用すると、逆に、追加・編集不可能なカラムを指定できる。
    protected $fillable = ['post_date', 'title', 'body'];

    // SoftDeletes トレイトを使う
    use SoftDeletes;

    // $dates プロパティには、日時が入るカラムを設定する（日付ミューテタ）
    // そうすると、その値が自動的に Carbon インスタンスに変換される
    protected $dates = ['post_date', 'created_at', 'updated_at', 'deleted_at'];

    public function getPostDateTextAttribute()
    {
        // アクセサを定義しておくと $article->post_date_text という
        // プロパティにアクセスしたときに、このメソッドの返り値が返る
        // 'post_date' は $dates プロパティに設定してあるので、自動的に Carbon インスタンスとなる
        return $this->post_date->format('Y/m/d');
    }

    public function setPostDateAttribute($value)
    {
        // ミューテタはプロパティに設定しようとする値を受け取って加工する
        // そして加工したものを Eloquent モデルの $attributes プロパティに設定する
        // 例えば $article->post_date = '2018/07/07' とすると、
        // このメソッドが自動的に呼び出され、引数 $value には '2018/07/07' が渡されます
        // 今回はDBに入れることのできる YYYY-MM-DD のフォーマットにする
        $post_date = new Carbon($value);
        $this->attributes['post_date'] = $post_date->format('Y-m-d');
    }

    public function getArticleList($num_per_page = 10)
    {
        // Eloquent モデルはクエリビルダとしても動作するので、orderBy メソッドも paginate メソッドも利用できる
        // paginate メソッドを使うと、ページネーションに必要な全件数の取得やオフセットの指定などは全部やってくれる
        return $this->orderBy('article_id', 'desc')->paginate($num_per_page);
    }
}
