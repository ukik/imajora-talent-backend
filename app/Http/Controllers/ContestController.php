<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestCategory;
use App\Models\ContestTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = Contest::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('admin.contest.index', compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ContestCategory::all();
        return view('admin.contest.create', compact('categories'));
    }

    public function select(Request $request)
    {
        $tags = [];
        if ($request->has('q')) {
            $tags = ContestTag::select('id', 'title')->search($request->q)->get();
        } else {
            $tags = ContestTag::select('id', 'title')->get();
        }


        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
                'thumbnail' => 'required',
                'description' => 'required',
                'link_embed_youtube' => 'required',
                'category' => 'required',
                'content' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // jika kondisi validasi berhasil dilalui lanjut ke beginTransaction
        DB::beginTransaction();
        try {
            $contest = Contest::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'link_embed_youtube' => $request->link_embed_youtube,
                'contest_category_id' => $request->category,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);

            $contest->tags()->attach($request->tag);
            return redirect('/admin/contest')->with('success', 'Contest has been added.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Store fails not worked');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest, $slug)
    {
        $contest = Contest::where('slug', $slug)->first();
        $categories = ContestCategory::all();
        return view('admin.contest.edit', compact('contest', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest, $slug)
    {
        $contest = Contest::where('slug', $slug)->first();
        // validasi
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
                'thumbnail' => 'required',
                'description' => 'required',
                'link_embed_youtube' => 'required',
                'category' => 'required',
                'content' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // jika kondisi validasi berhasil dilalui lanjut ke beginTransaction
        DB::beginTransaction();
        try {
            $contest->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'link_embed_youtube' => $request->link_embed_youtube,
                'contest_category_id' => $request->category,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);

            $contest->tags()->sync($request->tag);
            return redirect('/admin/contest')->with('success', 'Contest has been updated.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Store fails not worked');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contest = Contest::find($id);
        DB::beginTransaction();
        try {
            $contest->delete();
            return redirect('/admin/contest')->with('success', 'Contest has been delete.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Delete fails not worked');
        } finally {
            DB::commit();
        }
    }

    // Category Methods
    public function categories_create()
    {
        $categories = ContestCategory::latest()->paginate(10);
        return view('admin.contest.category.create', compact('categories'));
    }

    public function categories_store(Request $request)
    {
        // Validasi
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // jika kondisi validasi berhasil dilalui lanjut ke beginTransaction
        DB::beginTransaction();
        try {
            $contest = ContestCategory::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
            ]);
            return redirect('/admin/contest/create')->with('success', 'Category has been added.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Store fails not worked');
        } finally {
            DB::commit();
        }

    }

    public function categories_delete($id)
    {
        $category = ContestCategory::find($id);
        $category->delete();
        $message = $category->title . ' Has Been deleted.!';
        return redirect('/admin/contest/category/create')->with('success', $message);
    }

    // Tag Methods
    public function tags_create()
    {
        $tags = ContestTag::latest()->paginate(10);
        return view('admin.contest.tag.create', compact('tags'));
    }

    public function tags_store(Request $request)
    {
        // Validasi
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // jika kondisi validasi berhasil dilalui lanjut ke beginTransaction
        DB::beginTransaction();
        try {
            $contest = ContestTag::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
            ]);
            return redirect('/admin/contest/create')->with('success', 'Tag has been added.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Store fails not worked');
        } finally {
            DB::commit();
        }

    }

    public function tags_delete($id)
    {
        $tag = ContestTag::find($id);
        $tag->delete();
        $message = $tag->title . ' Has Been deleted.!';
        return redirect('/admin/contest/tag/create')->with('success', $message);
    }
}
