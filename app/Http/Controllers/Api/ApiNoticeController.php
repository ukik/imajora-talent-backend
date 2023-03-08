<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Throwable;

class ApiNoticeController extends Controller
{
    public function index(Request $request)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $notices = Notice::with(['user']);
        if ($limit_query) {
            $notices = $notices->take($limit_query);
            if ($page_query) {
                $notices = $notices->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($notices->get());
    }

    public function showByUser(Request $request, string $slug)
    {
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $notices = Notice::whereRelation('user', 'slug', '=', $slug);
        if ($limit_query) {
            $notices = $notices->take($limit_query);
            if ($page_query) {
                $notices = $notices->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($notices->get());
    }

    public function store(Request $request)
    {
        $author = $request->user;
        $content = $request->input('content');
        try {
            $notice = Notice::create([
                'content' => $content,
                'user_id' => $author->id
            ])->id;
            return MetaResponse::successWithMsg('created', ['notice' => $notice]);
        } catch (Throwable $error) {
            return MetaResponse::error($error->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $content = $request->input('content');
        $notice = Notice::find($id);
        if ($notice) {
            $author = $request->user;
            if ($notice->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only notice author or admin can access this api', 401);
            }
            $notice->content = $content ? $content : $notice->content;
            $notice->update();
            return MetaResponse::successWithMsg('updated', ['notice' => $notice]);
        } else {
            return MetaResponse::error('Notice not found');
        }
    }

    public function destroy(Request $request, string $id)
    {
        $notice = Notice::find($id);
        if ($notice) {
            $author = $request->user;
            if ($notice->user->id !== $author->id && $author->role !== 'admin') {
                return MetaResponse::error('Only notice author or admin can access this api', 401);
            }
            $notice->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('Notice not found', 404);
        }
    }
}
