<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Admin dashboard
        $categories = Category::count();
        $tags = Tag::count();
        $posts = Post::count();
        $genres = Genre::count();
        $games = Game::count();
        $messages = Message::query()->latest()->paginate(5);
        $messageWarning = Message::query()->where('status', 'warning')->latest()->paginate(4);

        // User Contribution
        $contributionPost = Auth::user()->posts()->count();
        $contributionGame = Auth::user()->game()->count();
        return view('admin.index', compact('categories', 'tags', 'posts', 'genres', 'games', 'contributionPost', 'contributionGame', 'messages', 'messageWarning'));
    }

    public function setting()
    {

        return view('admin.setting');
    }

    // Pages view
    public function pages()
    {
        $pages = Page::query()->latest()->paginate(5);
        return view('admin.pages.index', compact('pages'));
    }

    public function message()
    {
        $messageWarning = Message::query()->latest()->paginate(5);
        return view('admin.message.index', compact('messageWarning'));
    }

    // Configs view
    public function config()
    {
        $carousel = Carousel::all();
        return view('admin.config.index', compact('carousel'));
    }
}
