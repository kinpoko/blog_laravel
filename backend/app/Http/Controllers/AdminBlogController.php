<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminBlogRequest;
use App\Models\Article;

class AdminBlogController extends Controller
{
    /** @var Article */
    protected $article;

    function __construct(Article $article)
    {
        $this->article = $article;
    }

    /*ブログ記事入力フォーム*/
    public function form()
    {
        return view('admin_blog.form');
    }

     /*ブログ記事保存処理*/


    public function post(AdminBlogRequest $request)
    {

       
        $input = $request->input();

        $article = $this->article->create($input);

        return redirect()->route('admin_form')->with('message', '記事を保存しました');
    }


}

