<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Game;
use App\Models\GameComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function index() {
        $comments = \VideoCommentView::
        withCount('childs')
        ->with(['childs' => function($q) {
            return $q->limit(5);
        } ])
        ->paginate();
        return MetaResponse::success([
            'comments' => $comments
        ]);
    }

    public function reply() {
        $comment = \VideoCommentView::first();
        $reply = \VideoCommentView::paginate();
        return MetaResponse::success([
            'comment' => $comment,
            'reply' => $reply,
        ]);
    }



    // Creat a new comment on the post or game
    public function post_comment(Request $request, $id)
    {
        $post = Post::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
            ],
        );

        if ($validator->fails()) {
            return redirect("/blog/$post->slug#comments")->withErrors($validator);
        }

        $data = [
            'message' => $request->message,
            'parent' => '0',
            'post_id' => $request->id,
        ];

        if (Auth::check()) {
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['user_id'] = Auth::user()->id;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        Comment::create($data);
        return redirect("/blog/$post->slug#comments")->with('success', 'Comment has been send!');
    }

    public function post_reply(Request $request, $id)
    {
        $post = Post::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
            ],
        );

        if ($validator->fails()) {
            return redirect("/blog/$post->slug#comments")->withErrors($validator);
        }

        $data = [
            'message' => $request->message,
            'parent' => $request->parent,
            'post_id' => $request->id,
        ];

        if (Auth::check()) {
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['user_id'] = Auth::user()->id;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        Comment::create($data);
        return redirect("/blog/$post->slug#comments")->with('success', 'Replies comment has been send!');
    }

    public function game_comment(Request $request, $id)
    {
        $game = Game::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
            ],
        );

        if ($validator->fails()) {
            return redirect("/game/$game->slug#comments")->withErrors($validator);
        }

        $data = [
            'message' => $request->message,
            'parent' => '0',
            'game_id' => $request->id,
        ];

        if (Auth::check()) {
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['user_id'] = Auth::user()->id;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        // return response()->json($data);
        GameComment::create($data);
        return redirect("/game/$game->slug#comments")->with('success', 'Comment has been send!');
    }

    public function game_reply(Request $request, $id)
    {
        $game = Game::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
            ],
        );

        if ($validator->fails()) {
            return redirect("/game/$game->slug#comments")->withErrors($validator);
        }

        $data = [
            'message' => $request->message,
            'parent' => $request->parent,
            'game_id' => $request->id,
        ];

        if (Auth::check()) {
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['user_id'] = Auth::user()->id;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        // return response()->json($data);
        GameComment::create($data);
        return redirect("/game/$game->slug#comments")->with('success', 'Replies comment has been send!');
    }
}
