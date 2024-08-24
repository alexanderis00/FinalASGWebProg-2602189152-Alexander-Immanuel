<?php   

use App\Http\Controllers\FriendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/home/filter', [HomeController::class, 'filter'])->name('home.filter');
Route::get('/home/search', [HomeController::class, 'search'])->name('home.search');
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/chat', function () {
    return view('chat');
})->name('chat');

Route::get('/videocall', function () {
    return view('videocall');
})->name('videocall');

Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/friend', [FriendController::class, 'store'])->name('friend.store');
    Route::get('/friends', [FriendController::class, 'index'])->name('friend.index');
    Route::delete('/friend/{id}', [FriendController::class, 'destroy'])->name('friend.destroy');
});
    
// require __DIR__.'/auth.php';

