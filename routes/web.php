<?php
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
    Route::get('/body/get','getCompleteBody');
    
});


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
    Route::post('/logout', 'logout');
});
Route::view('/template', 'template');
Route::view('/about','project.about');