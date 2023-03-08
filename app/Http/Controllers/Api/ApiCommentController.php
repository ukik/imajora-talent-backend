<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Game;
use App\Models\GameComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

class ApiCommentController extends Controller
{
    public function listBlogComments(Request $request, string $slug)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $comments = Comment::whereRelation('post', 'slug', '=', $slug);
        if ($limit_query) {
            $comments = $comments->take($limit_query);
            if ($page_query) {
                $comments = $comments->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($comments->get());
    }

    public function listGameComments(Request $request, string $slug)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $comments = GameComment::whereRelation('game', 'slug', '=', $slug);
        if ($limit_query) {
            $comments = $comments->take($limit_query);
            if ($page_query) {
                $comments = $comments->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($comments->get());
    }

    public function createBlogComment(Request $request, string $slug)
    {
        $author = $request->user;
        $message = $request->input('message');
        $post = Post::where('slug', '=', $slug)->first();
        if ($post) {
            try {
                $comment = Comment::create([
                    'name' => $author->name,
                    'email' => $author->email,
                    'message' => $message,
                    'user_id' => $author->id,
                    'post_id' => $post->id
                ])->id;
                return MetaResponse::success(['blog_comment' => $comment]);
            } catch (Throwable $error) {
                return MetaResponse::error($error->getMessage());
            }
        } else {
            return MetaResponse::error('Post not found', 404);
        }
    }

    public function createGameComment(Request $request, string $slug)
    {
        $author = $request->user;
        $message = $request->input('message');
        $post = Game::where('slug', '=', $slug)->first();
        if ($post) {
            try {
                $comment = GameComment::create([
                    'name' => $author->name,
                    'email' => $author->email,
                    'message' => $message,
                    'user_id' => $author->id,
                    'game_id' => $post->id
                ])->id;
                return MetaResponse::success(['game_comment' => $comment]);
            } catch (Throwable $error) {
                return MetaResponse::error($error->getMessage());
            }
        } else {
            return MetaResponse::error('Game not found', 404);
        }
    }

    public function updateBlogComment(Request $request, string $id)
    {
        $author = $request->user;
        $message = $request->input('message');
        $comment = Comment::find($id);
        if ($comment) {
            if ($comment->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only comment author or admin can access this api', 401);
            }
            $comment->message = $message ? $message : $comment->message;
            $comment->update();
            return MetaResponse::successWithMsg('updated', ['comment' => $comment]);
        } else {
            return MetaResponse::error('Comment not found', 404);
        }
    }

    public function updateGameComment(Request $request, string $id)
    {
        $message = $request->input('message');
        $comment = GameComment::find($id);
        if ($comment) {
            $author = $request->user;
            if ($comment->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only comment author or admin can access this api', 401);
            }
            $comment->message = $message ? $message : $comment->message;
            $comment->update();
            return MetaResponse::successWithMsg('updated', ['comment' => $comment]);
        } else {
            return MetaResponse::error('Comment not found', 404);
        }
    }

    public function destroyBlogComment(Request $request, string $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $author = $request->user;
            if ($comment->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only comment author or admin can access this api', 401);
            }
            $comment->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Comment not found', 404);
        }
    }

    public function destroyGameComment(Request $request, string $id)
    {
        $comment = GameComment::find($id);
        if ($comment) {
            $author = $request->user;
            if ($comment->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only comment author or admin can access this api', 401);
            }
            $comment->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Comment not found', 404);
        }
    }
}
