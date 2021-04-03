# Log
## 2021-04-03 add image uploding 画像アップロード機能追加
### 参考
- https://note.com/laravelstudy/n/n038bd68f53a7
- https://tektektech.com/laravel-view-image-at-public/
### 方法
#### publicディレクトリ下にstorageディレクトリのリンク作成
```
$ php artisan storage:link
```
#### upload_imageテーブル作成
```
$ php artisan make:migration create_upload_image_table
```
テーブルには以下のカラムを設置
1. 元のファイル名:file_name
1. ファイルの保存先:file_path

#### モデル作成
```
php artisan make:model UploadImage
```
`app/Models/UploadImage.php`
```
protected $fillable = ["file_name","file_path"];
```
fillableについて https://note.com/makoto0419/n/nf87bc442601b

#### アップロードフォーム(Controler作成)
```
php artisan make:controller UploadImageController
```
#### (Viewの作成)
`resources/views/upload-form.blade.php`
```
<form 
	method="post"
	action="{{ route('upload_image') }}"
	enctype="multipart/form-data"
>

```
#### アップロード処理
UploadImageControllerのupload()関数
```
$path = $upload_image->store('uploads',"public");
```
これでstoreはpublicストレージ内のuploadsディレクトリに保存しランダムなファイル名になる　これをDBに保存
#### 画像一覧機能(Contorller)
```
$ php artisan make:controller ImageListController
```
#### (View)

### 記事内で使う方法
```
<img src="/storage/uploads/xxxx.jpg"class="img-fluid">
```
### 次
- 画像一覧ページのデザイン

## 2021-04-04 add delete image 画像削除機能追加　画像一覧ページのデザイン修正
### 参考
- https://qiita.com/Charry/items/423cd11c04ea38dad17f
- https://qiita.com/a05kk/items/e05a1508dc562861fcf5
### 方法
`app/Http/Controllers/UploadImageController.php`
```
function delete(Request $request){
		$delete_image = UploadImage::find($request->image_id);
		
		$delete_image_path = $delete_image->file_path;
		Storage::delete('public/'. $delete_image_path);
		$delete_image->delete();
		$message = ($delete_image_path) ? '画像を削除しました' : '画像の削除に失敗しました。';
		return redirect()->route('image_list')->with('message', $message);
		
	}
```
以上追加

ルーティングも指定

POSTメソッドでidを渡してそれで削除する

`resources/views/admin-blog/image-list.blade.php`
```
<form action="{{ route('delete_image') }}" method="POST">
                    			<input type="submit" class="btn btn-primary btn-sm" value="削除">
                    			<input type="hidden" name="image_id" value="{{ $image->id }}">
								@csrf
```
### laravelのデバッグに便利
```
dd()
```
https://qiita.com/a05kk/items/e05a1508dc562861fcf5
