<?php

namespace App\Http\Controllers;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{

	function upload(Request $request){
		$request->validate([
			'image' => 'required|file|image|mimes:png,jpeg'
		]);
		$upload_image = $request->file('image');
	
		if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			//画像の保存に成功したらDBに記録する
			if($path){
				UploadImage::create([
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
				
			}
		}
		$message = ($path) ? '画像を保存しました' : '画像の保存に失敗しました。';
		return redirect()->route('image_list')->with('message', $message);
		
	}

	function delete(Request $request){
		$delete_image = UploadImage::find($request->image_id);
		
		$delete_image_path = $delete_image->file_path;
		Storage::delete('public/'. $delete_image_path);
		$delete_image->delete();
		$message = ($delete_image_path) ? '画像を削除しました' : '画像の削除に失敗しました。';
		return redirect()->route('image_list')->with('message', $message);
		
	}
}
