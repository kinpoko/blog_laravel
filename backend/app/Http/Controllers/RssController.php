<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\FrontBlogRequest;


class RssController extends Controller
{

    const NUM_PER_PAGE = 5;

    function __construct(Article $article)
    {   
        $this->article = $article;
        
    }

    /*ブログトップページ*/
    function index(FrontBlogRequest $request)
    {
        $input = $request->input();
        $list = $this->article->getArticleList(self::NUM_PER_PAGE, $input);
        $list->appends($input);
        $site_url = 'https://kinpokoblog.com';
        $xml_url = 'https://kinpokoblog.com/rss.xml';
        $site_title = 'kinpokoblog';
        $site_description = 'kinpokoのブログ';
        return response()->view('front-blog.rss', compact('list', 'site_url', 'site_title', 'xml_url', 'site_description'))->header('Content-Type', 'text/xml');
    }


  
}

