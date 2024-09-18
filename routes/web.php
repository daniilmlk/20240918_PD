<?php
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('playlist', PlaylistController::class);
Route::post('playlist/{playlist}/addsong',[PlaylistController::class, 'addSong'])->name('playlist.addsong');
Route::post('playlist/{playlist}/removesong',[PlaylistController::class, 'removeSong'])->name('playlist.removesong');
Route::resource('song', SongController::class);
Route::post('song/{song}/addplaylist',[SongController::class, 'addPlaylist'])->name('song.addplaylist');
Route::post('song/{song}/removeplaylist',[SongController::class, 'removePlaylist'])->name('song.removeplaylist');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
