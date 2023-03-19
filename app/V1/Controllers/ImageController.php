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

class ImageController extends Controller
{
    private $me = 1;

    public function index() {
        $data = \UserImage::query()
        // ->withCount('comments')
        // ->whereId(134)
        ->with([
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'images',
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

        $check = UserImageBookmarked::where('post_id', $post_id)->first();
        if(!$check) {
            UserImageBookmarked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserImageBookmarked::where('post_id', $post_id)->delete();
        }

        $bookmarked = UserImageBookmarked::where('post_id', $post_id)->first();
        if(!$bookmarked) {
            $total = UserImageBookmarkedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserImageBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserImageBookmarkedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserImageBookmarkedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $bookmarked_total = UserImageBookmarkedTotal::where('post_id', $post_id)->first();

        return MetaResponse::successWithMsg('', [
            'bookmarked' => $bookmarked,
            'bookmarked_total' => $bookmarked_total,
        ]);
    }

    public function liked(Request $request, $post_id = null) {

        $check = UserImageLiked::where('post_id', $post_id)->first();
        if(!$check) {
            UserImageLiked::insert([
                'user_id' => $this->me,
                'post_id' => $post_id,
            ]);
        } else {
            UserImageLiked::where('post_id', $post_id)->delete();
        }

        $liked = UserImageLiked::where('post_id', $post_id)->first();
        if(!$liked) {
            $total = UserImageLikedTotal::where('post_id', $post_id)->value('total');
            if($total) {
                UserImageLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 1')
                ]);
            } else {
                UserImageLikedTotal::updateOrCreate([
                    'post_id' => $post_id,
                ],[
                    'post_id' => $post_id,
                    'total' => DB::raw('total - 0')
                ]);
            }
        } else {
            UserImageLikedTotal::updateOrCreate([
                'post_id' => $post_id,
            ],[
                'post_id' => $post_id,
                'total' => DB::raw('total + 1')
            ]);
        }

        $liked_total = UserImageLikedTotal::where('post_id', $post_id)->first();

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

        $data = UserImageComments::insert($data);

        $comment = UserImageComments::with([
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

        UserImageCommentedTotal::updateOrCreate([
            'post_id' => request()->post_id,
        ],[
            'post_id' => request()->post_id,
            'total' => DB::raw('total + 1')
        ]);

        $commented_total = UserImageCommentedTotal::where('post_id', request()->post_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);
    }

    public function delete(Request $request, $post_id) {

        $data = UserImage::whereId($post_id)->delete();

        return MetaResponse::success($data);
    }

    public function delete_comment(Request $request, $post_id) {

        UserImageComments::whereId($post_id)->delete();

        UserImageCommentedTotal::updateOrCreate([
            'post_id' => request()->parent_id,
        ],[
            'post_id' => request()->parent_id,
            'total' => DB::raw('total - 1')
        ]);

        $comment = UserImageComments::with([
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

        $commented_total = UserImageCommentedTotal::where('post_id', request()->parent_id)->first();

        return MetaResponse::successWithMsg('', [
            'comment' => $comment,
            'commented_total' => $commented_total,
        ]);

    }




    public function komentar_balasan($id = null) {

        $comment = \UserImageComments::query()
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
            $reply = \UserImageComments::query()
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

        $reply = \UserImageComments::query()
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

        $data = UserImageComments::insert($data);

        $comment = UserImageComments::with([
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

        UserImageCommentedTotal::updateOrCreate([
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

        $data = UserImageComments::whereId($id)->delete();

        UserImageCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }





    public function komentar_semua($id = null) {
        $detail = \UserImage::query()
        ->with([
            'user' => function($q) {
                return $q->select([
                    'id','name','role','avatar'
                ]);
            },
            'images',
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

        $comments = \UserImageComments::query()
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

        $data = UserImageComments::insert($data);

        $comment = UserImageComments::with([
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

        UserImageCommentedTotal::updateOrCreate([
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

        $data = UserImageComments::whereId($id)->delete();

        UserImageCommentedTotal::updateOrCreate([
            'post_id' => $id,
        ],[
            'post_id' => $id,
            'total' => DB::raw('total - 1')
        ]);

        return MetaResponse::success($data);
    }



    public function form_edit($id = null) {
        $detail = \UserImage::query()
        ->with([ 'images' => function($q){
            return $q->select('id','post_id','file');
        }])
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

        UserImage::updateOrCreate([
            'id' => $id
        ], $form);

        $user_image = UserImage::where('created_at', $created_at)->first();

        // $fileName = time().'.'.$request->media->getClientOriginalExtension();
        // $request->media->move(public_path('upload'), $fileName);

        if($id) { // jika EDIT
            $data = UserImageFile::whereId($id)->limit(5)->get();
        }

        $image_file = [];

        if(isset($request->cover) && $request->hasFile('cover')):

            $validator = Validator::make(
                [
                    'cover' => $request->cover,
                ],
                [
                    'cover' => 'required',
                    'cover.*' => 'file|mimes:jpeg,png,jpg,gif'
                ],
            );

            if ($validator->fails()) {
                return MetaResponse::error($validator->errors());
            }

            if($id) {
                foreach ($data as $value) {
                    if (File::exists($value->file) && !blank($value->file)) :
                        unlink($value->file);
                    endif;
                }
            }

            $covers = $request->cover;

            foreach ($covers as $cover) {
                // make unique name for image
                 $currentDate = \Carbon\Carbon::now()->toDateString();
                 $imageName  = $me.'-'.$currentDate.'-'.uniqid().'.'.
                     $cover->getClientOriginalExtension();

                 $directory          = 'upload/'.$me.'/'.'images/';
                 $profileImgUrl      = $directory . $imageName;
                 $cover->move($directory, $imageName);

                 array_push($image_file, [
                    'post_id' => $user_image->id,
                    'user_id' => $me,
                    'file' => str_replace("public/","",$profileImgUrl),
                    'thumbnail' => str_replace("public/","",$profileImgUrl),
                 ]);
            }

            // modifikasi dilakukan setelah file disimpan di SERVER
            // Image::make($user->foto)->fit(260, 260)->save($directory . '-260x260-'. $imageName);
         endif;

        UserImageFile::upsert($image_file, ['file','thumbnail']);

        if($id) {
            $content = UserImage::whereId($id)->with('images')->first();
        } else {
            $content = UserImage::where('created_at', $created_at)->with('images')->first();
        }

        return MetaResponse::successWithMsg('', [
            'content' => $content,
        ]);
    }

    public function form_delete_cover(Request $request, $id)
    {
        $data = UserImageFile::whereId($request->user_image_file_id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        UserImageFile::whereId($request->user_image_file_id)->delete();

        return MetaResponse::success('');
    }

    public function form_delete(Request $request, $id)
    {
        // Gak usah soalnya pakai soft delete
        /*
        $data = UserImage::whereId($id)->first();

        if (File::exists($data->file) && !blank($data->file)) :
            unlink($data->file);
        endif;

        if (File::exists($data->cover) && !blank($data->cover)) :
            unlink($data->cover);
        endif;
        */

        UserImage::whereId($id)->delete();

        return MetaResponse::success('');
    }
}
