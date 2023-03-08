<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Validation\Rule;
use OneSignal;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::query()->with(['user', 'category']);
        $statuses = $this->statuses();

        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $posts->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';

        // Filter data berdasarkan status
        if (request('status')) {
            $posts->where('status', 'LIKE', '%' . request('status') . '%');
        }
        $status = request('status') ?? '';
        // End filter data berdasarkan status

        $posts = $posts->latest()->paginate(5);

        return view('admin.post.index', compact('posts', 'search', 'status', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = $this->statuses();
        return view('admin.post.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'thumbnail' => 'required',
                'description' => 'required',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // 1st method push/insert
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title . '-' . rand(1000, 9999)),
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'category_id' => $request->category,
                'user_id' => Auth::user()->id,
            ]);
            $post->tags()->attach($request->tag);
            $slug = Str::slug($request->title);
            if ($request->status == 'publish') {
                OneSignal::sendNotificationToAll(
                    "Hai sobat Imajora, kita ada postingan baru nih.",
                    $url = "http://localhost:8000/blog/$slug#details",
                );
            }
            return redirect('/admin/post')->with('success', 'New post has been added!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/post')->with('error', 'GAGAL MENAMBAH POST');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $statuses = $this->statuses();
        return view('admin.post.edit', compact('post', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'thumbnail' => 'required',
                'description' => 'required',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title . '-' . rand(1000, 9999)),
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'category_id' => $request->category,
                'user_id' => Auth::user()->id,
            ]);

            $post->tags()->sync($request->tag);
            $slug = Str::slug($request->title);
            if ($request->status == 'publish') {
                OneSignal::sendNotificationToAll(
                    "Hai sobat Imajora, kita ada postingan baru nih.",
                    $url = "http://localhost:8000/blog/$slug#details",
                );
            }
            return redirect('/admin/post')->with('success', 'New post has been update!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/post')->with('error', 'GAGAL UPDATE POST');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        DB::beginTransaction();
        try {
            $post->tags()->detach();
            $post->delete();
            return redirect('/admin/post')->with('success', 'Post has been DELETED!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/post')->with('error', 'GAGAL DELETED POST');
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function statuses()
    {
        return [
            'publish' => 'publish',
            'draft' => 'draft',
        ];
    }
}