<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\FrontBlogRequest;

class FrontBlogController extends Controller
{
    /** @var Article */
    protected $article;

    // 1ページ当たりの表示件数
    const NUM_PER_PAGE = 5;

    function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * ブログトップページ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(FrontBlogRequest $request)
    {
        // パラメータを取得
        $input = $request->input();

        // ブログ記事一覧を取得
        $list = $this->article->getArticleList(self::NUM_PER_PAGE, $input);
        // ページネーションリンクにクエリストリングを付け加える
        $list->appends($input);
        // 月別アーカイブの対象月リストを取得
        $month_list = $this->article->getMonthList();
        return view('front-blog.index', compact('list', 'month_list'));
    }
}

