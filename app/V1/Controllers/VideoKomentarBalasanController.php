<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Game;
use App\Models\GameComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoKomentarBalasanController extends Controller
{
    public function index() {
        $comments = \ViewUserVideoComments::
        withCount('childs')
        ->with(['childs' => function($q) {
            return $q->limit(5);
        } ])
        ->orderBy('id','desc')
        ->paginate();

        return MetaResponse::successWithMsg('', [
            'comments' => $comments
        ]);
    }

    public function komentar($post_id = null, $parent_id = 12159) {

        $comment = \ViewUserVideoComments::query()
            ->where('parent_id', $parent_id)
            // ->where('id', $id)
            ->orderBy('id','desc')
            ->first();

        $reply = \ViewUserVideoComments::query()
            ->where('parent_id', $parent_id)
            ->orderBy('id','desc')
            ->paginate();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'reply' => $reply,
        ]);
    }

    public function komentar_more($post_id = null, $parent_id = 12159) {

        // $comment = \ViewUserVideoComments::query()
        //     ->where('parent_id', $parent_id)
        //     ->where('id', $id)
        //     ->first();

        $reply = \ViewUserVideoComments::query()
            ->where('parent_id', $parent_id)
            ->orderBy('id','desc')
            ->paginate();

        return MetaResponse::successWithMsg('', [
            'reply' => $reply,
        ]);
    }

    public function komentar_input(Request $request, $post_id = null, $parent_id = 12159) {
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                // 'g-recaptcha-response' => 'required|captcha',
                'comment' => 'required',
            ],
            // [
            //     'required' => 'Please verify that you are not a robot.',
            //     'captcha' => 'Captcha error! try again later or contact site admin.',
            // ],
        );

        if ($validator->fails()) {
            return MetaResponse::error('');
        }

        $created_at = date('Y-m-d h:i:s');
        $data = [
            'user_id' => 1,
            'post_id' => $post_id,
            'parent_id' => $parent_id,
            'comment' => $request->comment,
            'created_at' => $created_at,
        ];

        $data = UserVideoComments::insert($data);
        $data = ViewUserVideoComments::whereCreatedAt($created_at)->first();

        return MetaResponse::successWithMsg('', [
            'reply' => $data,
        ]);
    }

    public function komentar_delete(Request $request, $id) {

        $data = UserVideoComments::whereId($id)->delete();

        return MetaResponse::success($data);
    }

}
