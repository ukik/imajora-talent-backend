<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create');
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
                'content' => 'required|min:3',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Menangkap nilai dari form
        $noticeStore = [
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ];

        // Mengirimkan data ke database
        Notice::create($noticeStore);
        return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Notice has been added.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $notices = Notice::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(4);
        return view('admin.notice.all', compact('notices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('admin.notice.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Menangkap ID Notice
        $notice = Notice::find($id);
        // validasi
        $validator = validator::make(
            $request->all(),
            [
                'content' => 'required|min:3',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Menangkap nilai dari form
        $noticeStore = [
            'content' => $request->content,
        ];

        // Mengirimkan data ke database untuk melakukan update data
        $notice->update($noticeStore);
        return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Notice has been updated.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        $notice->delete();
        return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Notice has been deleted.!');
    }
}