<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class GalleryController extends Controller
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
        $user = User::find(Auth::user()->id);
        $albums = Album::where('user_id', $user->id)->get();
        return view('admin.gallery.create', compact('user', 'albums'));
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
                'image' => 'required',
                'album' => 'required'
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Intervention Image
        $image = $request->file('image');
        // Create Random name file images
        $nameImage = 'user_' . Auth::user()->id . '_' . date('Ymd') . '_' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

        // Resize Image
        $thumbImage = Image::make($image->getRealPath())->resize(200, 200);

        // Create Folder gallery_user_id jika tidak ada
        $addFolder = 'photos_user_' . Auth::user()->id;
        $path = public_path() . '/uploads/gallery/' . $addFolder;
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        // Simpan Image
        $thumbPath = $path . '/' . $nameImage;
        $thumbImage = Image::make($thumbImage)->save($thumbPath);


        // Menangkap nilai/data dari form
        $galleryStore = [
            'image' => $nameImage,
            'description' => $request->description,
            'album_id' => $request->album,
            'user_id' => Auth::user()->id,
        ];

        // Buat/Create Data ke database
        Photo::create($galleryStore);
        return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Photo has been added.!');
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
        /** kirim semua galleries nya ke view, biar di filter di browser sahaja */
        $photos = Photo::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('admin.gallery.all', compact('photos'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if ($photo->image) {
            $destinationPath = 'uploads/gallery/photos_user_' . Auth::user()->id . '/';
            File::delete($destinationPath . $photo->image);
        }
        $photo->delete();
        return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Photo has been deleted.!');
    }

    public function newAlbum(Request $request)
    {
        // validasi
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        Album::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'New album has been added');
    }
}
