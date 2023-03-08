<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\MailNotifySignUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users');

        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $users->where('name', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $users = $users->paginate(10);

        return view('admin.user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Generate random password
        $generatePassword = Str::random(8);
        User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'email' => $request->email,
            'password' => Hash::make($generatePassword),
            'api_token' => Str::random(32),
            'role' => $request->role
        ]);

        // Data SignUp yang akan dikirim ke email user
        $dataSignUp = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $generatePassword,
        ];
        // Kirim data sign up ke email tersebut
        \Mail::to($request->email)->send(new MailNotifySignUp($dataSignUp));

        $alert = 'User ' . $request->name . ' has been added!';

        return redirect('admin/user')->with('success', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        $user = User::where('email', $email)->first();
        // dd($user);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // validasi
        $validator = validator::make(
            $request->all(),
            [
                'avatar' => 'image|mimes:jpg,png|max:2048',
                'name' => 'required|min:3',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Jika meng-upload avatars/image
        if ($request->file('avatar')) {
            // Jika terdapat avatar/data lama
            if ($request->oldAvatar) {
                $path = public_path() . '/uploads/avatars/';
                File::delete($path . $request->oldAvatar);
            }

            // Intervention Image
            $avatar = $request->file('avatar');
            // Create Random name file images
            $nameAvatar = 'avatar_id_' . $user->id . '_' . date('Ymd') . '.' . $avatar->getClientOriginalExtension();
            // Resize Image
            $thumbAvatar = Image::make($avatar->getRealPath())->resize(200, 200);

            // Store path penyimpanan avatars
            $storePath = public_path() . '/uploads/avatars/' . $nameAvatar;
            // Save
            $thumbAvatar = Image::make($thumbAvatar)->save($storePath);
        }

        // variabel data berisi nilai dari form
        $data = [
            'name' => $request->name,
        ];

        // Jika terdapat data password baru
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->file('avatar')) {
            $data['avatar'] = $nameAvatar;
        }

        // Update data user
        $user->update($data);
        $alert = 'User ' . $request->name . ' has been updated!';
        return redirect('admin/dashboard')->with('success', $alert);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->avatar) {
            $deleteAvatar = '/uploads/avatars/' . $user->avatar;
            File::delete($deleteAvatar);
        }
        $user->delete();
        $alert = 'User ' . $user->name . ' has been deleted!';
        return redirect('admin/user')->with('success', $alert);
    }

    // Socialite Google
    public function auth_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();

        // Generate random password
        $generatePassword = Str::random(8);

        // data user notif new added
        $dataSignUp = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'password' => $generatePassword,
        ];

        $data = [
            'name' => $callback->getName(),
            'slug' => Str::slug($callback->getName(), '-'),
            'email' => $callback->getEmail(),
            'password' => Hash::make($generatePassword),
            'api_token' => Str::random(32),
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);

        // Kirim data sign up ke email tersebut
        \Mail::to($user->email)->send(new MailNotifySignUp($dataSignUp));

        Auth::login($user, true);

        return redirect('/admin/dashboard');
    }
}