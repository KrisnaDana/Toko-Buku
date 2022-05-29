<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_image;
use Carbon\Carbon;
use App\Models\book;
use App\Models\discount;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\transaction;
use App\Models\admin;
use App\Models\book_category;
use App\Models\user_notification;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        if ($request->keyword != null) {
            //dd($request->keyword);

            $data = DB::Table('books')->where('book_name', 'like', '%' . $request->keyword . '%')->get();
            $datas = book_image::latest()->get();
            $diskon = discount::latest()->get();
            $time = Carbon::now();

            $user = auth::user();
            $data_user = User::find($user->id);
            $waktu = Carbon::now();
            $experied = transaction::where('status', 'menunggu bukti pembayaran')->where('user_id', $user->id)->where('timeout', '<', $time)->get();
            foreach ($experied as $x) {

                $admin = Admin::find(3);
                $data = [
                    'nama' => 'Admin',
                    'message' => 'transaksi expired!',
                    'id' => $x->id,
                    'category' => 'transcation'
                ];
                $data_encode = json_encode($data);

                $data_user->createNotifUser($data_encode);
            }
        } else {
            $data = book::latest()->get();
            $datas = book_image::latest()->get();
            $diskon = discount::latest()->get();
            $time = Carbon::now();

            $user = auth::user();
            $data_user = User::find($user->id);
            $waktu = Carbon::now();
            $experied = transaction::where('status', 'menunggu bukti pembayaran')->where('user_id', $user->id)->where('timeout', '<', $time)->get();
            foreach ($experied as $x) {

                $admin = Admin::find(3);
                $data = [
                    'nama' => 'Admin',
                    'message' => 'transaksi expired!',
                    'id' => $x->id,
                    'category' => 'transcation'
                ];
                $data_encode = json_encode($data);

                $data_user->createNotifUser($data_encode);
            }
        }
        if ($request->keyword == null) {
            $data = book::latest()->get();
        }


        $notifications = DB::Table('user_notifications')->get();
        //dd($notifications);

        return view('beranda', compact('data', 'datas', 'time', 'diskon', 'notifications'));
    }
    
    public function index2(Request $request,$id)
    {
  
        $cat = DB::Table('book_categories')->where('id',$id)->get(); 
        //dd($cat->id);
        if ($request->keyword != null) {
            //dd($request->keyword);
            
            $data = DB::Table('books')->join('book_category_details','book_category_details.book_id','=','books.id')->where('book_name','like','%'.$request->keyword.'%')->get();
            $datas = book_image::latest()->get();
            $diskon = discount::latest()->get();
            $time = Carbon::now();

            $user = auth::user();
            $data_user = User::find($user->id);
            $waktu = Carbon::now();
            $experied = transaction::where('status', 'menunggu bukti pembayaran')->where('user_id', $user->id)->where('timeout', '<', $time)->get();
            foreach ($experied as $x) {

                $admin = Admin::find(3);
                $data = [
                    'nama' => 'Admin',
                    'message' => 'transaksi expired!',
                    'id' => $x->id,
                    'category' => 'transcation'
                ];
                $data_encode = json_encode($data);

                $data_user->createNotifUser($data_encode);
            }

        } else {
            $data = book::join('book_category_details','book_category_details.book_id','=','books.id')->latest('books.created_at')->get();
         
            $datas = book_image::latest()->get();
            $diskon = discount::latest()->get();
            $time = Carbon::now();

            $user = auth::user();
            $data_user = User::find($user->id);
            $waktu = Carbon::now();
            $experied = transaction::where('status', 'menunggu bukti pembayaran')->where('user_id', $user->id)->where('timeout', '<', $time)->get();
            
            foreach ($experied as $x) {

                $admin = Admin::find(3);
                $data = [
                    'nama' => 'Admin',
                    'message' => 'transaksi expired!',
                    'id' => $x->id,
                    'category' => 'transcation'
                ];
                $data_encode = json_encode($data);

                $data_user->createNotifUser($data_encode);
            }
        }

        if($request->keyword == null){
            $data = book::join('book_category_details','book_category_details.book_id','=','books.id')->select('books.*','book_category_details.category_id')->latest('books.created_at')->get();
            
        }
        


        $notifications = DB::Table('user_notifications')->get();
        //dd($notifications);

        return view('beranda2', compact('cat','data', 'datas', 'time', 'diskon', 'notifications'));
    }
}
