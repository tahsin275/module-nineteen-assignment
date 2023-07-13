<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('blogpostlist');
});

Route::get('/details', function () {
    return view('detailspost');
});

Route::get('/blogposts', [BlogPostController::class, 'index']);
Route::get('/blogposts/{id}', [BlogPostController::class, 'show']);
Route::post('/storepost', [BlogPostController::class, 'store']);

Route::put('/updateposts/{id}', [BlogPostController::class, 'update']);
Route::delete('/deleteposts/{id}', [BlogPostController::class, 'delete']);
Route::post('/blogposts/{id}/comments', [BlogPostController::class, 'addComment']);
Route::get('/getComment/{id}', [BlogPostController::class, 'getCommentbyId']);
