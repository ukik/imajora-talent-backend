<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

class TagBasedController extends Controller
{
    protected $model;

    public function index()
    {
        return MetaResponse::success($this->model::all());
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        try {
            if (!$title) {
                throw new Throwable('title is required');
            }
            $slug = Helper::uniqueSlug($title, $this->model);
            $item = $this->model::create([
                'title' => $title,
                'slug' => $slug
            ]);
            return MetaResponse::successWithMsg('created', $item);
        } catch (Throwable $err) {
            return MetaResponse::error($err->getMessage());
        }
    }

    public function update(Request $request, string $slug)
    {
        $title = $request->input('title');
        try {
            $item = $this->model::where('slug', '=', $slug)->first();
            if ($item) {
                $item->title = $title ? $title : $item->title;
                $item->update();
                return MetaResponse::successWithMsg('updated', $item);
            } else {
                return MetaResponse::error('Not found', 404);
            }
        } catch (Throwable $err) {
            return MetaResponse::error($err->getMessage());
        }
    }

    public function destroy(Request $request, string $slug)
    {
        try {
            $item = $this->model::where('slug', '=', $slug);
            if ($item) {
                $item->delete();
                return MetaResponse::successWithMsg('deleted');
            } else {
                return MetaResponse::error('Not found', 404);
            }
        } catch (Throwable $err) {
            return MetaResponse::error($err->getMessage());
        }
    }
}
