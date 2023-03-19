<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

// use App\Models\Comment;
// use App\Models\Game;
// use App\Models\GameComment;
// use App\Models\Post;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Stevebauman\Purify\Facades\Purify;

class AudioController extends Controller
{
    private $me = 1;

    public function index() {
        $data = \UserAudio::query()
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

        $check = UserAudioBookmarked::where('post_id', $post_id)->first();
        if(!$check) {
            UserAudioBookmarked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserAudioBookmarked::where('post_id', $post_id)->delete();
        }

        $bookmarked = UserAudioBookmarked::where('post_id', $post_id)->first();
        if(!$bookmarked) {
            $total = UserAudioBookmarkedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserAudioBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserAudioBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserAudioBookmarkedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $bookmarked_total = UserAudioBookmarkedTotal::where('post_id', $post_id)->first();

        return MetaResponse::successWithMsg('', [
            'bookmarked' => $bookmarked,
            'bookmarked_total' => $bookmarked_total,
        ]);
    }

    public function liked(Request $request, $post_id = null) {

        $check = UserAudioLiked::where('post_id', $post_id)->first();
        if(!$check) {
            UserAudioLiked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserAudioLiked::where('post_id', $post_id)->delete();
        }

        $liked = UserAudioLiked::where('post_id', $post_id)->first();
        if(!$liked) {
            $total = UserAudioLikedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserAudioLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserAudioLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserAudioLikedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $liked_total = UserAudioLikedTotal::where('post_id', $post_id)->first();

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

        $data = UserAudioComments::insert($data);

        $comment = UserAudioComments::with([
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

        UserAudioCommentedTotal::updateOrCreate([
            'post_id' => request()->post_id,
        ],[
            'post_id' => request()->post_id,
            'total' => DB::raw('total + 1')
        ]);

        $commented_total = UserAudioCommentedTotal::where('post_id', request()->post_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);
    }

    public function delete(Request $request, $post_id) {

        $data = UserAudio::whereId($post_id)->delete();

        return MetaResponse::success($data);
    }

    public function delete_comment(Request $request, $post_id) {

        UserAudioComments::whereId($post_id)->delete();

        UserAudioCommentedTotal::updateOrCreate([
            'post_id' => request()->parent_id,
        ],[
            'post_id' => request()->parent_id,
            'total' => DB::raw('total - 1')
        ]);

        $comment = UserAudioComments::with([
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

        $commented_total = UserAudioCommentedTotal::where('post_id', request()->parent_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);

    }




    public function komentar_balasan($id = null) {

        $comment = \UserAudioComments::query()
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
            $reply = \UserAudioComments::query()
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

        $reply = \UserAudioComments::query()
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

        $data = UserAudioComments::insert($data);

        $comment = UserAudioComments::with([
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

        UserAudioCommentedTotal::updateOrCreate([
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

        $data = UserAudioComments::whereId($id)->delete();

        UserAudioCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }





    public function komentar_semua($id = null) {
        $detail = \UserAudio::query()
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

        $comments = \UserAudioComments::query()
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

        $data = UserAudioComments::insert($data);

        $comment = UserAudioComments::with([
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

        UserAudioCommentedTotal::updateOrCreate([
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

        $data = UserAudioComments::whereId($id)->delete();

        UserAudioCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }



    public function form_edit($id = null) {
        $detail = \UserAudio::query()
        ->where('id', $id)
        ->first();

        return MetaResponse::successWithMsg('', [
            'detail' => $detail,
        ]);
    }

    public function form_create(Request $request, $id = null)
    {
        $me = $this->me;

        $validator = Validator::make(
            [
                // 'media' => $request->media,
                // 'cover' => $request->cover,
                'description' => $request->description,
            ],
            [
                'description' => 'required|string|max:2500',
                // 'media' => 'required|file|mimetypes:video/mp4|max:100000', // max 100 mb
                // 'cover' => 'required|file|mimes:jpeg,png,jpg,gif'
            ],
        );

        if ($validator->fails()) {
            return MetaResponse::error($validator->errors());
        }

        $created_at = date('Y-m-d h:i:s');
        $form = [
            'id' => $id,
            'user_id' => $me,
            'description' => $request->description,
            'created_at' => $created_at,
        ];
        // $video = new UserAudio;
        // $video->user_id = $this->me;
        // $video->description = $request->description;

        // $fileName = time().'.'.$request->media->getClientOriginalExtension();
        // $request->media->move(public_path('upload'), $fileName);

        if($id) { // jika EDIT
            $data = UserAudio::whereId($id)->first();
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
            $imageName  = '1'.'-'.$currentDate.'-'.uniqid().'.'.
                $request->media->getClientOriginalExtension();

            $directory          = 'upload/video/'.$me.'/'.'file/';
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
             $imageName  = '1'.'-'.$currentDate.'-'.uniqid().'.'.
                 $request->cover->getClientOriginalExtension();

             $directory          = 'upload/video/'.$me.'/'.'cover/';
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

        UserAudio::updateOrCreate([
            'id' => $id
        ], $form);

        if($id) {
            $content = UserAudio::whereId($id)->first();
        } else {
            $content = UserAudio::where('created_at', $created_at)->first();
        }

        return MetaResponse::successWithMsg('', [
            'content' => $content,
        ]);
    }

    public function form_delete_cover(Request $request, $id)
    {
        $data = UserAudio::whereId($id)->first();

        if (File::exists($data->cover) && !blank($data->cover)) :
            unlink($data->cover);
        endif;

        UserAudio::whereId($id)->update([
            'cover' => NULL
        ]);

        return MetaResponse::success('');
    }

    public function form_delete_media(Request $request, $id)
    {

        $data = UserAudio::whereId($id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        UserAudio::whereId($id)->update([
            'file' => NULL
        ]);

        return MetaResponse::success('');
    }

    public function form_delete(Request $request, $id)
    {
        // Gak usah soalnya pakai soft delete
        /*
        $data = UserAudio::whereId($id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        if (File::exists($data->cover) && !blank($data->cover)) :
            unlink($data->cover);
        endif;
        */

        UserAudio::whereId($id)->delete();

        return MetaResponse::success('');
    }
}
