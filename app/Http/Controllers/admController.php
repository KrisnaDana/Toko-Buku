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

class admController extends Controller
{
    public function login()
    {
        return view('adm-login');
    }

    public function login_auth(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = admin::where('username', '=', $request->username)->first();
        if ($admin) {
            $pass = Hash::check($request->password, $admin->password);
        } else {
            $pass = null;
        }
        if ($admin && $pass) {
            $auth = Auth::guard('admin');
            if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
                if ($auth->attempt($request->only('username', 'password'))) {
                    $request->session()->regenerate();
                    return redirect()->intended('/adm/beranda');
                } else {
                    return redirect()->back()->with(['error' => 'Login Gagal']);
                }
            }
        }
        return redirect()->back()->with(['error' => 'Login Gagal']);
    }

    public function register()
    {
        return view('adm-register');
    }

    public function register_submit(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:admins',
            'nama' => 'required|min:3|max:30',
            'phone' => 'required|min:3|max:12',
            'password' => 'required|min:8|max:20',
            'konfirmasi' => 'required|min:8|max:20'
        ]);

        if ($request->password == $request->konfirmasi) {
            $admin_data = array(
                'username' => $request->username,
                'password' => $request->password,
                'name' => $request->nama,
                'phone' => $request->phone
            );
            $admin_data['password'] = Hash::make($admin_data['password']);
            admin::create($admin_data);
            return redirect()->route('adm-register')->with(['success' => 'Berhasil Register']);
        } else {
            return redirect()->back()->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
        }
    }

    public function beranda(Request $request)
    {
        
        $notifikasi = admin_notification::all();
        $now = Carbon::now('Asia/Makassar');
        $allTransactions = Transaction::where('status', 'barang telah sampai di tujuan')->get();
        //dd($allTransactions);
        $allSales = Transaction::where('status', 'barang telah sampai di tujuan')->count();
        $monthlySales = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', $now->month)->count();
        $annualSales = Transaction::where('status', 'barang telah sampai di tujuan')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Transaction::where('status', 'barang telah sampai di tujuan')->whereYear('created_at', $now->year)->get();
        //dd($allTransactions);
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal += $transaction->total;
        }


        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly += $monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual += $annual->total;
        }


        $january = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '01')->count();
        $february = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '02')->count();
        $march = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '03')->count();
        $april = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '04')->count();
        $may = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '05')->count();
        $june = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '06')->count();
        $july = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '07')->count();
        $august = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '08')->count();
        $september = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '09')->count();
        $october = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '10')->count();
        $november = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '11')->count();
        $december = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '12')->count();

        $jan = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '01')->sum('total');
        $feb = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '02')->sum('total');
        $mar = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '03')->sum('total');
        $ap = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '04')->sum('total');
        $mei = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '05')->sum('total');
        $jun = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '06')->sum('total');
        $jul = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '07')->sum('total');
        $aug = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '08')->sum('total');
        $sept = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '09')->sum('total');
        $octo = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '10')->sum('total');
        $nove = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '11')->sum('total');
        $dece = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '12')->sum('total');

        return view('adm-beranda', compact('notifikasi','now','allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
    ,'jan','feb','mar','ap','mei','jun','jul','aug','sept','octo','nove','dece'));
    }

    public function logout(Request $request)
    {
        $auth = Auth::guard('admin');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            $auth->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landing');
        }
    }

    public function profil()
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $profil = admin::find($admin_id);
        return view('adm.profile', compact('profil'));
    }

    public function profil_submit($id, Request $request)
    {
        if (!empty($request->profile_image)) {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:30',
                'phone' => 'required|min:3|max:12',
                'profile_image' => 'required|file|image|max:8192'
            ]);
            $admin = admin::find($id);

            $image = $request->file('profile_image');
            $image_name = rand() . "." . $image->getClientOriginalExtension();

            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->profile_image = $image_name;
            $admin->save();

            $image->move(public_path('profile_image'), $image_name);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:30',
                'phone' => 'required|min:3|max:12'
            ]);

            $admin = admin::find($id);
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->save();
        }

        return redirect()->route('adm-profil');
    }

    public function detailbuku($id)
    {
        $book = book::find($id);
        $book_image = book_image::where('book_id', '=', $id)->get();
        $book_review = book_review::where('book_id', '=', $id)->get();

        $tanggal = Carbon::now()->format('Y-m-d');
        $discount = discount::where('book_id', '=', $id)->where('start', '<=', $tanggal)->where('end', '>=', $tanggal)->get();

        if (count($discount) > 0) {
            $harga = $book->price;
            foreach ($discount as $discounts) {
                $harga = $harga - ($harga * $discounts->percentage / 100);
            }
            if (count($book_review) > 0) {
                return view('adm.detailbuku', compact('book', 'book_image', 'discount', 'harga', 'book_review'));
            } else {
                return view('adm.detailbuku', compact('book', 'book_image', 'discount', 'harga'));
            }
        } else {
            if (count($book_review) > 0) {
                return view('adm.detailbuku', compact('book', 'book_image', 'book_review'));
            } else {
                return view('adm.detailbuku', compact('book', 'book_image'));
            }
        }
    }

    public function response_submit($id, Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $admin_id = Auth::guard('admin')->user()->id;
        $response = array(
            'review_id' => $id,
            'admin_id' => $admin_id,
            'content' => $request->content
        );
        response::create($response);

        $review = DB::Table('book_reviews')->where('id', $id)->value('user_id');
        $buku_id = DB::Table('book_reviews')->where('id', $id)->first();
        $user = User::find($review);

        //Notif User
        $data = [
            'nama' => 'Admin',
            'message' => 'review anda direspon!',
            'id' => $buku_id->book_id,
            'category' => 'review'
        ];
        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);
        return redirect()->back();
    }


    public function transaksi()
    {
        $transaction = transaction::orderBy('id', 'DESC')->paginate(10);
        Paginator::useBootstrap();
        $tanggal = Carbon::now();
        $interval = array();
        foreach ($transaction as $transactions) {
            if ($transactions->status == "menunggu bukti pembayaran" && $transactions->timeout < $tanggal) {
                $transactions->status = "transaksi expired";
                $transactions->save();
            }

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $transactions->timeout)->toDateTimeString();
            $countdown = $tanggal->diffAsCarbonInterval($date);
            array_push($interval, $countdown);
        }

        return view('adm.transaksi', compact('transaction', 'interval'));
    }

    public function transaksi_detail($id)
    {
        $transaction = transaction::find($id);
        $transaction_detail = transaction_detail::where('transaction_id', '=', $id)->get();
        $transaction_detail_id = transaction_detail::where('transaction_id', '=', $id)->first();
        $user = User::find($transaction->user_id);
        $tanggal = Carbon::now();
        if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout < $tanggal) {
            $transaction->status = "transaksi expired";
            $transaction->save();



            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        } else if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout >= $tanggal) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->timeout);
            $interval = $tanggal->diffAsCarbonInterval($date);

            return view('adm.transaksi-detail', compact('transaction', 'interval', 'transaction_detail'));
        } else if ($transaction->status == "sudah terverifikasi") {

            

            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        } else if ($transaction->status == "transaksi dibatalkan") {

            

            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        } else if ($transaction->status == "barang dalam pengiriman") {

            

            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        } else if ($transaction->status == "barang telah sampai di tujuan") {
           
            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        } else {
            return view('adm.transaksi-detail', compact('transaction', 'transaction_detail'));
        }
    }

    public function transaksi_status($id, Request $request)
    {
        $transaction = transaction::find($id);
        $user = User::find($transaction->user_id);
        $tanggal = Carbon::now();
        if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout < $tanggal) {
            $transaction->status = "transaksi expired";
            $transaction->save();

          
            return redirect()->back();;
        }
        $transaction->status = $request->status;
        $transaction->save();
        $data = [
            'nama' => 'Admin',
            'message' => $request->status,
            'id' => $id,
            'category' => 'transaction'
        ];

        $data_encode = json_encode($data);
        $user->createNotifUser($data_encode);

        return redirect()->back();
    }

    public function transaksi_bukti($id)
    {
        $transaction = transaction::find($id);

        return view('transaksi-bukti', compact('transaction'));
    }

    public function adm_pesan()
    {
        $pesan = admin_notification::where('read_at',null)->get();

        return view('notif.adm-pesan', compact('pesan'));
    }

    public function adminNotif($id)
    {
        $notification = admin_notification::find($id);
        $notif = json_decode($notification->data);
        $date = Carbon::now('Asia/Makassar');
        $baca = admin_notification::find($id);
        $baca->read_at = $date;
        $baca->update();

        if ($notif->category == 'review') {
            return redirect()->route('adm-detailbuku', $notif->id);
        } else {
            return redirect()->route('adm-transaksi-detail', $notif->id);
        }
    }

    public function grafik()
    {
        $now = Carbon::now('Asia/Makassar');
        $allTransactions = Transaction::where('status', 'barang telah sampai di tujuan')->get();
        //dd($allTransactions);
        $allSales = Transaction::where('status', 'barang telah sampai di tujuan')->count();
        $monthlySales = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', $now->month)->count();
        $annualSales = Transaction::where('status', 'barang telah sampai di tujuan')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Transaction::where('status', 'barang telah sampai di tujuan')->whereYear('created_at', $now->year)->get();
        //dd($allTransactions);
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal += $transaction->total;
        }


        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly += $monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual += $annual->total;
        }


        $january = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '01')->count();
        $february = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '02')->count();
        $march = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '03')->count();
        $april = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '04')->count();
        $may = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '05')->count();
        $june = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '06')->count();
        $july = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '07')->count();
        $august = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '08')->count();
        $september = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '09')->count();
        $october = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '10')->count();
        $november = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '11')->count();
        $december = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '12')->count();

        $jan = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '01')->sum('total');
        $feb = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '02')->sum('total');
        $mar = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '03')->sum('total');
        $ap = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '04')->sum('total');
        $mei = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '05')->sum('total');
        $jun = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '06')->sum('total');
        $jul = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '07')->sum('total');
        $aug = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '08')->sum('total');
        $sept = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '09')->sum('total');
        $octo = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '10')->sum('total');
        $nove = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '11')->sum('total');
        $dece = Transaction::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '12')->sum('total');

        return view('adm-grafik', compact('now', 'allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
    ,'jan','feb','mar','ap','mei','jun','jul','aug','sept','octo','nove','dece'));
    }
}
