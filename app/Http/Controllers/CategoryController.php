<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories');
        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $categories->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $categories = $categories->latest()->paginate(4);

        return view('admin.category.index', compact('categories', 'search'));
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
    public function store(CategoryRequest $request)
    {
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);
        $alert = 'New category ' . $request->title . ' has been added!';

        return redirect('/admin/category')->with('success', $alert);
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
    public function update(CategoryRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ];

        $category->update($data);
        $alert = 'Category ' . $request->title . ' has been updated!';
        return redirect('/admin/category')->with('success', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $category->delete($category);
        $alert = 'Category ' . $category->title . ' has been deleted!';
        return redirect('/admin/category')->with('success', $alert);
    }
}
