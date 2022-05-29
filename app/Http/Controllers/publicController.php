<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\admin_notification;
use App\Models\admin;
use App\Models\book_category_detail;
use App\Models\book_category;
use App\Models\book_image;
use App\Models\book_review;
use App\Models\book;
use App\Models\cart;
use App\Models\courier;
use App\Models\discount;
use App\Models\response;
use App\Models\transaction_detail;
use App\Models\transaction;
use App\Models\user_notification;
use App\Models\User;
use Carbon\Carbon;


class publicController extends Controller
{
    public function landing()
    {
        $data = book::latest()->get();
        $datas = book_image::latest()->get();
        $diskon = discount::latest()->get();
        $time = Carbon::now();
        $waktu = Carbon::now();

        return view('landing', compact('data', 'datas', 'time', 'diskon'));
    }

    // public function login()
    // {
    //     return view('login');
    // }

    // public function login_auth(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', '=', $request->email)->first();
    //     if ($user) {
    //         $pass = Hash::check($request->password, $user->password);
    //     } else {
    //         $pass = null;
    //     }

    //     if ($user && $pass) {
    //         if (strcasecmp($user->status, 'Belum Terverifikasi')) {
    //             return back()->with(['warning' => 'Memerlukan Verifikasi Via Email']);
    //         } else {
    //             $auth = Auth::guard('user');
    //             if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
    //                 if ($auth->attempt($request->only('email', 'password'))) {
    //                     $request->session()->regenerate();
    //                     return redirect()->intended('/beranda');
    //                 } else {
    //                     return redirect()->back()->with(['error' => 'Login Gagal']);
    //                 }
    //             } else {
    //                 return redirect()->back()->with(['error' => 'Login Gagal']);
    //             }
    //         }
    //     } else {
    //         return redirect()->back()->with(['error' => 'Login Gagal']);
    //     }
    // }

    // public function register()
    // {
    //     return view('register');
    // }
    // public function register_submit(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nama' => 'required|min:3|max:30',
    //         'email' => 'required|unique:users',
    //         'password' => 'required|min:8|max:20',
    //         'konfirmasi' => 'required|min:8|max:20'
    //     ]);

    //     if ($request->password == $request->konfirmasi) {
    //         $user_data = array(
    //             'name' => $request->nama,
    //             'email' => $request->email,
    //             'password' => $request->password,
    //             'status' => 'Belum Terverifikasi'
    //         );
    //         $user_data['password'] = Hash::make($user_data['password']);
    //         User::create($user_data);
    //         return redirect()->route('register')->with(['success' => 'Berhasil Register']);
    //     } else {
    //         return redirect()->back()->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
    //     }
    // }
}
