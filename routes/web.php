<?php

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\SessionMiddleware;
use App\Http\Middleware\RegisterMiddleware;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\SessionHasMiddleware;



Route::controller(NewsController::class)->group(function(){
    Route::get('/news','index')
        ->middleware(SessionHasMiddleware::class)
        ->name('news');

    Route::post('/form', 'store');
    Route::get('/news/{id}', 'show')
        ->middleware(SessionHasMiddleware::class);
    Route::get('/form', 'redirectForm')
        ->middleware(SessionHasMiddleware::class)
        ->name('form');

    Route::get('/news/edit/{id}', 'edit')
        ->middleware(SessionHasMiddleware::class);
    Route::put('/news/update/{id}','update')
        ->name('news.update');
    Route::delete('/news/delete{id}','destroy')
        ->name('news.destroy');

    Route::get('/user/berita/{id}', 'getAllNews')
        ->middleware(SessionHasMiddleware::class);
    Route::get('/category/{id}','getNewsKategori')
        ->middleware(SessionHasMiddleware::class);
    
    Route::get('/user/news/{id}', 'getNewsUser')
        ->middleware(SessionHasMiddleware::class);

    Route::get('/', 'welcome');
    
});
Route::view('/template', 'template');

// Route::get('/file',function(){
//     Storage::disk('public')->put('image/example.txt', 'Contents');
// });

// Route::view('/coba','contoh');
// Route::post('/here', [UsiaController::class, 'store'])
//     ->middleware(ValidateUsia::class);


Route::controller(RegisterController::class)->group(function(){
    Route::get('/register', 'redirectRegister')
        ->middleware(SessionMiddleware::class);
 
    Route::post('/register','store')
        ->middleware(RegisterMiddleware::class);
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','login')
        ->middleware(SessionMiddleware::class)
        ->name('login');

    Route::post('/login','redirectToNews')
        ->middleware(LoginMiddleware::class);
    Route::delete('/logout', 'logout');
});

// Route::get('/contoh',function(){
//     $users = User::all();
//     // $user = $users->find('muammarirfan213@gmail.com');
//     // $users = User::where('id', 4)->get();
//     // $users = $users->intersect(User::whereIn('id', [5])->get());
//     $email = "muammarirfan213@gmail.com";
//     $nama = "Muammar Irfan";
//     $emailku = User::where('nama', $nama)->get();
    
//     // if(count($emailku) > 0){
//     //     echo 'maaf email sudah ada, harap masukkan email yang lain';
//     // } else{
//     //     echo 'mantap';
//     // }
//     var_dump(count($emailku));

//     // for($i = 0; $i < )
// });

// Route::controller(SessionController::class)->group(function(){
//     Route::get('/session','createSession');
//     Route::get('/session/get','getSession');
//     Route::get('/logout', 'logout');
// });
// Route::view('/session/view', 'session-view');

// Route::get('/db', function(){
//     $users = User::offset(0)->limit(4)->orderby('id', 'DESC')->get();
    
//     foreach($users as $user){
//         echo $user->nama . "<br>";
//         echo $user->email . "<br><br>";
//     }
// });

// Route::get('/user/berita/{id}', function(User $user){
//     return view('news', [
//         'title' => 'Artikel by ' . $user->nama,
//         'news' => $user->news
//     ]);
// });

// Route::get('/users', function(){
//     $users = User::with('newsUser')->get();
//     // foreach($users as $user){
//     //     $user->;
//     // }
//     foreach ($users as $user) {
//         foreach ($user->newsUser as $news) {
//             echo $news->judul . '<br>';
//         }
//     }
// });

// Route::get('/kategory', function(){
//     $categories = Category::all();
//     return view('categories-view', [
//         'categories' => $categories
//     ]);
// });
// Route::get('/category/{id}', function(int $id){
//     $categori = News::where('category_id', $id)->get();
//     return view('session-view', [
//         'category' => $categori
//     ]);
// });



// Route::view('/parent','parent');






Route::view('/landing','project.landing');
Route::view('/about','project.about');


Route::get('/gambar', function(){
    $news = News::all();
    return view('gambar', [
        'news' => $news
    ]);
});