<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OneSignal;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::query()->with(['user', 'genre']);
        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $games->where('title', 'LIKE', '%' . request('search') . '%');
        }
        $search = request('search') ?? '';
        $games = $games->latest()->paginate(5);
        return view('admin.game.index', compact('games', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        $statuses = $this->statuses();
        $devices = Device::select('id', 'title')->get();
        return view('admin.game.create', compact('genres', 'statuses', 'devices'));
    }


    public function select(Request $request)
    {
        $devices = [];
        if ($request->has('q')) {
            $devices = Device::select('id', 'title')->search($request->q)->get();
        } else {
            $devices = Device::select('id', 'title')->limit(5)->get();
        }

        return response()->json($devices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'genre' => 'required',
                'description' => 'required',
                'thumbnail' => 'required',
                'content' => 'required',
                'device' => 'required',
                'status' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['device']) {
                $request['device'] = Device::select('id', 'title')->whereIn('id', $request->device)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // 1st method push/insert
        DB::beginTransaction();
        try {
            $game = Game::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title . '-' . rand(1000, 9999)),
                'genre_id' => $request->genre,
                'description' => $request->description,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'content' => $request->content,
                'trailer' => $request->trailer,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            $game->devices()->attach($request->device);
            $slug = Str::slug($request->title);
            if ($request->status == 'publish') {
                OneSignal::sendNotificationToAll(
                    "Hai sobat Imajora, kita ada postingan baru nih.",
                    $url = "http://localhost:8000/game/$slug#details",
                );
            }
            return redirect('/admin/game')->with('success', 'New game has been added!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/game')->with('error', 'GAGAL MENAMBAH GAME');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $genres = Genre::all();
        $statuses = $this->statuses();
        $game = Game::where('slug', $slug)->first();
        return view('admin.game.edit', compact('genres', 'statuses', 'game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        // Validasi
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'genre' => 'required',
                'description' => 'required',
                'thumbnail' => 'required',
                'content' => 'required',
                'device' => 'required',
                'status' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['device']) {
                $request['device'] = Device::select('id', 'title')->whereIn('id', $request->device)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // 1st method push/insert
        DB::beginTransaction();
        try {
            $game->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title . '-' . rand(1000, 9999)),
                'genre_id' => $request->genre,
                'description' => $request->description,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'content' => $request->content,
                'trailer' => $request->trailer,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            $game->devices()->sync($request->device);
            $slug = Str::slug($request->title);
            if ($request->status == 'publish') {
                OneSignal::sendNotificationToAll(
                    "Hai sobat Imajora, kita ada postingan baru nih.",
                    $url = "http://localhost:8000/game/$slug#details",
                );
            }
            return redirect('/admin/game')->with('success', 'Game has been Updated!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/game')->with('error', 'GAGAL UPDATE GAME');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        DB::beginTransaction();
        try {
            $game->devices()->detach();
            $game->delete();
            return redirect('/admin/game')->with('success', 'Game has been DELETED!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/game')->with('error', 'GAGAL DELETED GAME');
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function statuses()
    {
        return [
            'draft' => 'draft',
            'publish' => 'publish',
        ];
    }
}