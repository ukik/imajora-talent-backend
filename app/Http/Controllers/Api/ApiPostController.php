<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Throwable;

class ApiPostController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->query('search');
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $category_query = $request->query('category');
        $tag_query = $request->query('tag');
        $posts = Post::with(['user', 'tags', 'category']);
        if ($search_query) {
            $posts = $posts->where('title', 'LIKE', '%' . $search_query . '%');
        }
        if ($category_query) {
            $posts = $posts->whereRelation('category', 'title', 'LIKE', '%' . $category_query . '%');
        }
        if ($tag_query) {
            $posts = $posts->whereRelation('tags', 'title', 'LIKE', '%' . $tag_query . '%');
        }
        if ($limit_query) {
            $posts = $posts->take($limit_query);
            if ($page_query) {
                $posts = $posts->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($posts->get());
    }

    public function show(Request $request, string $slug)
    {
        $blog = Post::with(['user', 'tags', 'category'])->where('slug', $slug)->first();
        if ($blog) {
            return MetaResponse::success(['blog' => $blog]);
        } else {
            return MetaResponse::error('Blog not found');
        }
    }

    public function store(Request $request)
    {
        $author = $request->user;
        // Post inputs
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $thumbnail = $request->input('thumbnail');
        $status = $request->input('status');
        $category = $request->input('category');
        $tags = $request->input('tags');
        // Slug thing
        $slug = Helper::uniqueSlug($title, Post::class);
        try {
            $post = Post::create([
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content,
                'thumbnail' => $thumbnail ? $thumbnail : '',
                'status' => $status ? $status : 'draft',
                'user_id' => $author->id,
                'category_id' => Category::firstOrCreate(['title' => $category], [
                    'slug' => Helper::uniqueSlug($category, Category::class)
                ])->id,
            ]);
            foreach ($tags as $tag) {
                $post->tags()->attach(
                    Tag::firstOrCreate(['title' => $tag], [
                        'slug' => Helper::uniqueSlug($tag, Tag::class)
                    ])
                );
            }
            $post->save();
            return MetaResponse::successWithMsg('created', ['post' => $post]);
        } catch (Throwable $error) {
            return MetaResponse::error($error->getMessage());
        }
    }

    public function update(Request $request, string $slug)
    {
        // Post inputs
        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $thumbnail = $request->input('thumbnail');
        $status = $request->input('status');
        $category = $request->input('category');
        $tags = $request->input('tags');
        // Find Post
        $post = Post::where('slug', '=', $slug)->first();
        if ($post) {
            $author = $request->user;
            if ($post->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only blog author or admin can access this api', 401);
            }
            // Update ing post
            $post->title = $title ? $title : $post->title;
            $post->description = $description ? $description : $post->description;
            $post->content = $content ? $content : $post->content;
            $post->thumbnail = $thumbnail ? $thumbnail : $post->thumbnail;
            $post->status = $status ? $status : $post->status;
            $post->category_id = $category
                ? Category::firstOrCreate(['title' => $category], [
                    'slug' => Helper::uniqueSlug($category, Category::class)
                ])->id
                : $post->category_id;
            if ($tags) {
                $post->tags()->sync(array_map(function ($tag) {
                    return Tag::firstOrCreate(['title' => $tag], [
                        'slug' => Helper::uniqueSlug($tag, Tag::class)
                    ])->id;
                }, $tags));
            }
            try {
                $post->update();
                return MetaResponse::successWithMsg('updated', ['post' => $post]);
            } catch (Throwable $err) {
                return MetaResponse::error($err->getMessage());
            }
        } else {
            return MetaResponse::error('Blog not found', 404);
        }
    }

    public function destroy(Request $request, string $slug)
    {
        // Find Post
        $post = Post::where('slug', '=', $slug)->first();
        if ($post) {
            $author = $request->user;
            if ($post->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only blog author or admin can access this api', 401);
            }
            $post->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Blog not found', 404);
        }
    }
}
