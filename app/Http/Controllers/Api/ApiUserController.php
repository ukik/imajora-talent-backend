<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Throwable;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        $search_query = $request->query('search');
        $limit_query = $request->query('limit');
        $page_query = $request->query('page');
        $skill_query = $request->query('skill');
        $users = User::with(['skills']);
        if ($search_query) {
            $users = $users->where('name', 'LIKE', '%' . $search_query . '%');
        }
        if ($skill_query) {
            $users = $users->whereRelation('skills', 'title', 'LIKE', '%' . $skill_query . '%');
        }
        if ($limit_query) {
            $users = $users->take($limit_query);
            if ($page_query) {
                $users = $users->skip(($page_query - 1) * $limit_query);
            }
        }
        return MetaResponse::success($users->get());
    }

    public function show(Request $request, string $slug)
    {
        $user = User::with(['skills'])->where('slug', $slug)->first();
        if ($user) {
            return MetaResponse::success(['user' => $user]);
        } else {
            return MetaResponse::error('User not found');
        }
    }

    public function store(Request $request)
    {
        $user = $request->user;
        if ($user->role !== 'admin') {
            return MetaResponse::error('Only admin can access this api', 401);
        }
        // User inputs
        $username = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $avatar = $request->input('avatar');
        $phone = $request->input('phone');
        $gender = $request->input('gender');
        $country = $request->input('country');
        $city = $request->input('city');
        $description = $request->input('description');
        $role = $request->input('role');
        $skills = $request->input('skills');
        // Slug thing
        $slug = Helper::uniqueSlug($username, User::class);
        try {
            $user = User::create([
                'name' => $username,
                'slug' => $slug,
                'email' => $email,
                'password' => Hash::make($password),
                'avatar' => $avatar,
                'role' => $role,
                'phone' => $phone,
                'gender' => $gender,
                'country' => $country,
                'city' => $city,
                'description' => $description,
            ]);
            if ($skills) {
                foreach ($skills as $skill) {
                    $user->skills()->attach(
                        Skill::firstOrCreate(['title' => $skill], [
                            'slug' => Helper::uniqueSlug($skill, Skill::class)
                        ])
                    );
                }
            }
            return MetaResponse::successWithMsg('created', ['user' => $user]);
        } catch (Throwable $error) {
            return MetaResponse::error($error->getMessage());
        }
    }

    public function update(Request $request, string $slug)
    {
        // User inputs
        $username = $request->input('name');
        $password = $request->input('password');
        $avatar = $request->input('avatar');
        $phone = $request->input('phone');
        $gender = $request->input('gender');
        $country = $request->input('country');
        $city = $request->input('city');
        $description = $request->input('description');
        $role = $request->input('role');
        $skills = $request->input('skills');
        // Find User
        $user = User::where('slug', '=', $slug)->first();
        if ($user) {
            $author = $request->user;
            if ($user->slug !== $slug && $author->role !== 'admin') {
                return MetaResponse::error('Only related member or admin can access this api', 401);
            }
            // Update ing user
            $user->name = $username ? $username : $user->name;
            $user->password = $password ? Hash::make($password) : $user->password;
            $user->avatar = $avatar ? $avatar : $user->avatar;
            $user->phone = $phone ? $phone : $user->phone;
            $user->gender = $gender ? $gender : $user->gender;
            $user->country = $country ? $country : $user->country;
            $user->city = $city ? $city : $user->city;
            $user->description = $description ? $description : $user->description;
            $user->role = $role ? $role : $user->role;
            if ($skills) {
                $user->skills()->sync(array_map(function ($skill) {
                    return Skill::firstOrCreate(['title' => $skill], [
                        'slug' => Helper::uniqueSlug($skill, Skill::class)
                    ])->id;
                }, $skills));
            }
            $user->update();
            return MetaResponse::successWithMsg('updated', ['user' => $user]);
        } else {
            return MetaResponse::error('User not found', 404);
        }
    }

    public function destroy(Request $request, string $slug)
    {
        // Find User
        $user = User::where('slug', '=', $slug)->first();
        if ($user) {
            $author = $request->user;
            if ($author->role !== 'admin') {
                return MetaResponse::error('Only admin can access this api', 401);
            }
            $user->delete();
            return MetaResponse::successWithMsg('deleted');
        } else {
            return MetaResponse::error('User not found');
        }
    }

    public function uploadAvatar(Request $request)
    {
        $avatar = $request->file('avatar');
        if ($avatar) {
            $avatar_name = uniqid() . $avatar->getClientOriginalName();
            $thumb_avatar = Image::make($avatar->getRealPath())->resize(200, 200);
            $store_path = public_path() . '/uploads/avatars/' . $avatar_name;
            Image::make($thumb_avatar)->save($store_path);
            return MetaResponse::success(['image' => $store_path]);
        } else {
            return MetaResponse::error('Avatar not uploaded');
        }
    }
}
