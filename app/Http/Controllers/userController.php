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
use App\Notifications\ProductNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class userController extends Controller
{
    public function beranda()
    {
        $data = book::latest()->get();
        $datas = book_image::latest()->get();
        $diskon = discount::latest()->get();
        $time = Carbon::now('Asia/Makassar');



        return view('beranda', compact('data', 'datas', 'time', 'diskon'));
    }

    public function logout(Request $request)
    {
        $auth = Auth::guard('user');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            $auth->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landing');
        }
    }

    public function profil()
    {
        $user_id = Auth::guard('user')->user()->id;
        $profil = user::find($user_id);
        return view('profil', compact('profil'));
    }

    public function profil_submit($id, Request $request)
    {
        if (!empty($request->profile_image)) {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:30',
                'profile_image' => 'required|file|image|max:8192'
            ]);
            $user = user::find($id);

            $image = $request->file('profile_image');
            $image_name = rand() . "." . $image->getClientOriginalExtension();

            $user->name = $request->name;
            $user->profile_image = $image_name;
            $user->save();

            $image->move(public_path('profile_image'), $image_name);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|min:3|max:30'
            ]);

            $user = user::find($id);
            $user->name = $request->name;
            $user->save();
        }

        return redirect()->route('profil');
    }

    public function detailbuku($id)
    {
        $book = book::find($id);
        $book_image = book_image::where('book_id', '=', $id)->get();
        $book_review = book_review::where('book_id', '=', $id)->get();

        $tanggal = Carbon::now('Asia/Makassar')->format('Y-m-d');

        $discount = discount::where('book_id', '=', $id)->where('start', '<=', $tanggal)->where('end', '>=', $tanggal)->get();

        if (count($discount) > 0) {
            $harga = $book->price;
            foreach ($discount as $discounts) {
                $harga = $harga - ($harga * $discounts->percentage / 100);
            }
            if (count($book_review) > 0) {
                return view('detailbuku', compact('book', 'book_image', 'discount', 'harga', 'book_review'));
            } else {
                return view('detailbuku', compact('book', 'book_image', 'discount', 'harga'));
            }
        } else {
            if (count($book_review) > 0) {
                return view('detailbuku', compact('book', 'book_image', 'book_review'));
            } else {
                return view('detailbuku', compact('book', 'book_image'));
            }
        }
    }

    public function review_submit($id, Request $request)
    {
        $validatedData = $request->validate([
            'content_review' => 'required'
        ]);

        $user_id = Auth::guard('user')->user()->id;

        $review = array(
            'book_id' => $id,
            'user_id' => $user_id,
            'transaction_detail_id' => $request->transaction_detail_id,
            'rate' => $request->rate,
            'content' => $request->content_review
        );

        book_review::create($review);

        $jumlah_rate = book_review::where('book_id', '=', $id)->get();
        if (count($jumlah_rate) > 0) {
            $jumlah = 0;
            $total = 0;
            foreach ($jumlah_rate as $jumlah_rates) {
                $jumlah++;
                $total = $total + $jumlah_rates->rate;
            }
            $book_rate = $total / $jumlah;

            $book = book::find($id);
            $book->book_rate = $book_rate;
            $book->save();
        }
        $user = auth::user();
        $data_user = User::find($user->id);
        if (count($jumlah_rate) == 1) {

            //----------------------------------------------------------------------------
            $admin = Admin::find(3);
            $data = [
                'nama' => $user->name,
                'message' => 'seseorang mereview product!',
                'id' => $id,
                'category' => 'review'
            ];
            $data_encode = json_encode($data);
            $admin->createNotif($data_encode);
        }
        return redirect()->back();
    }

    public function keranjang()
    {
        $user_id = Auth::guard('user')->user()->id;
        $keranjang = cart::where('user_id', '=', $user_id)->where('status', '=', 'aktif')->get();

        return view('keranjang', compact('keranjang'));
    }

    public function keranjang_tambah($id, Request $request)
    {
        $user_id = Auth::guard('user')->user()->id;
        $cart = cart::where('user_id', '=', $user_id)->where('book_id', '=', $id)->where('status', '=', 'aktif')->get();
        $book_stock = book::where('id', $id)->first();
        if (count($cart) > 0) {
            foreach ($cart as $carts) {
                if ($book_stock->stock == $carts->qty) {
                    $carts->qty = $carts->qty + 0;
                    $carts->save();
                } else if ($book_stock->stock < $carts->qty + $request->jumlah_keranjang) {
                    $k = $carts->qty;
                    $jumlah = $book_stock->stock - $k;
                    $carts->qty = $carts->qty + $jumlah;
                    $carts->save();
                } else {
                    $carts->qty = $carts->qty + $request->jumlah_keranjang;
                    $carts->save();
                }
            }
        } else {
            $insert_cart = array(
                'user_id' => $user_id,
                'book_id' => $id,
                'qty' => $request->jumlah_keranjang,
                'status' => 'aktif'
            );
            cart::create($insert_cart);
        }
        return redirect()->back();
    }

    public function keranjang_hapus($id)
    {
        $keranjang = cart::find($id);
        $keranjang->status = "hapus";
        $keranjang->save();

        return redirect()->back();
    }

    public function keranjang_alamat(Request $request)
    {
        if ($request->pilih == null) {
            return redirect()->back();
        }
        $cek_pilih = 0;
        foreach ($request->pilih as $pilihbuku) {
            if ($pilihbuku == "1") {
                $cek_pilih = 1;
            }
        }
        if ($cek_pilih == 0) {
            return redirect()->back();
        }

        $user_id = Auth::guard('user')->user()->id;
        $keranjang = cart::where('user_id', '=', $user_id)->where('status', '=', 'aktif')->get();
        $kurir = courier::all();
        $i = 0;
        foreach ($keranjang as $keranjangs) {

            $keranjangs->qty = $request->jumlah[$i];
            $keranjangs->save();
            $i++;
        }

        $pilih = array();
        foreach ($request->pilih as $pilihs) {
            array_push($pilih, $pilihs);
        }

        $z = 0;
        $keranjang_temp = cart::where('user_id', '=', $user_id)->where('status', '=', 'aktif')->get();
        $keranjang = array();
        foreach ($keranjang_temp as $keranjang_temps) {
            if ($pilih[$z] == "1") {
                array_push($keranjang, $keranjang_temps);
            }
            $z++;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $province = json_decode($response, true);
        // foreach ($province["rajaongkir"]["results"] as $provinces) {
        //     return $provinces["province_id"];
        // }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $city = json_decode($response, true);
        return view('keranjang-alamat', compact('province', 'city', 'kurir', 'keranjang'));
    }

    public function keranjang_checkout(Request $request)
    {
        $validatedData = $request->validate([
            'province' => 'required|min:1',
            'regency' => 'required|min:1',
            'address' => 'required|min:1',
            'courier_id' => 'required|min:1'
        ]);

        $user_id = Auth::guard('user')->user()->id;
        $kurir = courier::find($request->courier_id);

        list($province, $province_name) = explode('|', $request->province);
        list($regency, $regency_name) = explode('|', $request->regency);
        $address = $request->address;

        $discount =  array();
        $selling_price = array();

        $keranjang_id = $request->keranjang;
        $keranjang = array();
        foreach ($keranjang_id as $keranjang_ids) {
            $data_keranjang = cart::where('id', '=', $keranjang_ids)->first();
            array_push($keranjang, $data_keranjang);
        }
        $subtotal = 0;
        $weight = 0;
        $tanggal = Carbon::now('Asia/Makassar')->format('Y-m-d');
        foreach ($keranjang as $keranjangs) {
            $weight = $weight + ($keranjangs->qty * $keranjangs->book->weight * 1000);
            $diskon = discount::where('book_id', '=', $keranjangs->book_id)->where('start', '<=', $tanggal)->where('end', '>=', $tanggal)->get();
            if (count($diskon) > 0) {
                $harga = $diskon[0]->percentage * $keranjangs->book->price / 100;
                $subtotal = $subtotal + ($keranjangs->qty * $harga);
                array_push($discount, $diskon[0]->percentage);
                array_push($selling_price, $harga);
            } else {
                $subtotal = $subtotal + ($keranjangs->qty * $keranjangs->book->price);
                array_push($discount, 0);
                array_push($selling_price, $keranjangs->book->price);
            }
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=17&destination=" . $regency . "&weight=" . $weight . "&courier=" . $kurir->courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $cost = json_decode($response, true);

        // return $cost;
        foreach ($cost["rajaongkir"]["results"] as $costs) {
            foreach ($costs["costs"] as $costss) {
                foreach ($costss["cost"] as $costsss) {
                    $shipping_cost = $costsss["value"];
                    break;
                }
                break;
            }
            break;
        }

        $total = $shipping_cost + $subtotal;
        return view('keranjang-checkout', compact('keranjang', 'kurir', 'subtotal', 'discount', 'selling_price', 'province_name', 'regency_name', 'address', 'shipping_cost', 'total'));
    }

    public function keranjang_bayar(Request $request)
    {
        $user_id = Auth::guard('user')->user()->id;
        $courier = courier::where('courier', '=', $request->courier)->first();
        $timeout = Carbon::now('Asia/Makassar');
        $timeout->addDays(1);
        $timeout->format('Y-m-d H:i:s');
        $transaksi = array(
            'user_id' => $user_id,
            'courier_id' => $courier->id,
            'timeout' => $timeout,
            'address' => $request->address,
            'regency' => $request->regency,
            'province' => $request->province,
            'total' => $request->total,
            'shipping_cost' => $request->shipping_cost,
            'subtotal' => $request->subtotal,
            'status' => "menunggu bukti pembayaran",
        );

        transaction::create($transaksi);

        $transaction = transaction::where('user_id', '=', $user_id)->where('total', '=', $request->total)->orderBy('id', 'DESC')->first();

        $i = 0;
        foreach ($request->keranjang as $keranjangs) {
            $keranjang = cart::find($keranjangs);
            $keranjang->status = "hapus";
            $keranjang->save();
            $transaksi_detail = array(
                'transaction_id' => $transaction->id,
                'book_id' => $keranjang->book_id,
                'qty' => $keranjang->qty,
                'discount' => $request->discount[$i],
                'selling_price' => $request->selling_price[$i],
            );
            transaction_detail::create($transaksi_detail);
            $book = book::find($keranjang->book_id);
            $book->stock = $book->stock - $keranjang->qty;
            $book->save();
            $i++;
        }

        $transaction = transaction::where('user_id', '=', $user_id)->where('total', '=', $request->total)->orderBy('id', 'DESC')->first();

        //----------------------------------------------------------------------------
        $user = Auth::user();
        $data_user = User::find($user->id);
        $admin = Admin::find(3);
        $data = [
            'nama' => $user->name,
            'message' => 'membeli product!',
            'id' => $transaction->id,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);
        //Notif User-------------------------------------------------------------------
        $data = [
            'nama' => 'Admin',
            'message' => 'Upload Bukti Pembayaran!',
            'id' => $transaction->id,
            'category' => 'transcation'
        ];
        $data_encode = json_encode($data);
        $data_user->createNotifUser($data_encode);
        //Notif User-------------------------------------------------------------------
        return redirect()->route('transaksi-detail', $transaction->id);
    }

    public function beli_alamat($id, Request $request)
    {
        $jumlah = $request->jumlah_beli;
        $user_id = Auth::guard('user')->user()->id;
        $kurir = courier::all();
        $i = 0;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $province = json_decode($response, true);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $city = json_decode($response, true);
        return view('beli-alamat', compact('province', 'city', 'kurir', 'id', 'jumlah'));
    }


    public function beli_checkout($id, $jumlah, Request $request)
    {
        $validatedData = $request->validate([
            'province' => 'required|min:1',
            'regency' => 'required|min:1',
            'address' => 'required|min:1',
            'courier_id' => 'required|min:1'
        ]);

        $user_id = Auth::guard('user')->user()->id;
        $book = book::find($id);
        $kurir = courier::find($request->courier_id);

        list($province, $province_name) = explode('|', $request->province);
        list($regency, $regency_name) = explode('|', $request->regency);
        $address = $request->address;

        $keranjang = cart::where('user_id', '=', $user_id)->where('status', '=', 'aktif')->get();

        $subtotal = 0;
        $tanggal = Carbon::now('Asia/Makassar')->format('Y-m-d');
        $diskon = discount::where('book_id', '=', $book->id)->where('start', '<=', $tanggal)->where('end', '>=', $tanggal)->orderBy('id', 'DESC')->get();
        if (count($diskon) > 0) {
            foreach ($diskon as $diskons) {
                $discount = $diskons->percentage;
                break;
            }
            $selling_price = $book->price * $discount / 100;
        } else {
            $discount = 0;
            $selling_price = $book->price;
        }
        $weight = $book->weight * $jumlah * 1000;
        $subtotal = $jumlah * $selling_price;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $request->province . "&destination=" . $request->regency . "&weight=" . $weight . "&courier=" . $kurir->courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 400f496a78d8de8e403cb03633e42774"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $cost = json_decode($response, true);

        // return $cost;
        foreach ($cost["rajaongkir"]["results"] as $costs) {
            foreach ($costs["costs"] as $costss) {
                foreach ($costss["cost"] as $costsss) {
                    $shipping_cost = $costsss["value"];
                    break;
                }
                break;
            }
            break;
        }

        $total = $shipping_cost + $subtotal;
        return view('beli-checkout', compact('book', 'jumlah', 'kurir', 'subtotal', 'discount', 'selling_price', 'province_name', 'regency_name', 'address', 'shipping_cost', 'total'));
    }

    public function beli_bayar($id, $jumlah, Request $request)
    {

        $user_id = Auth::guard('user')->user()->id;
        $courier = courier::where('courier', '=', $request->courier)->first();
        $timeout = Carbon::now('Asia/Makassar');
        $timeout->addDays(1);
        $timeout->format('Y-m-d H:i:s');
        $transaksi = array(
            'user_id' => $user_id,
            'courier_id' => $courier->id,
            'timeout' => $timeout,
            'address' => $request->alamat,
            'regency' => $request->regency,
            'province' => $request->province,
            'total' => $request->total,
            'shipping_cost' => $request->shipping_cost,
            'subtotal' => $request->subtotal,
            'status' => "menunggu bukti pembayaran",
        );
        transaction::create($transaksi);

        $transaction = transaction::where('user_id', '=', $user_id)->where('total', '=', $request->total)->latest()->first();

        $transaksi_detail = array(
            'transaction_id' => $transaction->id,
            'book_id' => $id,
            'qty' => $jumlah,
            'discount' => $request->discount,
            'selling_price' => $request->selling_price,
        );
        transaction_detail::create($transaksi_detail);

        $book = book::find($id);
        $book->stock = $book->stock - $jumlah;
        $book->save();

        // $admin = admin::all();

        // foreach($admin as $a)


        //----------------------------------------------------------------------------
        $user = Auth::user();
        $data_user = User::find($user->id);
        $admin = Admin::find(3);
        $data = [
            'nama' => $user->name,
            'message' => 'membeli product!',
            'id' => $transaction->id,
            'category' => 'transcation'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        //Notif User-------------------------------------------------------------------
        $data = [
            'nama' => 'Admin',
            'message' => 'Upload Bukti Pembayaran!',
            'id' => $transaction->id,
            'category' => 'transcation'
        ];
        $data_encode = json_encode($data);
        $data_user->createNotifUser($data_encode);
        //Notif User-------------------------------------------------------------------



        //$transaction_detail = transaction_detail::where('transaction_id', '=', $transaction->id)->latest()->first();
        return redirect()->route('transaksi-detail', $transaction->id);
    }

    public function transaksi()
    {
        $user_id = Auth::guard('user')->user()->id;
        $transaction = transaction::where('user_id', '=', $user_id)->orderBy('id', 'DESC')->get();
        $tanggal = Carbon::now('Asia/Makassar');
        $interval = array();
        $id =  transaction::where('user_id', $user_id)->orderBy('id', 'DESC')->first();
        foreach ($transaction as $transactions) {
            if ($transactions->status == "menunggu bukti pembayaran" && $transactions->timeout < $tanggal) {
                $transactions->status = "transaksi expired";
                $transactions->save();


                $transaction_detail = transaction_detail::where('transaction_id', '=', $transactions->id)->get();
                foreach ($transaction_detail as $transaction_details) {
                    $book = book::find($transaction_details->book_id);
                    $book->stock = $book->stock + $transaction_details->qty;
                    $book->save();
                }
            }
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $transactions->timeout);
            $countdown = $tanggal->diffAsCarbonInterval($date);
            array_push($interval, $countdown);
        }
        return view('transaksi', compact('transaction', 'interval'));
    }


    public function transaksi_detail($id)
    {

        $transaction = transaction::where('id', $id)->first();
        $transaction_detail = transaction_detail::where('transaction_id', $id)->latest()->get();
        $transaction_detail_id = transaction_detail::where('transaction_id', $id)->first();
        $keranjang = cart::where('user_id', auth::user()->id)->where('status', 'aktif')->get();

        $tanggal = Carbon::now('Asia/Makassar');



        if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout < $tanggal) {
            $transaction->status = "transaksi expired";
            $transaction->save();

            $transaction_detail = transaction_detail::where('transaction_id', '=', $id)->get();
            foreach ($transaction_detail as $transaction_details) {
                $book = book::find($transaction_details->book_id);
                $book->stock = $book->stock + $transaction_details->qty;
                $book->save();
            }



            return view('transaksi-detail', compact('transaction', 'transaction_detail'));
        } else if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout >= $tanggal) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->timeout);
            $interval = $tanggal->diffAsCarbonInterval($date);


            return view('transaksi-detail', compact('transaction', 'interval', 'transaction_detail'));
        } else {


            return view('transaksi-detail', compact('transaction', 'transaction_detail'));
        }
    }

    public function transaksi_bukti($id, Request $request)
    {

        $validatedData = $request->validate([
            'proof_of_payment' => 'required|file|image|max:8192'
        ]);
        $transaction = transaction::find($id);

        $tanggal = Carbon::now('Asia/Makassar');
        if ($transaction->status == "menunggu bukti pembayaran" && $transaction->timeout < $tanggal) {
            $transaction->status = "transaksi expired";
            $transaction->save();

            $transaction_detail = transaction_detail::where('transaction_id', '=', $id)->get();
            foreach ($transaction_detail as $transaction_details) {
                $book = book::find($transaction_details->book_id);
                $book->stock = $book->stock + $transaction_details->qty;
                $book->save();
            }



            return redirect()->back();
        }

        $image = $request->file('proof_of_payment');
        $image_name = rand() . "." . $image->getClientOriginalExtension();

        $transaction->proof_of_payment = $image_name;
        $transaction->status = "menunggu verifikasi";
        $transaction->save();

        //notif admin---------------------------------------
        $user = auth::user();
        //$user_data=User::find($user->id);
        $admin = Admin::find(3);
        $data = [
            'nama' => $user->name,
            'message' => 'Verifikasi Pembayaran!',
            'id' => $id,
            'category' => 'Transcation'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);
        //notif admin---------------------------------------

        $image->move(public_path('proof_of_payment'), $image_name);

        return redirect()->back();
    }

    public function transaksi_batal($id)
    {
        $transaction = transaction::find($id);
        $transaction->status = "transaksi dibatalkan";
        $transaction->save();

        $transaction_detail = transaction_detail::where('transaction_id', '=', $id)->get();
        foreach ($transaction_detail as $transaction_details) {
            $book = book::find($transaction_details->book_id);
            $book->stock = $book->stock + $transaction_details->qty;
            $book->save();
        }

        //notif admin---------------------------------------
        $user = auth::user();
        //$user_data=User::find($user->id);
        $admin = Admin::find(3);
        $data = [
            'nama' => $user->name,
            'message' => 'Transaksi Dibatalkan!',
            'id' => $id,
            'category' => 'canceled'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);
        //notif admin---------------------------------------

        //notif user---------------------------------------
        $user = auth::user();
        $user_data = User::find($user->id);
        $admin = Admin::find(3);
        $data = [
            'nama' => 'Admin',
            'message' => 'Transaksi Berhasil Dibatalkan!',
            'id' => $id,
            'category' => 'canceled'
        ];
        $data_encode = json_encode($data);
        $user_data->createNotifUser($data_encode);
        //notif user---------------------------------------

        return redirect()->back();
    }

    public function userNotif($id)
    {
        $notification = user_notification::find($id);
        $notif = json_decode($notification->data);

        $date = Carbon::now('Asia/Makassar');
        $baca = user_notification::find($id);
        $baca->read_at = $date;
        $baca->update();

        if ($notif->category == 'review') {
            return redirect()->route('detailbuku', $notif->id);
        } else {
            return redirect()->route('transaksi-detail', $notif->id);
        }
    }

    public function userNotifAll()
    {
        $allNotif = user_notification::where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        return view('notif.Notifall', compact('allNotif'));
    }
}
