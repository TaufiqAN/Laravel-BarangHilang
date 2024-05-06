<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Models\siswa;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [SiswaController::class, 'beranda'])->name('welcome');   

Route::get('/dashboard', function () {
    return view('dashboard', [
        'data' => siswa::orderBy('id', 'desc')->get(),
        // 'data' => siswa::where('user_id', auth()->user()->id)->get(),
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

Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');

Route::resource('siswa', SiswaController::class);

Route::get('/barang/{id}', [DetailController::class, 'show'])->name('barang.detail');

Route::get('/search', [SiswaController::class, 'search']);

Route::post('/ketemu/{id}', [SiswaController::class, 'ketemu'])->middleware(['auth', 'verified', 'role:user|admin'])->name('ketemu');

Route::post('/batal/{id}', [SiswaController::class, 'batal'])->name('batal');


require __DIR__.'/auth.php';
