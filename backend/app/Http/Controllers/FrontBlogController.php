<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\FrontBlogRequest;
use App\Models\Category;

class FrontBlogController extends Controller
{
    protected $article;

    const NUM_PER_PAGE = 10;

    function __construct(Article $article, Category $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /*ブログトップページ*/
    function index(FrontBlogRequest $request)
    {
        $input = $request->input();
        $list = $this->article->getArticleList(self::NUM_PER_PAGE, $input);
        $list->appends($input);
        $category_list = $this->category->getCategoryList();
        $month_list = $this->article->getMonthList();
        return view('front-blog.index', compact('list', 'month_list', 'category_list'));
    }

    function showpost($article_id)
    {
        $article = $this->article->find($article_id);
        $category_list = $this->category->getCategoryList();
        $month_list = $this->article->getMonthList();
        return view('front-blog.show',compact('article','month_list', 'category_list'));   
    }
}

