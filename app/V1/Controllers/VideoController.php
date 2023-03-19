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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Stevebauman\Purify\Facades\Purify;

class VideoController extends Controller
{
    private $me = 1;

    public function index() {
        $data = \UserVideo::query()
        // ->withCount('comments')
        // ->whereId(134)
        ->with([
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'liked_total',
            'visited_total',
            'shared_total',
            'commented_total',
            'bookmarked_total',
            'liked',
            'visited',
            'shared',
            'commented',
            'bookmarked',
            'user.follow',
            'comments.user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'comments.replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'comments' => function($q) {
                return $q->orderBy('id','desc')->limit(3);
            }
        ])
        ->orderBy('id','desc')
        ->paginate(10);

        return MetaResponse::successWithMsg('', [
            'content' => $data
        ]);
    }

    public function follow(Request $request, $user_id = null) {
        $check = UserFollow::where('user_id', $user_id)->where('follower_id', $this->me)->first();
        if($check) {
            $check->delete();
            $status = 'remove';
        } else {
            UserFollow::insert([
                'user_id' => $user_id,
                'follower_id' => $this->me,
            ]);
            $status = 'add';
            $check = UserFollow::where('user_id', $user_id)->where('follower_id', $this->me)->first();
        }

        return MetaResponse::successWithMsg('', [
            'status' => $status,
            'check' => $check,
        ]);
    }

    public function bookmarked(Request $request, $post_id = null) {

        $check = UserVideoBookmarked::where('post_id', $post_id)->first();
        if(!$check) {
            UserVideoBookmarked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserVideoBookmarked::where('post_id', $post_id)->delete();
        }

        $bookmarked = UserVideoBookmarked::where('post_id', $post_id)->first();
        if(!$bookmarked) {
            $total = UserVideoBookmarkedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserVideoBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserVideoBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserVideoBookmarkedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $bookmarked_total = UserVideoBookmarkedTotal::where('post_id', $post_id)->first();

        return MetaResponse::successWithMsg('', [
            'bookmarked' => $bookmarked,
            'bookmarked_total' => $bookmarked_total,
        ]);
    }

    public function liked(Request $request, $post_id = null) {

        $check = UserVideoLiked::where('post_id', $post_id)->first();
        if(!$check) {
            UserVideoLiked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserVideoLiked::where('post_id', $post_id)->delete();
        }

        $liked = UserVideoLiked::where('post_id', $post_id)->first();
        if(!$liked) {
            $total = UserVideoLikedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserVideoLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserVideoLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserVideoLikedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $liked_total = UserVideoLikedTotal::where('post_id', $post_id)->first();

        return MetaResponse::successWithMsg('', [
            'liked' => $liked,
            'liked_total' => $liked_total,
        ]);
    }

    public function comment(Request $request) {
        $validator = Validator::make(
            [
                'comment' => $request->comment
            ],
            [
                'comment' => 'required',
            ],
        );

        if ($validator->fails()) {
            return MetaResponse::error('');
        }

        $created_at = date('Y-m-d h:i:s');
        $data = [
            'post_id' => request()->post_id,
            'user_id' => $this->me,

            'parent_id' => request()->parent_id,
            'replied_id' => request()->replied_id,

            'comment' => Purify::clean($request->comment),
            'created_at' => $created_at,
        ];

        $data = UserVideoComments::insert($data);

        $comment = UserVideoComments::with([
            'user.follow',
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
        ])->whereCreatedAt($created_at)->first();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => request()->post_id,
        ],[
            'post_id' => request()->post_id,
            'total' => DB::raw('total + 1')
        ]);

        $commented_total = UserVideoCommentedTotal::where('post_id', request()->post_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);
    }

    public function delete(Request $request, $post_id) {

        $data = UserVideo::whereId($post_id)->delete();

        return MetaResponse::success($data);
    }

    public function delete_comment(Request $request, $post_id) {

        UserVideoComments::whereId($post_id)->delete();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => request()->parent_id,
        ],[
            'post_id' => request()->parent_id,
            'total' => DB::raw('total - 1')
        ]);

        $comment = UserVideoComments::with([
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
        ])
        ->where('post_id', request()->parent_id)
        ->orderBy('id','desc')
        ->limit(3)
        ->get();

        $commented_total = UserVideoCommentedTotal::where('post_id', request()->parent_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);

    }




    public function komentar_balasan($id = null) {

        $comment = \UserVideoComments::query()
            ->with([
                'user.follow',
                'user' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
                'replied' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
            ])
            ->where('id', $id)
            ->orderBy('id','desc')
            ->first();

        $reply = null;
        if($comment) {
            $reply = \UserVideoComments::query()
                ->with([
                    'user.follow',
                    'user' => function($q) {
                        return $q->select([
                            'id','name','role','avatar'
                        ]);
                    },
                    'replied' => function($q) {
                        return $q->select([
                            'id','name','role','avatar'
                        ]);
                    },
                ])
                ->where('parent_id', $id)
                ->orderBy('id','desc')
                ->paginate();
        }

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'reply' => $reply,
        ]);
    }
    public function komentar_balasan_more($id = null) {

        $reply = \UserVideoComments::query()
            ->with([
                'user.follow',
                'user' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
                'replied' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
            ])
            ->where('parent_id', $id)
            ->orderBy('id','desc')
            ->paginate();


        return MetaResponse::successWithMsg('', [
            'reply' => $reply,
        ]);
    }
    public function komentar_balasan_comment(Request $request) {
        $validator = Validator::make(
            [
                'comment' => $request->comment
            ],
            [
                'comment' => 'required',
            ],
        );

        if ($validator->fails()) {
            return MetaResponse::error('');
        }

        $created_at = date('Y-m-d h:i:s');
        $data = [
            'post_id' => request()->post_id,
            'user_id' => $this->me,

            'parent_id' => request()->parent_id,
            'replied_id' => request()->replied_id,

            'comment' => Purify::clean($request->comment),
            'created_at' => $created_at,
        ];

        $data = UserVideoComments::insert($data);

        $comment = UserVideoComments::with([
            'user.follow',
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
        ])->whereCreatedAt($created_at)->first();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => request()->post_id,
        ],[
            'post_id' => request()->post_id,
            'total' => DB::raw('total + 1')
        ]);

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
        ]);
    }
    public function komentar_balasan_delete(Request $request, $id) {

        $data = UserVideoComments::whereId($id)->delete();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }





    public function komentar_semua($id = null) {
        $detail = \UserVideo::query()
        ->with([
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'liked_total',
            'visited_total',
            'shared_total',
            'commented_total',
            'bookmarked_total',
            'liked',
            'visited',
            'shared',
            'commented',
            'bookmarked',
            'user.follow',
            'comments.user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'comments.replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'comments' => function($q) {
                return $q->orderBy('id','desc')->limit(3);
            }
        ])
        ->where('id', $id)
        ->orderBy('id','desc')
        ->first();

        $comments = \UserVideoComments::query()
            ->with([
                'user.follow',
                'user' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
                'replied' => function($q) {
                    return $q->select([
                        'id','name','role','avatar'
                    ]);
                },
            ])
            ->where('post_id', $id)
            ->orderBy('id','desc')
            ->paginate();

        return MetaResponse::successWithMsg('', [
            'detail' => $detail,
            'comments' => $comments,
        ]);
    }
    public function komentar_semua_comment(Request $request) {
        $validator = Validator::make(
            [
                'comment' => $request->comment
            ],
            [
                'comment' => 'required',
            ],
        );

        if ($validator->fails()) {
            return MetaResponse::error('');
        }

        $created_at = date('Y-m-d h:i:s');
        $data = [
            'post_id' => request()->post_id,
            'user_id' => $this->me,

            'parent_id' => request()->parent_id,
            'replied_id' => request()->replied_id,

            'comment' => Purify::clean($request->comment),
            'created_at' => $created_at,
        ];

        $data = UserVideoComments::insert($data);

        $comment = UserVideoComments::with([
            'user.follow',
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'replied' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
        ])->whereCreatedAt($created_at)->first();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => request()->post_id,
        ],[
            'post_id' => request()->post_id,
            'total' => DB::raw('total + 1')
        ]);

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
        ]);
    }
    public function komentar_semua_delete(Request $request, $id) {

        $data = UserVideoComments::whereId($id)->delete();

        UserVideoCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }



    public function form_edit($id = null) {
        $detail = \UserVideo::query()
        ->where('id', $id)
        ->first();

        return MetaResponse::successWithMsg('', [
            'detail' => $detail,
        ]);
    }

    public function form_create(Request $request, $id = null)
    {
        $me = $this->me;

        // $validator = Validator::make(
        //     [
        //         // 'media' => $request->media,
        //         // 'cover' => $request->cover,
        //         'description' => $request->description,
        //     ],
        //     [
        //         'description' => 'required|string|max:2500',
        //         // 'media' => 'required|file|mimetypes:video/mp4|max:100000', // max 100 mb
        //         // 'cover' => 'required|file|mimes:jpeg,png,jpg,gif'
        //     ],
        // );

        // if ($validator->fails()) {
        //     return MetaResponse::error($validator->errors());
        // }

        $created_at = date('Y-m-d h:i:s');
        $form = [
            'id' => $id,
            'user_id' => $me,
            'description' => $request->description,
            'created_at' => $created_at,
        ];

        // $fileName = time().'.'.$request->media->getClientOriginalExtension();
        // $request->media->move(public_path('upload'), $fileName);

        if($id) { // jika EDIT
            $data = UserVideo::whereId($id)->first();
        }

        if(isset($request->media) && $request->hasFile('media')):

            $validator = Validator::make(
                [
                    'media' => $request->media,
                ],
                [
                    'media' => 'required|file|mimetypes:video/mp4|max:100000', // max 100 mb
                ],
            );

            if ($validator->fails()) {
                return MetaResponse::error($validator->errors());
            }

            if (File::exists($data->file) && !blank($data->file)) :
                unlink($data->file);
            endif;

            // make unique name for image
            $currentDate = \Carbon\Carbon::now()->toDateString();
            $imageName  = $me.'-'.$currentDate.'-'.uniqid().'.'.
                $request->media->getClientOriginalExtension();

            $directory          = 'upload/'.$me.'/'.'video/file/';
            $profileImgUrl      = $directory . $imageName;
            $request->media->move($directory, $imageName);

            $form['file']    = str_replace("public/","",$profileImgUrl);

            // modifikasi dilakukan setelah file disimpan di SERVER
            // Image::make($user->foto)->fit(260, 260)->save($directory . '-260x260-'. $imageName);
        endif;

        // $fileName = time().'.'.$request->cover->getClientOriginalExtension();
        // $request->cover->move(public_path('upload'), $fileName);

        if(isset($request->cover) && $request->hasFile('cover')):

            $validator = Validator::make(
                [
                    'cover' => $request->cover,
                ],
                [
                    'cover' => 'required|file|mimes:jpeg,png,jpg,gif'
                ],
            );

            if ($validator->fails()) {
                return MetaResponse::error($validator->errors());
            }

            if (File::exists($data->cover) && !blank($data->cover)) :
                unlink($data->cover);
            endif;

            // make unique name for image
             $currentDate = \Carbon\Carbon::now()->toDateString();
             $imageName  = $me.'-'.$currentDate.'-'.uniqid().'.'.
                 $request->cover->getClientOriginalExtension();

             $directory          = 'upload/'.$me.'/'.'video/cover/';
             $profileImgUrl      = $directory . $imageName;
             $request->cover->move($directory, $imageName);

             $form['cover']    = str_replace("public/","",$profileImgUrl);

             // modifikasi dilakukan setelah file disimpan di SERVER
             // Image::make($user->foto)->fit(260, 260)->save($directory . '-260x260-'. $imageName);
         endif;

        // if ($request->hasFile('file')) {
        //     $path = $request->file('file')->store('file', ['disk' => 'my_files']);
        //     $video->file = $path;
        // }

        UserVideo::updateOrCreate([
            'id' => $id
        ], $form);

        if($id) {
            $content = UserVideo::whereId($id)->first();
        } else {
            $content = UserVideo::where('created_at', $created_at)->first();
        }

        return MetaResponse::successWithMsg('', [
            'content' => $content,
        ]);
    }

    public function form_delete_cover(Request $request, $id)
    {
        $data = UserVideo::whereId($id)->first();

        if (File::exists($data->cover) && !blank($data->cover)) :
            unlink($data->cover);
        endif;

        UserVideo::whereId($id)->update([
            'cover' => NULL
        ]);

        return MetaResponse::success('');
    }

    public function form_delete_media(Request $request, $id)
    {

        $data = UserVideo::whereId($id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        UserVideo::whereId($id)->update([
            'file' => NULL
        ]);

        return MetaResponse::success('');
    }

    public function form_delete(Request $request, $id)
    {
        // Gak usah soalnya pakai soft delete
        /*
        $data = UserVideo::whereId($id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        if (File::exists($data->cover) && !blank($data->cover)) :
            unlink($data->cover);
        endif;
        */

        UserVideo::whereId($id)->delete();

        return MetaResponse::success('');
    }
}
