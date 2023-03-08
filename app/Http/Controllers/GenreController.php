<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $genre = Genre::all();
        // $genre = DB::table('genres')->latest()->paginate(5);


        $genre = DB::table('genres');
        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $genre->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $genre = $genre->latest()->paginate(4);

        return view('admin.genre.index', compact('genre'));
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
    public function store(GenreRequest $request, Genre $genre)
    {
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ];
        // Insert data
        $genre->create($data);
        $alert = 'Genre ' . $request->title . ' has been added!';
        return redirect('/admin/genre')->with('success', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, $id)
    {
        $genre = Genre::find($id);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ];
        // Update data
        $genre->update($data);
        $alert = 'Genre ' . $request->title . ' has been updated!';
        return redirect('/admin/genre')->with('success', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $genre = Genre::where('slug', $slug)->first();

        $genre->delete($genre);
        $alert = 'Category ' . $genre->title . ' has been deleted!';
        return redirect('/admin/genre')->with('success', $alert);
    }
}
