<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Throwable;

class ApiGameController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->query('search');
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $genre_query = $request->query('genre');
        $games = Game::with(['user', 'genre']);
        if ($search_query) {
            $games = $games->where('title', 'LIKE', '%' . $search_query . '%');
        }
        if ($genre_query) {
            $games = $games->whereRelation('genre', 'title', 'LIKE', '%' . $genre_query . '%');
        }
        if ($limit_query) {
            $games = $games->take($limit_query);
            if ($page_query) {
                $games = $games->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($games->get());
    }

    public function show(Request $request, string $slug)
    {
        $game = Game::with(['user', 'genre'])->where('slug', $slug)->first();
        if ($game) {
            return MetaResponse::success(['game' => $game]);
        } else {
            return MetaResponse::error('Game not found');
        }
    }

    public function store(Request $request)
    {
        $author = $request->user;
        // Game inputs
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $thumbnail = $request->input('thumbnail');
        $trailer = $request->input('trailer');
        $status = $request->input('status');
        $genre = $request->input('genre');
        // Slug thing
        $slug = Helper::uniqueSlug($title, Game::class);
        try {
            $game = Game::create([
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content,
                'thumbnail' => $thumbnail ? $thumbnail : '',
                'trailer' => $trailer ? $trailer : '',
                'status' => $status ? $status : 'draft',
                'user_id' => $author->id,
                'genre_id' => Genre::firstOrCreate(['title' => $genre], [
                    'slug' => Helper::uniqueSlug($genre, Genre::class)
                ])->id,
            ]);
            $game->save();
            return MetaResponse::successWithMsg('created', ['game' => $game]);
        } catch (Throwable $error) {
            return MetaResponse::error($error->getMessage());
        }
    }

    public function update(Request $request, string $slug)
    {
        // Game inputs
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $thumbnail = $request->input('thumbnail');
        $trailer = $request->input('trailer');
        $status = $request->input('status');
        $genre = $request->input('genre');
        // Find Game
        $game = Game::where('slug', '=', $slug)->first();
        if ($game) {
            $author = $request->user;
            if ($game->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only game author or admin can access this api', 401);
            }
            // Update ing game
            $game->title = $title ? $title : $game->title;
            $game->description = $description ? $description : $game->description;
            $game->content = $content ? $content : $game->content;
            $game->thumbnail = $thumbnail ? $thumbnail : $game->thumbnail;
            $game->trailer = $trailer ? $trailer : $game->trailer;
            $game->status = $status ? $status : $game->status;
            $game->genre_id = $genre
                ? Genre::firstOrCreate(['title' => $genre], [
                    'slug' => Helper::uniqueSlug($genre, Genre::class)
                ])->id
                : $game->genre_id;
            try {
                $game->update();
                return MetaResponse::successWithMsg('updated', ['game' => $game]);
            } catch (Throwable $err) {
                return MetaResponse::error($err->getMessage());
            }
        } else {
            return MetaResponse::error('Game not found', 404);
        }
    }

    public function destroy(Request $request, string $slug)
    {
        $game = Game::where('slug', '=', $slug)->first();
        if ($game) {
            $author = $request->user;
            if ($game->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only game author or admin can access this api', 401);
            }
            $game->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Game not found', 404);
        }
    }
}
