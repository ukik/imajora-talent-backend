<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'content' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            Page::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
            ]);
            return redirect('/admin/pages')->with('success', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/pages')->with('error', 'Fails');
        } finally {
            DB::commit();
        }
    }

    public function edit($slug)
    {
        $page = Page::query()->where('slug', $slug)->first();
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'content' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $page->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
            ]);
            return redirect('/admin/pages')->with('success', 'Updated Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/pages')->with('error', 'Updated Fails');
        } finally {
            DB::commit();
        }
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect('/admin/pages')->with('success', 'Delete Success');
    }
}