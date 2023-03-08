<?php

use App\Http\Controllers\Auth\SocialiteController as AuthSocialiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ContestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\UserController;
use App\Models\Contest;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Game;
use App\Models\Post;
use Illuminate\Routing\RouteRegistrar;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|ko
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HomeController=====================================================================================================
Route::controller(OrderController::class)->group(function () {
    // Home index
    Route::get('/', [HomeController::class, 'home_index'])->name('home.index');

    // Game index
    Route::get('/game', [HomeController::class, 'game_index'])->name('game.index');
    // Game detail
    Route::get('/game/{slug}', [HomeController::class, 'game_detail']);
    // Game berdasarkan genre
    Route::get('/game/genre/{genre:slug}', [HomeController::class, 'game_genre']);

    // Blog index
    Route::get('/blog', [HomeController::class, 'blog_index'])->name('blog.index');
    // Blog single/detail
    Route::get('/blog/{slug}', [HomeController::class, 'blog_detail']);

    // Blog post berdasarkan category
    Route::get('/blog/category/{category:slug}', [HomeController::class, 'blog_category']);
    // Blog post berdasarkan tag
    Route::get('/blog/tag/{tag:slug}', [HomeController::class, 'blog_tag']);

    // Talent =================================================================================
    // View Index
    Route::get('/talent', [HomeController::class, 'talent_index'])->name('talent.index');
    // View Talent Profile
    Route::get('/talent/{slug}', [HomeController::class, 'talent_profile'])->name('talent.profile');
    // Profile Album
    Route::get('/talent/{slug}/album/{album}', [HomeController::class, 'talent_album'])->name('talent.album');

    // /Talent =================================================================================

    // Pages
    Route::get('/about', [HomeController::class, 'about_index']);
    // /Pages
    // Contact
    Route::get('/contact', [HomeController::class, 'contact_index']);
    // Create Messages
    Route::post('/contact/message', [HomeController::class, 'message_create'])->name('create.message');
    // /Contact

    // Pages
    Route::get('/pages/{slug}', [HomeController::class, 'pages_detail'])->name('pages.detail');

    // Contest Home
    Route::get('/contest', [HomeController::class, 'contest_index']);
    Route::get('/contest/{slug}', [HomeController::class, 'contest_detail']);
    // Comments Contest
    Route::post('/contest/store/comments', [HomeController::class, 'contest_comment'])->name('comments.contest');
});
// end HomeController=====================================================================================================

// CommentController=====================================================================================================
Route::controller(OrderController::class)->group(function () {
    // Store Post Comment
    Route::post('/post/{id}/comment', [CommentController::class, 'post_comment']);
    // Reply post comment
    Route::post('/post/{id}/reply', [CommentController::class, 'post_reply']);

    // Store Game Comment
    Route::post('/game/{id}/comment', [CommentController::class, 'game_comment']);
    // Reply Game comment
    Route::post('/game/{id}/reply', [CommentController::class, 'game_reply']);
});

// Sign-in with google
Route::get('/sign-in-google', [UserController::class, 'auth_google'])->name('auth.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('auth.google.callback');



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Setting management
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');

    // Middleware is Admin
    Route::middleware(['is_admin'])->group(function () {
        // Message index
        Route::get('/message', [DashboardController::class, 'message'])->name('message');

        // Configs pages
        Route::get('/config', [DashboardController::class, 'config'])->name('config');
        // Apps pages
        Route::get('/config/app', [ConfigController::class, 'app'])->name('app');
        // Apps update
        Route::patch('/config/app/update', [ConfigController::class, 'app_update'])->name('app.update');

        // Hero Edit
        Route::get('/config/hero/{id}', [ConfigController::class, 'hero_edit']);
        // Hero update
        Route::patch('/config/hero/update/{id}', [ConfigController::class, 'hero_update'])->name('hero.update');

        // Social Media Pages
        Route::get('/config/social-media', [ConfigController::class, 'social_media'])->name('social_media');
        // Social media update
        Route::patch('/config/social-media/update', [ConfigController::class, 'social_media_update'])->name('social.media.update');

        // Contact pages
        Route::get('/config/contact', [ConfigController::class, 'contact'])->name('contact');
        // Contact update
        Route::patch('/config/contact/update', [ConfigController::class, 'contact_update'])->name('contact.update');

        // Confirmasi pesan
        Route::patch('/message/{id}', [MessageController::class, 'update']);

        // Pages management
        Route::get('/pages', [DashboardController::class, 'pages'])->name('pages');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
        // Pages edit
        Route::get('/pages/{slug}/edit', [PageController::class, 'edit']);
        // Update pages
        Route::patch('/pages/{id}', [PageController::class, 'update']);
        Route::delete('/pages/{id}/delete', [PageController::class, 'destroy'])->name('pages.delete');
        // End Pages management

    });

    // Filemanager
    Route::group(['prefix' => 'laravel-filemanager',], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    // Fitur Talent
    // Index view utama talent dashboard
    Route::get('/talent/{slug}', [TalentController::class, 'index']);
    // Select Country
    Route::get('/select/country', [TalentController::class, 'countrySelect'])->name('select.country');
    // Select Skill
    Route::get('/select/skill', [TalentController::class, 'skillSelect'])->name('select.skill');
    // First user & Lengkapi Talent
    Route::patch('/talent/store/{id}', [TalentController::class, 'talent_update'])->name('talent.update');
    // Edit view Talent
    Route::get('/talent/{slug}/edit', [TalentController::class, 'talent_edit'])->name('talent.edit');

    // Skill !!!======================================================
    // Create Skill
    Route::get('/skill/create', [TalentController::class, 'skill_create'])->name('skill.create');
    // Store SKill
    Route::post('/skill/store', [TalentController::class, 'skill_store'])->name('skill.store');
    // Delete Skill
    Route::delete('/skill/{id}/delete', [TalentController::class, 'skill_destroy'])->name('skill.destroy');

    // Notice !!!======================================================
    Route::get('/talent/notice/create', [NoticeController::class, 'create'])->name('notice.create');
    // Store Notice
    Route::post('/talent/notice/store', [NoticeController::class, 'store'])->name('notice.store');
    // Edit view notice
    Route::get('/talent/notice/{id}', [NoticeController::class, 'edit'])->name('notice.edit');
    // Update Notice
    Route::patch('/talent/notice/{id}/update', [NoticeController::class, 'update'])->name('notice.update');
    // Delete Notice
    Route::delete('/talent/notice/{id}/delete', [NoticeController::class, 'destroy'])->name('notice.destroy');
    // Show all notice
    Route::get('/talent/notice/show/{slug}', [NoticeController::class, 'show'])->name('notice.all');

    // Gallery !!!======================================================
    Route::get('/talent/gallery/create', [GalleryController::class, 'create'])->name('gallery.notice');
    // Store Photo
    Route::post('/talent/photo/store', [GalleryController::class, 'store'])->name('photo.store');
    // Delete Photo
    Route::delete('/talent/photo/{id}/delete', [GalleryController::class, 'destroy'])->name('photo.destroy');
    // Show all gallery
    Route::get('/talent/gallery/show/{slug}', [GalleryController::class, 'show'])->name('gallery.all');

    // Album=====
    Route::post('/talent/gallery/album/create', [GalleryController::class, 'newAlbum'])->name('new.album');

    // Store or Create Skills
    Route::post('/store/skill', [TalentController::class, 'store_skill'])->name('store.skill');
    // Store Profile
    Route::post('/store/profile', [TalentController::class, 'store_profile'])->name('store.profile');
    // End- Fitur Talent


    // show all categories
    Route::get('/category', [CategoryController::class, 'index']);
    // store categories
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    // edit categories
    Route::get('/category/{slug}/edit', [CategoryController::class, 'edit']);
    // update categories
    Route::patch('/category/{slug}', [CategoryController::class, 'update']);
    // delete categories
    Route::delete('/category/{slug}', [CategoryController::class, 'destroy']);

    // show all tags
    Route::get('/tag', [TagController::class, 'index']);
    // store tag
    Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
    // edit tag
    Route::get('/tag/{slug}/edit', [TagController::class, 'edit']);
    // update tag
    Route::patch('/tag/{slug}', [TagController::class, 'update']);
    // delete tag
    Route::delete('/tag/{slug}', [TagController::class, 'destroy']);
    // tag select
    Route::get('/tag/select', [TagController::class, 'select'])->name('tags.select');

    // show all posts
    Route::get('/post', [PostController::class, 'index']);
    // create posts
    Route::get('/post/create', [PostController::class, 'create']);
    // store posts
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    // Show detail post
    Route::get('/post/{slug}', [PostController::class, 'show']);
    // edit posts
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    // Update post
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    // Delete post
    Route::delete('post/{id}', [PostController::class, 'destroy']);

    // show all genre
    Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
    // store genre
    Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
    // update genre
    Route::patch('/genre/{id}', [GenreController::class, 'update']);
    // delete genre
    Route::delete('/genre/{slug}', [GenreController::class, 'destroy']);


    // show all game
    Route::get('/game', [GameController::class, 'index']);
    // create game
    Route::get('/game/create', [GameController::class, 'create']);
    // device select
    Route::get('/device/select', [GameController::class, 'select'])->name('devices.select');
    // store game
    Route::post('/game', [GameController::class, 'store'])->name('game.store');
    // show single game
    Route::get('/game/{slug}', [GameController::class, 'show']);
    // edit game
    Route::get('/game/{slug}/edit', [GameController::class, 'edit']);
    // update game
    Route::patch('/game/{id}', [GameController::class, 'update'])->name('game.update');
    // Delete game
    Route::delete('game/{id}', [GameController::class, 'destroy']);

    // User Profile
    // Edit User Profile
    Route::get('/profile/{email}/edit', [UserController::class, 'edit']);
    // Update User Profile
    Route::patch('/profile/{id}', [UserController::class, 'update']);

    // contest Management
    Route::get('/contest', [ContestController::class, 'index'])->name('contest.index');
    Route::get('/contest/create', [ContestController::class, 'create'])->name('contest.create');
    Route::post('/contest/store', [ContestController::class, 'store'])->name('contest.store');
    Route::get('/contest/{slug}/edit', [ContestController::class, 'edit'])->name('contest.edit');
    Route::patch('/contest/{slug}/update', [ContestController::class, 'update'])->name('contest.update');
    Route::delete('/contest/{id}/delete', [ContestController::class, 'destroy'])->name('contest.delete');

    // Select Contest Categories
    Route::get('/contest/tags/select', [ContestController::class, 'select'])->name('contest.tags.select');

    // New Category
    Route::get('/contest/category/create', [ContestController::class, 'categories_create'])->name('contest.category.create');
    Route::post('/contest/category/store', [ContestController::class, 'categories_store'])->name('contest.category.store');
    Route::delete('/contest/category/{id}/delete', [ContestController::class, 'categories_delete'])->name('contest.category.delete');

    // New Tag
    Route::get('/contest/tag/create', [ContestController::class, 'tags_create'])->name('contest.tag.create');
    Route::post('/contest/tag/store', [ContestController::class, 'tags_store'])->name('contest.tag.store');
    Route::delete('/contest/tag/{id}/delete', [ContestController::class, 'tags_delete'])->name('contest.tag.delete');

    // User management
    Route::middleware(['is_admin'])->group(function () {
        // This route
        Route::get('/user', [UserController::class, 'index']);
        // user create
        Route::get('/user/create', [UserController::class, 'create']);
        // user store
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        // Delete user
        Route::delete('user/{id}', [UserController::class, 'destroy']);
    });
    // User edit profile
    Route::get('/user/{email}/edit', [UserController::class, 'edit']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('like', [LikeController::class, 'like'])->name('like');
    Route::delete('like', [LikeController::class, 'unlike'])->name('unlike');
});
