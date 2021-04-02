<?php

namespace App\Http\Controllers;
use App\Models\UploadImage;
use Illuminate\Http\Request;

class ImageListController extends Controller
{
    function show(){
		//アップロードした画像を取得
		$uploads = UploadImage::orderBy("id", "desc")->get();

		return view("admin-blog.image-list",[
			"images" => $uploads
		]);
	}
}
