<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Models\siswa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiswaController::class, 'beranda']);   

Route::get('/dashboard', function () {
    return view('dashboard', [
        'data' => siswa::orderBy('id', 'desc')->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin',function(){
    return '<h1>Helo Admin</h1>';
})->middleware(['auth', 'verified', 'role:admin']);

Route::get('user',function(){
    return '<h1>Helo User</h1>';
})->middleware(['auth', 'verified', 'role:user|admin']);

Route::get('userbaru',function(){
    return '<h1>Helo User baru</h1>';
})->middleware(['auth', 'verified', 'role_or_permission:edit-post|admin']);



Route::resource('siswa', SiswaController::class);

require __DIR__.'/auth.php';