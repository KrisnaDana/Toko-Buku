<?php

namespace App\Http\Controllers;

use App\Models\courier as ModelsCourier;
use Illuminate\Http\Request;
use App\Models\courier;
use Illuminate\Pagination\Paginator;
class CourierController extends Controller
{
    //
    public function Courier(){
        $data = Courier::latest()->paginate(5);
        Paginator::useBootstrap();
        return view('Dsh.Courier.layout',compact('data'));
    }

    public function add_Courier(){
        return view('Dsh.Courier.add');
    }

    public function save_Courier(Request $request){
        
        $request->validate([
            'courier' =>'required|unique:couriers,courier',
        ]);

        $data = new Courier();
        $data->courier = $request->courier;
        $data->save();

        return redirect()->route('adm-courier');
    }

    public function edit_Courier($id){
        $data = Courier::find($id);
        return view('Dsh.Courier.edit',compact('data'));
    }

    public function save_edit_Courier(Request $request, $id){
    
        $request->validate([
            'courier' =>'required',
        ]);

        $data = Courier::find($id);
        $data->courier = $request->courier;
        $data->update();

        return redirect()->route('adm-courier');
    }

    public function delete_Courier($id){
        $data = Courier::find($id);
        $data->delete();

        return redirect()->route('adm-courier');
    }
}
