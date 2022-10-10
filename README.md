#### うったコマンド
composer create-project "laravel/laravel=8.*" .
composer require laravel/ui:*
php artisan ui bootstrap --auth
npm install && npm run dev
npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps
npm install && npm run dev

#### app.php
'timezone' => 'Asia/Tokyo',
'locale' => 'ja',

#### 日本語化　zip持ってくる
https://github.com/Laravel-Lang/lang

#### 日本語化　このコマンド打つ
php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"

#### 日本語化確認のためテーブル作る
php artisan migrate // validation.phpを変更するとさらにバリデーションできる
php artisan migrate:rollback

#### RouteServiceProvider.php
protected $namespace = 'App\\Http\\Controllers';
Route::get('/home', [HomeController::class, 'index'])->name('home'); が右のようにかける  Route::get('/home', 'HomeController@index')->name('home');

#### モデルとテーブルを作る
php artisan make:model Task -m
php artisan migrate
php artisan make:model Bookmark -m
php artisan migrate

#### モデルクラスにリレーションを書いた

#### views/task/create.blade.php作成

#### リソースコントローラ作成
php artisan make:controller TaskController --resource
// createメソッド内でviews/task/create.blade.phpを呼び出す。
// ルートの設定
Route::resource('/task', 'TaskController');
// Bootstrap4 Datepickerを設定してカレンダーを設定
参考：https://qiita.com/saka212/items/55670d43f4bf6ef070cd

--- ここまででfirst commit

--- ここから続き
#### TaskModelに$fillableを追加
#### TaskControllerのstoreメソッドを定義
#### バリデーションの定義
#### 画像の保存 シンボリックリンク作成
php artisan storage:link
#### 全部のユーザをusersテーブルから取得して表示するようにした
参考：https://readouble.com/laravel/8.x/ja/queries.html
#### タスク一覧画面の作成
#### サイドバーを作成する
#### 削除と編集作成
--- ここまででsecond commit
