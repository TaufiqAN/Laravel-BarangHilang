<?php

use App\Http\Controllers\AdminController;
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

Route::post('/dashboard', [SiswaController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard', [
        'data' => siswa::where('user_id', auth()->user()->id)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('user', function () {
    return view('dashboard', [
        'data' => siswa::where('user_id', auth()->user()->id)->get(),
    ]);
})->middleware(['auth', 'verified', 'role:user|admin']);

Route::get('userbaru', function () {
    return '<h1>Helo User baru</h1>';
})->middleware(['auth', 'verified', 'role_or_permission:edit-post|admin']);


Route::middleware(['auth', 'verified', 'role_or_permission:edit-post|admin'])->group(function () {
    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
    Route::resource('siswa', SiswaController::class);
    Route::get('/barang/{id}', [DetailController::class, 'show'])->name('barang.detail');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('barang/toggleSuspend/{id}', [AdminController::class, 'toggleSuspend'])->name('barang.toggleSuspend');
});

Route::post('/ketemu/{id}', [SiswaController::class, 'ketemu'])->middleware(['auth', 'verified', 'role:user|admin'])->name('ketemu');
Route::post('/batal/{id}', [SiswaController::class, 'batal'])->name('batal');

Route::post('/markSuspendedAsSeen', [SiswaController::class, 'markSuspendedAsSeen'])->name('markSuspendedAsSeen');


require __DIR__ . '/auth.php';
