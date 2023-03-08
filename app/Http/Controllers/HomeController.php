<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\App;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentContest;
use App\Models\Contact;
use App\Models\Contest;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Message;
use App\Models\Notice;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Post;
use App\Models\SocialMedia;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jorenvh\Share\Share as ShareShare;
use Jorenvh\Share\ShareFacade;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class HomeController extends Controller
{

    // Section Home
    public function home_index()
    {
        $pages = Page::all();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Latest Games
        $latestGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();

        // Configs all
        $app = App::find(1);
        $hero = Carousel::all();

        $talentProfiles = User::where('talent_status', 'active')->get()->all();
        return view('home.index', compact('latestNews', 'latestGames', 'appsNews', 'appsGames', 'app', 'hero', 'talentProfiles', 'pages'));
    }
    // End Section Home

    // Section Game
    public function game_index()
    {
        $pages = Page::all();
        // Random data game
        $games = Game::query()->where('status', 'publish')->inRandomOrder()->paginate(6);
        // Data Genre
        $genres = Genre::all();

        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.game.index', compact('appsNews', 'appsGames', 'latestNews', 'games', 'genres', 'app', 'pages'));
    }

    public function game_detail($slug)
    {
        try {
            $pages = Page::all();
            $game = Game::query()->where('slug', $slug)->first();
            // Data Genre
            $genres = Genre::all();
            // Random data game lainnya
            $games = Game::query()->where('status', 'publish')->inRandomOrder()->paginate(4);

            // Apps data
            $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
            $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
            // Latest News
            $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
            // Configs all
            $app = App::find(1);
            $subTitle = $game->title;

            // Share social links
            $socialShare = ShareFacade::page('https://labsnip.com//game/' . $game->slug, $game->title)
                ->facebook()
                ->twitter()
                ->linkedin('Extra linkedin summary can be passed here')
                ->whatsapp();
            return view('home.game.detail', compact('genres', 'appsNews', 'appsGames', 'latestNews', 'games', 'game', 'app', 'socialShare', 'subTitle', 'pages'));
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function game_genre($slug)
    {
        $pages = Page::all();
        $genre = Genre::where('slug', $slug)->first();
        $games = $genre->games()->where('status', 'publish')->inRandomOrder()->paginate(4);
        $genres = Genre::all();
        $title = $genre->title;

        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.game.genre', compact('genre', 'genres', 'games', 'appsNews', 'appsGames', 'latestNews', 'title', 'app', 'pages'));
    }
    // End Section Game

    // Section Blog
    public function blog_index()
    {
        $pages = Page::all();
        // Data posts berstatus publish
        $posts = Post::query()->where('status', 'publish');
        // fitur search
        if (request('search')) {
            $posts->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $posts = $posts->inRandomOrder()->paginate(4);

        $tags = Tag::all();
        $categories = Category::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.blog.index', compact('appsNews', 'appsGames', 'latestNews', 'posts', 'categories', 'tags', 'search', 'app', 'pages'));
    }

    public function blog_detail($slug)
    {
        try {
            $pages = Page::all();
            $post = Post::where('slug', $slug)->first();

            $search = request('search') ?? '';


            // data seluruh kategori yang tersedia
            $tags = Tag::all();
            $categories = Category::all();
            // Apps data
            $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
            $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
            // Latest News
            $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
            // Configs all
            $app = App::find(1);
            $subTitle = $post->title;

            // Share social links
            $socialShare = ShareFacade::page('https://news.labsnip.com//blog/' . $post->slug, $post->title)
                ->facebook()
                ->twitter()
                ->linkedin('Extra linkedin summary can be passed here')
                ->whatsapp();
            return view('home.blog.detail', compact('post', 'appsNews', 'appsGames', 'latestNews', 'categories', 'search', 'tags', 'app', 'socialShare', 'subTitle', 'pages'));
        } catch (Exception $e) {
            return redirect('/');
        }
    }

    public function blog_comment(Request $request, $slug)
    {

        $post = Post::query()->where('slug', $slug)->first();

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
                'name' => 'required',
                'email' => 'required',
                'message' => 'required|max:255',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
                'name.required' => 'Name not null!',
                'email.required' => 'email not null!',
                'message.required' => 'message not null!',
            ],
        );

        if ($validator->fails()) {
            return redirect('#comments')->withErrors($validator);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'parent' => $request->parent ?? '0',
            'post_id' => $post->id,
        ];
        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        }

        // return response()->json($data);
        Comment::create($data);
        return redirect("/blog/$post->slug#comments")->with('success', 'Komentar berhasil dikirim');
    }

    // blog all comments detail single
    public function blog_comment_all(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();

        $search = request('search') ?? '';

        // data seluruh kategori yang tersedia
        $tags = Tag::all();
        $categories = Category::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.blog.comment', compact('post', 'appsNews', 'appsGames', 'latestNews', 'categories', 'search', 'tags', 'app'));
    }

    public function blog_category($slug)
    {
        $pages = Page::all();
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->where('status', 'publish')->latest()->paginate(4);
        $search = request('search') ?? '';
        // data seluruh kategori yang tersedia
        $tags = Tag::all();
        $categories = Category::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.blog.category', compact('posts', 'category', 'categories', 'appsNews', 'appsGames', 'latestNews', 'search', 'tags', 'app', 'pages'));
    }

    public function blog_tag($slug)
    {
        $pages = Page::all();
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->where('status', 'publish')->latest()->paginate(4);

        // $found = Tag::find($tags->id);
        // $categories = Category::all();
        // $tags = Tag::all();
        $search = request('search') ?? '';
        // data seluruh kategori yang tersedia
        $tags = Tag::all();
        $categories = Category::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        return view('home.blog.tag', compact('search', 'categories', 'tags', 'appsNews', 'appsGames', 'latestNews', 'posts', 'tag', 'app', 'pages'));
    }
    // End Section Blog

    // About
    public function about_index()
    {
        $page = Page::find(1);
        return view('home.about', compact('page'));
    }
    // End About

    // Contact
    public function contact_index()
    {
        $pages = Page::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        $contact = Contact::find(1);
        $sosmed = SocialMedia::find(1);
        return view('home.contact', compact('appsNews', 'appsGames', 'latestNews', 'app', 'contact', 'sosmed', 'pages'));
    }

    public function message_create(Request $request)
    {
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
                'name' => 'required',
                'email' => 'required',
                'message' => 'required|max:255',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
                'name.required' => 'Name not null!',
                'email.required' => 'email not null!',
                'message.required' => 'message not null!',
            ],
        );

        if ($validator->fails()) {
            return redirect('/contact')->withErrors($validator);
        }
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'warning',
        ]);
        return redirect('/contact')->with('success', $request->name);
    }
    // /Contact

    // Talent ========================================================================================
    public function talent_index()
    {
        $pages = Page::all();
        // ========================

        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);

        // Notices Lastest
        $notices = Notice::orderBy('id', 'desc')->limit(6)->get();
        // ========================

        $usersTalent = User::query()->where('talent_status', 'active');

        if (request('search')) {
            $usersTalent->where('name', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $usersTalent = $usersTalent->orderBy('updated_at', 'DESC')->get();

        return view('home.talent.index', compact('appsNews', 'appsGames', 'latestNews', 'app', 'notices', 'usersTalent', 'search', 'pages'));
    }

    public function talent_profile(Request $request, $slug)
    {
        $pages = Page::all();
        // ========================

        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);

        // ========================

        $profile = User::where('slug', $slug)->first();
        // Gallery
        $photos = Photo::where('user_id', $profile->id)->orderBy('id', 'DESC')->get();
        $albums = Album::where('user_id', $profile->id)->get()->all();

        // Notice
        $notices = Notice::where('user_id', $profile->id)->orderBy('id', 'DESC')->get();
        // return response()->json($notices);
        return view('home.talent.profile', compact('appsNews', 'appsGames', 'latestNews', 'app', 'profile', 'photos', 'albums', 'notices', 'pages'));
    }

    // /Talent ========================================================================================

    // Pages====================
    public function pages_detail($slug)
    {
        $pages = Page::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);
        $page = Page::where('slug', $slug)->first();
        // return response()->json($page);
        return view('home.pages.index', compact('page', 'pages', 'appsNews', 'appsGames', 'latestNews', 'app'));
    }

    // Contest ===================================================================
    public function contest_index()
    {
        $pages = Page::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);

        $contests = Contest::orderBy('created_at', 'DESC')->paginate(6);
        $carouselContest = Contest::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home.contest.index', compact('pages', 'appsNews', 'appsGames', 'latestNews', 'app', 'contests', 'carouselContest'));
    }

    public function contest_detail($slug)
    {
        $pages = Page::all();
        // Apps data
        $appsNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        $appsGames = Game::query()->where('status', 'publish')->reorder('id', 'desc')->limit(3)->get();
        // Latest News
        $latestNews = Post::query()->where('status', 'publish')->reorder('id', 'desc')->limit(4)->get();
        // Configs all
        $app = App::find(1);

        $contest = Contest::where('slug', $slug)->first();
        return view('home.contest.detail', compact('pages', 'appsNews', 'appsGames', 'latestNews', 'app', 'contest'));
        // return response()->json($contest);
    }

    public function contest_comment(Request $request)
    {
        $comment = CommentContest::create([
            'user_id' => $request->userId,
            'contest_id' => $request->contestId,
            'message' => $request->message,
        ]);

        $user = User::find($request->userId);

        $data = [
            'name' => $user->name,
            'message' => $request->message,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Comments Success',
            'data' => $data
        ]);
    }

    // End Contest ===============================================================
}
