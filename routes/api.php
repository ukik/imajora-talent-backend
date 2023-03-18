<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCommentController;
use App\Http\Controllers\Api\ApiGalleryController;
use App\Http\Controllers\Api\ApiGameController;
use App\Http\Controllers\Api\ApiGenreController;
use App\Http\Controllers\Api\ApiNoticeController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiSkillController;
use App\Http\Controllers\Api\ApiTagController;
use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->controller(ApiAuthController::class)->group(function () {
    Route::get('/verify', 'verifyRegistration');
    Route::post('/login', 'login');
    Route::post('/google-callback', 'googleCallback');
    Route::post('/logout', 'logout')->middleware('token.guard');
});

Route::prefix('users')->controller(ApiUserController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});
Route::prefix('blogs')->controller(ApiPostController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});
Route::prefix('games')->controller(ApiGameController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});

Route::prefix('categories')->controller(ApiCategoryController::class)->group(function () {
    Route::get('/', 'index');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});
Route::prefix('genres')->controller(ApiGenreController::class)->group(function () {
    Route::get('/', 'index');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});
Route::prefix('tags')->controller(ApiTagController::class)->group(function () {
    Route::get('/', 'index');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});
Route::prefix('skills')->controller(ApiSkillController::class)->group(function () {
    Route::get('/', 'index');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{slug}', 'update');
        Route::delete('/{slug}', 'destroy');
    });
});

Route::prefix('notices')->controller(ApiNoticeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'showByUser');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});
Route::prefix('galleries')->controller(ApiGalleryController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'showByUser');
    Route::middleware('token.guard')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::prefix('comments')->controller(ApiCommentController::class)->group(function () {
    Route::get('/blog/{slug}', 'listBlogComments');
    Route::get('/game/{slug}', 'listGameComments');
    Route::middleware('token.guard')->group(function () {
        Route::post('/blog/{slug}', 'createBlogComment');
        Route::post('/game/{slug}', 'createGameComment');
        Route::put('/blog/{id}', 'updateBlogComment');
        Route::put('/game/{id}', 'updateGameComment');
        Route::delete('/blog/{id}', 'destroyBlogComment');
        Route::delete('/game/{id}', 'destroyGameComment');
    });
});

Route::prefix('upload')->middleware('token.guard')->group(function () {
    Route::post('/avatar', [ApiUserController::class, 'uploadAvatar']);
    Route::post('/gallery', [ApiGalleryController::class, 'uploadImage']);
});


//
Route::prefix('comments')->controller(CommentsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/reply', 'reply');
    // Route::post('/login', 'login');
    // Route::post('/google-callback', 'googleCallback');
    // Route::post('/logout', 'logout')->middleware('token.guard');
});

// Route::prefix('video/komentar-balasan')->controller(VideoKomentarBalasanController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::get('/{post_id}/{parent_id}', 'komentar');
//     Route::get('/{post_id}/{parent_id}/more', 'komentar_more');
//     Route::post('/{post_id}/{parent_id}/input', 'komentar_input');
//     Route::post('/{id}/delete', 'komentar_delete');
// });




Route::prefix('videoXXXX')->group(function () {
    Route::prefix('')->controller(VideoController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/more', 'komentar_more');
    });

    Route::prefix('/komentar-balasan')->controller(VideoKomentarSemuaController::class)->group(function () {
        // Route::get('/', 'index');
        Route::get('/{post_id}/{parent_id}', 'komentar');
        Route::get('/{post_id}/{parent_id}/more', 'komentar_more');
        Route::post('/{post_id}/{parent_id}/input', 'komentar_input');
        Route::post('/{id}/delete', 'komentar_delete');
    });
});

Route::prefix('audio')->group(function () {
    Route::prefix('')->controller(AudioController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/more', 'komentar_more');
    });
});

Route::prefix('image')->group(function () {
    Route::prefix('')->controller(ImageController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/more', 'komentar_more');
    });
});


Route::prefix('video')->controller(VideoController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/more', 'index');
    Route::post('/follow/{user_id}', 'follow');
    Route::post('/bookmarked/{post_id}', 'bookmarked');
    Route::post('/liked/{post_id}', 'liked');
    Route::post('/comment', 'comment');
    Route::post('/delete/{post_id}', 'delete');
    Route::post('/delete-comment/{post_id}', 'delete_comment');

    Route::get('/komentar-balasan/{id}', 'komentar_balasan');
    Route::get('/komentar-balasan-more/{id}', 'komentar_balasan_more');
    Route::post('/komentar-balasan-comment', 'komentar_balasan_comment');
    Route::post('/komentar-balasan-delete/{id}', 'komentar_balasan_delete');

    Route::get('/komentar-semua/{id}', 'komentar_semua');
    Route::post('/komentar-semua-comment', 'komentar_semua_comment');
    Route::post('/komentar-semua-delete/{id}', 'komentar_semua_delete');

    Route::get('/form/{id}', 'form_edit');
    Route::post('/form/create/{id?}', 'form_create');
    Route::post('/form/delete-cover/{id}', 'form_delete_cover');
    Route::post('/form/delete-media/{id}', 'form_delete_media');
    Route::post('/form/delete/{id}', 'form_delete');
});

