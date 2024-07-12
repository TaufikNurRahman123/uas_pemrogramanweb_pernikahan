<?php

namespace App\Http\Controllers;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Preferensi;
use App\Models\User;
use App\Models\Normalisasi;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class Controllers extends Controller
{

    public function dashboard(){

        $user = Auth::user();


        $alts = $user->alternatifs()->paginate(6);
        $bbt = $user->bobots->first()->toArray();
        $kr = $user->kriterias->keyBy('alt_id');
        return view('alternatif.dashboard', ['alts' => $alts, 'bbt' => $bbt, 'krs' => $kr]);
    }
    
    public function deleteAlter(string $id){
        $user = Auth::user();
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        $krs = $user->kriterias->keyBy('alt_id');

        $maxValues = [];
        $minValues = [];

        foreach (['c1', 'c2', 'c3', 'c4', 'c5'] as $kr) {
            $maxValues[$kr] = $krs->max($kr);
            $minValues[$kr] = $krs->min($kr);
        }
        
        $normalisasi = $krs->map(function ($item, $key) use ($maxValues, $minValues) {
            $kategori = $item['kategori'] === 1;
            $norm = [
                'c1' => $kategori ? $item['c1'] / $maxValues['c1'] : $minValues['c1'] / $item['c1'],
                'c2' => $kategori ? $item['c2'] / $maxValues['c2'] : $minValues['c2'] / $item['c2'],
                'c3' => $kategori ? $item['c3'] / $maxValues['c3'] : $minValues['c3'] / $item['c3'],
                'c4' => $kategori ? $item['c4'] / $maxValues['c4'] : $minValues['c4'] / $item['c4'],
                'c5' => $kategori ? $item['c5'] / $maxValues['c5'] : $minValues['c5'] / $item['c5'],
                'kr_id' => $item->id,
                'user_id' => $item->user_id
            ];
            return $norm;
        });
        
        // dd($normalisasi);

        $normalisasi->each(function ($norm) {
            Normalisasi::updateOrCreate(
                ['kr_id' => $norm['kr_id'], 'user_id' => $norm['user_id']],
                [
                    'c1' => $norm['c1'],
                    'c2' => $norm['c2'],
                    'c3' => $norm['c3'],
                    'c4' => $norm['c4'],
                    'c5' => $norm['c5'],
                ]
            );
        });

        $bbt = $user->bobots->first()->toArray();
        // dd($bbt);
        $preferensi = $normalisasi->map(function ($norm) use ($bbt) {
            $preferenceValue = $norm['c1'] * $bbt['b1']/100 +
                               $norm['c2'] * $bbt['b2']/100 +
                               $norm['c3'] * $bbt['b3']/100 +
                               $norm['c4'] * $bbt['b4']/100 +
                               $norm['c5'] * $bbt['b5']/100;
    
            return [
                'kr_id' => $norm['kr_id'],
                'user_id' => $norm['user_id'],
                'v' => $preferenceValue
            ];
        });
    
        // Save or update the preference values in the database
        $preferensi->each(function ($pref) {
            Preferensi::updateOrCreate(
                ['kr_id' => $pref['kr_id'], 'user_id' => $pref['user_id']],
                ['v' => $pref['v']]
            );
        });

        return redirect()->back()->with('success', 'Data deleted successfully');;
    }
    
    public function cariAlt(Request $request){
        $user = Auth::user();
        $bbt = $user->bobots->first()->toArray();
        $cari = $request->cari;

        $alts = $user->alternatifs()->where('a', 'like', '%' . $cari . '%')->paginate(6);
        $kr = $user->kriterias->keyBy('alt_id');

        return view('alternatif.dashboard', ['bbt' => $bbt, 'alts' => $alts, 'krs' => $kr]);
    }
    public function tambahAlter(){
        $user = Auth::user();
        $bbt = $user->bobots->first()->toArray();
        return view('alternatif.tambah', ['bbt' => $bbt]);

    }
    public function tambahAlt(Request $request){
        $user = Auth::user();

        $request->validate([
            'alternatif'  => 'required',
        ]);

        $alt = $request->alternatif;
        $c1 = $request->c1;
        $c2 = $request->c2;
        $c3 = $request->c3;
        $c4 = $request->c4;
        $c5 = $request->c5;
        // dd($c5);

        $alternatif = Alternatif::create([
            'a' => $alt,
            'user_id' => $user->id
        ]);

        Kriteria::create([
            'kategori' => 1,
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'c4' => $c4,
            'c5' => $c5,
            'alt_id' => $alternatif->id,
            'user_id' => $user->id
        ]);

        $krs = $user->kriterias->keyBy('alt_id');

        $maxValues = [];
        $minValues = [];

        foreach (['c1', 'c2', 'c3', 'c4', 'c5'] as $kr) {
            $maxValues[$kr] = $krs->max($kr);
            $minValues[$kr] = $krs->min($kr);
        }
        
        $normalisasi = $krs->map(function ($item, $key) use ($maxValues, $minValues) {
            $kategori = $item['kategori'] === 1;
            $norm = [
                'c1' => $kategori ? $item['c1'] / $maxValues['c1'] : $minValues['c1'] / $item['c1'],
                'c2' => $kategori ? $item['c2'] / $maxValues['c2'] : $minValues['c2'] / $item['c2'],
                'c3' => $kategori ? $item['c3'] / $maxValues['c3'] : $minValues['c3'] / $item['c3'],
                'c4' => $kategori ? $item['c4'] / $maxValues['c4'] : $minValues['c4'] / $item['c4'],
                'c5' => $kategori ? $item['c5'] / $maxValues['c5'] : $minValues['c5'] / $item['c5'],
                'kr_id' => $item->id,
                'user_id' => $item->user_id
            ];
            return $norm;
        });
        
        // dd($normalisasi);

        $normalisasi->each(function ($norm) {
            Normalisasi::updateOrCreate(
                ['kr_id' => $norm['kr_id'], 'user_id' => $norm['user_id']],
                [
                    'c1' => $norm['c1'],
                    'c2' => $norm['c2'],
                    'c3' => $norm['c3'],
                    'c4' => $norm['c4'],
                    'c5' => $norm['c5'],
                ]
            );
        });

        $bbt = $user->bobots->first()->toArray();
        // dd($bbt);
        $preferensi = $normalisasi->map(function ($norm) use ($bbt) {
            $preferenceValue = $norm['c1'] * $bbt['b1']/100 +
                               $norm['c2'] * $bbt['b2']/100 +
                               $norm['c3'] * $bbt['b3']/100 +
                               $norm['c4'] * $bbt['b4']/100 +
                               $norm['c5'] * $bbt['b5']/100;
    
            return [
                'kr_id' => $norm['kr_id'],
                'user_id' => $norm['user_id'],
                'v' => $preferenceValue
            ];
        });
    
        $preferensi->each(function ($pref) {
            Preferensi::updateOrCreate(
                ['kr_id' => $pref['kr_id'], 'user_id' => $pref['user_id']],
                ['v' => $pref['v']]
            );
        });

        return redirect('dashboard');
    }



    public function preferensi(){
        $user = Auth::user();

    

        $bbt = $user->bobots->first()->toArray();
        $pf = $user->preferensi;
        $alt = $user->alternatifs;
        return view('alternatif.preferensi', ['bbt' => $bbt, 'alt' => $alt, 'pf' => $pf]);

    }

     public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    // Handle login attempt
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect()->route('dashboard')->with('error', 'Anda harus verifikasi email terlebih dahulu.');
        }
        return redirect()->intended('dashboard');
    } else {
        return redirect()->route('login')->with('error', 'Gagal Masuk Email atau Password Salah');
    }
    }

    public function daftar()
    {
        return view('daftar');
    }

    public function daftarAkun(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
        ]);

        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
        ]);

        Auth::login($user);
        event(new Registered($user));

        return redirect()->intended('email/verify');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check if the user already exists
            $findUser = User::where('id_google', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                if (!$findUser->hasVerifiedEmail()) {
                    Auth::logout();
                    return redirect()->route('perhitungan');
                } else {                  
                    return redirect()->intended('dashboard');}
            } else {
                $newUser = User::create([
                    'nama' => $user->name,
                    'email' => $user->email,
                    'id_google' => $user->id,
                    'email_verified_at' => now(),
                ]);

                Auth::login($newUser);
                event(new Registered($newUser));

                return redirect()->intended('email/verify');
            }
        } catch (Exception $e) {
            \Log::error('Google login error: ', ['error' => $e->getMessage()]);
            return redirect('/login')->with('error', 'There was an issue logging in with Google. Please try again.');
        }
    }

    public function perhitungan(){
        $user = Auth::user();


        $alts = $user->alternatifs()->paginate(8);
        $bbt = $user->bobots->first()->toArray();
        $norms = $user->normalisasi->keyBy('kr_id');
        $pfs = $user->preferensi->keyBy('kr_id'); 
        // dd($pfs);
        return view('perhitungan.index', ['alts' => $alts, 'bbt' => $bbt, 'norms' => $norms, 'pfs' => $pfs]);
    }
    
    public function cariAltNorm(Request $request){
        $user = Auth::user();
        $bbt = $user->bobots->first()->toArray();
        $cari = $request->cari;
        
        $alts = $user->alternatifs()->where('a', 'like', '%' . $cari . '%')->paginate(8);
        $norms = $user->normalisasi->keyBy('kr_id');
        $pfs = $user->preferensi->keyBy('kr_id'); 
        
        return view('perhitungan.index', ['alts' => $alts, 'bbt' => $bbt, 'norms' => $norms, 'pfs' => $pfs]);
    }
    
    public function rangking(){
        $user = Auth::user();
        
        $alts = $user->alternatifs()->get();
        $bbt = $user->bobots->first()->toArray();
        $norms = $user->normalisasi->keyBy('kr_id');
        $pfs = $user->preferensi->keyBy('kr_id');
        
        $alts = $alts->map(function($alt) use ($pfs) {
            $alt->preferensi = isset($pfs[$alt->id]) ? $pfs[$alt->id]->v : 0;
            return $alt;
        })->sortByDesc('preferensi');
        
        $perPage = 8;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $alts->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $alts = new LengthAwarePaginator($currentItems, $alts->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        
        return view('perhitungan.ranking', ['alts' => $alts, 'bbt' => $bbt, 'norms' => $norms, 'pfs' => $pfs]);
    }
    
    public function edit(String $id){
        $user = Auth::user();
        
        $alt = $user->alternatifs->where('id', $id)->first();
        $bbt = $user->bobots->first()->toArray();
        $kr = $user->kriterias()->where('alt_id', $alt->id)->first();
        // dd($kr);
        return view('edit.index' , ['alt' => $alt, 'bbt' => $bbt, 'kr' => $kr]);
    }
    
    public function update(Request $request, String $id){
        $user = Auth::user();
        
        $request->validate([
            'alternatif'  => 'required',
        ]);
        
        $alt = $request->alternatif;
        $c1 = $request->c1;
        $c2 = $request->c2;
        $c3 = $request->c3;
        $c4 = $request->c4;
        $c5 = $request->c5;
        $alts = $user->alternatifs->where('id', $id)->first();
        
        $alt = $user->alternatifs->where('id', $id)->first()->update([
            'a' => $alt,
            'user_id' => $user->id
        ]);
        
        $bbt = $user->bobots->first()->toArray();
        $kr = $user->kriterias()->where('alt_id', $alts->id)->first()->update([
            'kategori' => 1,
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'c4' => $c4,
            'c5' => $c5,
            'alt_id' => $alts->id,
            'user_id' => $user->id
        ]);;
        
        $krs = $user->kriterias->keyBy('alt_id');
        
        $maxValues = [];
        $minValues = [];
        
        foreach (['c1', 'c2', 'c3', 'c4', 'c5'] as $kr) {
            $maxValues[$kr] = $krs->max($kr);
            $minValues[$kr] = $krs->min($kr);
        }
        
        $normalisasi = $krs->map(function ($item, $key) use ($maxValues, $minValues) {
            $kategori = $item['kategori'] === 1;
            $norm = [
                'c1' => $kategori ? $item['c1'] / $maxValues['c1'] : $minValues['c1'] / $item['c1'],
                'c2' => $kategori ? $item['c2'] / $maxValues['c2'] : $minValues['c2'] / $item['c2'],
                'c3' => $kategori ? $item['c3'] / $maxValues['c3'] : $minValues['c3'] / $item['c3'],
                'c4' => $kategori ? $item['c4'] / $maxValues['c4'] : $minValues['c4'] / $item['c4'],
                'c5' => $kategori ? $item['c5'] / $maxValues['c5'] : $minValues['c5'] / $item['c5'],
                'kr_id' => $item->id,
                'user_id' => $item->user_id
            ];
            return $norm;
        });
        
        // dd($normalisasi);
        
        $normalisasi->each(function ($norm) {
            Normalisasi::updateOrCreate(
                ['kr_id' => $norm['kr_id'], 'user_id' => $norm['user_id']],
                [
                    'c1' => $norm['c1'],
                    'c2' => $norm['c2'],
                    'c3' => $norm['c3'],
                    'c4' => $norm['c4'],
                    'c5' => $norm['c5'],
                    ]
                );
            });
            
            $bbt = $user->bobots->first()->toArray();
            // dd($bbt);
            $preferensi = $normalisasi->map(function ($norm) use ($bbt) {
                $preferenceValue = $norm['c1'] * $bbt['b1']/100 +
                $norm['c2'] * $bbt['b2']/100 +
                $norm['c3'] * $bbt['b3']/100 +
                $norm['c4'] * $bbt['b4']/100 +
                $norm['c5'] * $bbt['b5']/100;
                
                return [
                    'kr_id' => $norm['kr_id'],
                    'user_id' => $norm['user_id'],
                    'v' => $preferenceValue
                ];
            });
            
            $preferensi->each(function ($pref) {
                Preferensi::updateOrCreate(
                    ['kr_id' => $pref['kr_id'], 'user_id' => $pref['user_id']],
                    ['v' => $pref['v']]
                );
            });
            // dd($kr);
            return redirect('dashboard');
    }        
        
    public function editBbt(){
        $user = Auth::user();
    
    
        $bbt = $user->bobots->first()->toArray();
        // dd($pfs);
        return view('edit.edit-bbt', ['bbt' => $bbt]);
    }
    
    public function updateBbt(Request $request){
        $user = Auth::user();
        
        $request->validate([
            'b1'  => 'required|numeric',
            'b2'  => 'required|numeric',
            'b3'  => 'required|numeric',
            'b4'  => 'required|numeric',
            'b5'  => 'required|numeric'
        ]);
        
        $b1 = $request->b1;
        $b2 = $request->b2;
        $b3 = $request->b3;
        $b4 = $request->b4;
        $b5 = $request->b5;
        
        $total = $b1 + $b2 + $b3 + $b4 + $b5;
        // dd($total);
        if ($total != 100) {
            // return redirect('edit/bobot')->withErrors('error', 'Total bobot harus 100!');
            return redirect()->back()->with('error', 'Total bobot harus 100!');
        }

        $bbt = $user->bobots()->where('user_id', $user->id)->first()->update([
            'b1' => $b1,
            'b2' => $b2,
            'b3' => $b3,
            'b4' => $b4,
            'b5' => $b5,
            'user_id' => $user->id
        ]);;

        $krs = $user->kriterias->keyBy('alt_id');
        
        $maxValues = [];
        $minValues = [];
        
        foreach (['c1', 'c2', 'c3', 'c4', 'c5'] as $kr) {
            $maxValues[$kr] = $krs->max($kr);
            $minValues[$kr] = $krs->min($kr);
        }
        
        $normalisasi = $krs->map(function ($item, $key) use ($maxValues, $minValues) {
            $kategori = $item['kategori'] === 1;
            $norm = [
                'c1' => $kategori ? $item['c1'] / $maxValues['c1'] : $minValues['c1'] / $item['c1'],
                'c2' => $kategori ? $item['c2'] / $maxValues['c2'] : $minValues['c2'] / $item['c2'],
                'c3' => $kategori ? $item['c3'] / $maxValues['c3'] : $minValues['c3'] / $item['c3'],
                'c4' => $kategori ? $item['c4'] / $maxValues['c4'] : $minValues['c4'] / $item['c4'],
                'c5' => $kategori ? $item['c5'] / $maxValues['c5'] : $minValues['c5'] / $item['c5'],
                'kr_id' => $item->id,
                'user_id' => $item->user_id
            ];
            return $norm;
        });
        
        // dd($normalisasi);
        
        $normalisasi->each(function ($norm) {
            Normalisasi::updateOrCreate(
                ['kr_id' => $norm['kr_id'], 'user_id' => $norm['user_id']],
                [
                    'c1' => $norm['c1'],
                    'c2' => $norm['c2'],
                    'c3' => $norm['c3'],
                    'c4' => $norm['c4'],
                    'c5' => $norm['c5'],
                    ]
                );
            });
            
            $bbt = $user->bobots->first()->toArray();
            // dd($bbt);
            $preferensi = $normalisasi->map(function ($norm) use ($b1, $b2, $b3, $b4, $b5) {
                $preferenceValue = $norm['c1'] * $b1/100 +
                $norm['c2'] * $b2/100 +
                $norm['c3'] * $b3/100 +
                $norm['c4'] * $b4/100 +
                $norm['c5'] * $b5/100;
                
                return [
                    'kr_id' => $norm['kr_id'],
                    'user_id' => $norm['user_id'],
                    'v' => $preferenceValue
                ];
            });
            
            $preferensi->each(function ($pref) {
                Preferensi::updateOrCreate(
                    ['kr_id' => $pref['kr_id'], 'user_id' => $pref['user_id']],
                    ['v' => $pref['v']]
                );
            });
            // dd($kr);
            return redirect()->back()->with('success', 'Bobot berhasil diupdate.');
    }    

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to the login page or any other page
        return redirect('login')->with('status', 'Anda telah berhasil logout.');
    }

    public function profile(){
        $user = Auth::user();
        $bbt = $user->bobots->first()->toArray();
        return view('alternatif.profile', ['bbt' => $bbt, 'user' => $user]);
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
    
        // Validate the input
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:8|confirmed',
        ]);
    
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $emailChanged = $user->email !== $email;
    
        // Check if the user is using Google Sign-In or any other external provider
        $hasGoogleAccount = !is_null($user->id_google);
    
        // If the email has changed and the user is using an external provider, handle accordingly
        if ($emailChanged && $hasGoogleAccount) {
            return back()->withErrors(['email' => 'Cannot change email address linked with Google account.']);
        }
    
        // Prepare the data for updating the user
        $updateData = [
            'nama' => $nama,
            'email' => $email,
        ];
    
        // Only update the password if it was provided
        if (!empty($password)) {
            $updateData['password'] = Hash::make($password);
        }
    
        // Update the user
        $user->update($updateData);
    
        // Handle email change verification if not linked to an external provider
        if ($emailChanged) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
            return redirect('login');
        }
    
        $bbt = $user->bobots->first()->toArray();
        return view('alternatif.profile', ['bbt' => $bbt, 'user' => $user]);
    
    }        
        
    public function deleteAcc(Request $request, string $id){
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('status', 'Akun berhasil dihapus');;
    }
}
