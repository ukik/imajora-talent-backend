<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Throwable;

class ApiGalleryController extends Controller
{
    public function index(Request $request)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $galleries = Gallery::with(['user']);
        if ($limit_query) {
            $galleries = $galleries->take($limit_query);
            if ($page_query) {
                $galleries = $galleries->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($galleries->get());
    }

    public function showByUser(Request $request, string $slug)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $galleries = Gallery::whereRelation('user', 'slug', '=', $slug);
        if ($limit_query) {
            $galleries = $galleries->take($limit_query);
            if ($page_query) {
                $galleries = $galleries->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($galleries->get());
    }

    public function store(Request $request)
    {
        $author = $request->user;
        $image = $request->input('image');
        $description = $request->input('description');
        try {
            $gallery = Gallery::create([
                'image' => $image,
                'description' => $description,
                'user_id' => $author->id
            ])->id;
            return MetaResponse::successWithMsg('created', ['gallery' => $gallery]);
        } catch (Throwable $error) {
            return MetaResponse::error($error->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $image = $request->input('image');
        $description = $request->input('description');
        $gallery = Gallery::find($id);
        if ($gallery) {
            $author = $request->user;
            if ($gallery->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only gallery author or admin can access this api', 401);
            }
            $gallery->image = $image ? $image : $gallery->image;
            $gallery->description = $description ? $description : $gallery->description;
            $gallery->update();
            return MetaResponse::successWithMsg('updated', ['gallery' => $gallery]);
        } else {
            return MetaResponse::error('Gallery not found');
        }
    }

    public function destroy(Request $request, string $id)
    {
        $gallery = Gallery::find($id);
        if ($gallery) {
            $author = $request->user;
            if ($gallery->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only gallery author or admin can access this api', 401);
            }
            $gallery->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Gallery not found', 404);
        }
    }

    public function uploadImage(Request $request)
    {
        $author = $request->user;
        $image = $request->file('image');
        if ($image) {
            $image_name = uniqid() . $image->getClientOriginalName();
            $thumb_image = Image::make($image->getRealPath())->resize(200, 200);
            $author_folder = 'gallery_user_' . $author->id;
            $path = public_path() . '/uploads/gallery/' . $author_folder;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $store_path = $path . '/' . $image_name;
            Image::make($thumb_image)->save($store_path);
            return MetaResponse::success(['image' => $store_path]);
        } else {
            return MetaResponse::error('Avatar not uploaded');
        }
    }
}
