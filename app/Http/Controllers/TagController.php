<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = DB::table('tags');
        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $tags->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $tags = $tags->latest()->paginate(4);
        return view('admin.tag.index', compact('tags', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);
        $alert = 'New tag ' . $request->title . ' has been added!';

        return redirect('/admin/tag')->with('success', $alert);
    }

    public function select(Request $request)
    {
        $tags = [];
        if ($request->has('q')) {
            $tags = Tag::select('id', 'title')->search($request)->get();
        } else {
            $tags = Tag::select('id', 'title')->limit(5)->get();
        }

        return response()->json($tags);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ];

        $tag->update($data);
        $alert = 'Tag ' . $request->title . ' has been updated!';
        return redirect('/admin/tag')->with('success', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        $tag->delete($tag);
        $alert = 'Tag ' . $tag->title . ' has been deleted!';
        return redirect('/admin/tag')->with('success', $alert);
    }
}
