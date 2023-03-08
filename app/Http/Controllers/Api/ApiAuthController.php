<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailNotifySignUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class ApiAuthController extends Controller
{

    private function generateApiToken(User $user)
    {
        $api_token = Str::random(32);
        $user->api_token = $api_token;
        $user->update();
        return MetaResponse::success(['token' => $api_token]);
    }

    public function verifyResigtration(Request $request)
    {
        $reg_token = $request->query('req_token');
        return MetaResponse::success(['registration_token' => $reg_token]);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            return ApiAuthController::generateApiToken($user);
        } else {
            return MetaResponse::error('Email or Password Invalid', 401);
        }
    }

    public function callbackGoogle()
    {
        $driver = Socialite::driver('google');
        if ($driver instanceof GoogleProvider) {
            $google_user = $driver->stateless()->user();
            $username = $google_user->getName();
            $email = $google_user->getEmail();
            $avatar = $google_user->getAvatar();
            $user = User::where('email', $email)->first();
            if ($user) {
                if ($user->talent_verifyed) {
                    return ApiAuthController::generateApiToken($user);
                } else {
                    return MetaResponse::successWithMsg('pending verification');
                }
            } else {
                $password = Str::random(16);
                User::create([
                    'name' => $username,
                    'slug' => Str::slug($username, '-'),
                    'email' => $email,
                    'avatar' => $avatar,
                    'password' => Hash::make($password)
                ]);
                Mail::to($email)->send(new MailNotifySignUp([
                    'name' => $username,
                    'email' => $email,
                    'password' => $password
                ]));
                return MetaResponse::successWithMsg('pending verification');
            }
        } else {
            return MetaResponse::error('Driver initialization failed');
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user;
        $user->api_token = '';
        $user->update();
        return MetaResponse::successWithMsg('logged out');
    }
}
