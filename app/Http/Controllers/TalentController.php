<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Gallery;
use App\Models\Gender;
use App\Models\Notice;
use App\Models\Photo;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TalentController extends Controller
{
    // Index
    public function index($slug)
    {
        $user = User::where('slug', $slug)->first();
        $genders = Gender::all();

        // Dapatkan data notice berdasarkan user yang login
        $notices = Notice::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->take(4)->get();

        // Dapatkan data gallery berdasarkan user login
        // $galleries = Gallery::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->take(3)->get();

        // Count notice berdasarkan User yang login
        $noticeCount = Notice::where('user_id', Auth::user()->id)->count();
        // Count gallery berdasarkan User yang login

        $galleryCount = Photo::where('user_id', Auth::user()->id)->count();
        $galleryPhoto = Photo::where('user_id', $user->id)->orderBy('id', 'DESC')->take(3)->get();
        // return response()->json($galleryPhoto);
        return view('admin.talent.index', compact('user', 'genders', 'notices', 'galleryPhoto', 'noticeCount', 'galleryCount'));
    }
 
    public function countrySelect(Request $request)
    {
        $countries = [];
        if ($request->has('q')) {
            $countries = Country::select('name')->search($request->q)->get();
        } else {
            $countries = Country::select('name')->get();
        }

        return response()->json($countries);
    }

    public function skillSelect(Request $request)
    {
        $skills = [];
        if ($request->has('q')) {
            $skills = Skill::select('id', 'title')->search($request->q)->get();
        } else {
            $skills = Skill::select('id', 'title')->get();
        }

        return response()->json($skills);
    }

    public function talent_update(Request $request, $id)
    {
        $user = User::find($id);
        // validasi
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'country' => 'required',
                'city' => 'required',
                'skill' => 'required',
                'description' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            if ($request['skill']) {
                $request['skill'] = Skill::select('id', 'title')->whereIn('id', $request->skill)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Tester
        // return response()->json($request->all());

        // Jika validasi lolos lanjutkan ke proses create / insert data pada database
        DB::beginTransaction();
        try {

            // Mendapatkan nilai dari form create profile
            $user->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'country' => $request->country,
                'city' => $request->city,
                'description' => $request->description,
                'talent_status' => $request->status,
            ]);

            // Create Data Skill User
            $user->skills()->sync($request->skill);

            // Jika Berhasil maka kembalikan user pada halaman talent
            return redirect('/admin/talent/' . Auth::user()->slug)->with('success', 'Talent Berhasil dilengkapi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/talent/' . Auth::user()->slug)->with('error', 'Talent Gagal dilengkapi');
        } finally {
            DB::commit();
        }
    }

    public function talent_edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        $genders = Gender::all();
        return view('admin.talent.edit', compact('user', 'genders'));
    }

    // Skill action====================================================================================================
    // view skill create
    public function skill_create()
    {
        $skills = Skill::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.talent.skill.create', compact('skills'));
    }

    // Store skill
    public function skill_store(Request $request)
    {
        // Validator
        $data = $request->validate([
            'title' => 'required|unique:skills|min:3',
        ]);

        Skill::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);

        $message = $request->title . ' Has Been Added.!';
        return redirect('/admin/skill/create')->with('success', $message);
    }

    // destroy skill
    public function skill_destroy($id)
    {
        $skill = Skill::find($id);
        $skill->delete();
        $message = $skill->title . ' Has Been deleted.!';
        return redirect('/admin/skill/create')->with('success', $message);
    }

    // Skill action====================================================================================================
}
