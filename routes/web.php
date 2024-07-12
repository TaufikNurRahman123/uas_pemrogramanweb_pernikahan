<?php

use App\Models\User;
use App\Http\Controllers\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::middleware('auth.check')->group(function () {
  Route::post('dashboard', [Controllers::class, 'hasil']);
  Route::get('dashboard', [Controllers::class, 'dashboard']);
  Route::get('dashboard/{id}/edit', [Controllers::class, 'edit']);
  Route::patch('dashboard/{id}', [Controllers::class, 'update']);
  Route::get('dashboard/cari', [Controllers::class, 'cariAlt']);
  Route::get('/', [Controllers::class, 'dashboard']);
  Route::delete('dashboard/{id}', [Controllers::class, 'deleteAlter']);
  Route::post('tambah-alter', [Controllers::class, 'tambahAlt']);
  Route::get('tambah-alter', [Controllers::class, 'tambahAlter']);
  
  Route::get('preferensi', [Controllers::class, 'preferensi']);
  Route::get('perhitungan/cari', [Controllers::class, 'cariAltNorm']);
  Route::get('perhitungan/ranking', [Controllers::class, 'rangking']);
  Route::get('perhitungan', [Controllers::class, 'perhitungan']);

  Route::get('edit', [Controllers::class, 'edit']);
  Route::patch('edit/bobot', [Controllers::class, 'updateBbt']);
  Route::get('edit/bobot', [Controllers::class, 'editBbt']);
  
  Route::get('logout', [Controllers::class, 'logout']);

  Route::get('profile', [Controllers::class, 'profile']);
  Route::post('profile', [Controllers::class, 'profileUpdate']);
  Route::delete('profile/{id}', [Controllers::class, 'deleteAcc']);
});

Route::get('auth/google', [Controllers::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [Controllers::class, 'handleGoogleCallback']);
// Login Register
Route::get('login', [Controllers::class, 'login'])->name('login');
Route::post('login', [Controllers::class, 'loginUser']);
Route::get('daftar', [Controllers::class, 'daftar'])->name('daftar');
Route::post('daftar', [Controllers::class, 'daftarAkun']);

Route::middleware('auth')->group(function () {
  Route::get('email/verify', function () {
    return view('verify-email');
  })->name('verification.notice');

  Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login');
  })->middleware(['signed'])->name('verification.verify');

  Route::post('email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('lupa-password', function () {
  return view('lupa-password');
})->middleware('guest');

Route::post('lupa-password', function (Request $request) {
  $request->validate(['email' => 'required|email']);

  $status = Password::sendResetLink(
      $request->only('email')
  );

  return $status === Password::RESET_LINK_SENT
              ? back()->with(['status' => "Email Reset Password sudah dikirim."])
              : back()->with(['error' => __($status)]);
})->middleware('guest');

Route::get('reset-password/{token}', function (string $token) {
  return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('reset-password', function (Request $request) {
  $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
  ]);

  $status = Password::reset(
      $request->only('email','password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
          $user->forceFill([
              'password' => Hash::make($password)
          ])->setRememberToken(Str::random(60));

          $user->save();

          event(new PasswordReset($user));
      }
  );

  return $status === Password::PASSWORD_RESET
              ? redirect()->route('login')->with('status', "Password berhasil diupdate.")
              : back()->with(['error' => [__($status)]]);
})->middleware('guest');