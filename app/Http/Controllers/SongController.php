<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;

class SongController extends Controller
{
    
    public function index()
    {
        $songs = Song::all();
        return view('song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('song.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required'
        ]);

        Song::create([
            'title' => $request->input('title'),
            'artist' => $request->input('artist'),
            'genre' => $request->input('genre')
        ]);

        return redirect('/song'); //--------------Šo vajadzēs samainīt!!!!!!
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $allPlaylists=Playlist::all();
       return view('song.show', ['song' => $song,'allPlaylists' => $allPlaylists]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the playlist by its ID
        $song = Song::findOrFail($id);

        // Pass the playlist to the view
        return view('song.edit', ['song' => $song]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required'
        ]);

        if ($request->user()->id == auth()->user()->id) {
            Song::where('id', $id)
                ->update([
                    'title' => $request->input('title'),
                    'artist' => $request->input('artist'),
                    'genre' => $request->input('genre')
        ]);
    }

    return redirect('/song'); //--------------Šo vajadzēs samainīt!!!!!!
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $song = Song::where('id', $id);

        $song->delete();

        return redirect('/song'); //--------------Šo vajadzēs samainīt!!!!!!
    }

    public function addPlaylist(Request $request, Playlist $playlist) {
        if ($playlist->songs->contains($request['song'])) {
            return redirect()->back()->with('error', 'Song is already in the playlist.');
        }

        $playlist->songs()->attach($request['song']);
        return redirect('/playlist/' . $playlist->id)->with('success', 'Song added successfully!');
    }

    public function removePlaylist(Request $request, Playlist $playlist) {

        $playlist->songs()->detach($request['song']);
        return redirect('/playlist/' . $playlist->id)->with('success', 'Song removed successfully!');
    }
}
