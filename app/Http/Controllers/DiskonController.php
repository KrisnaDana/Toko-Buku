<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\discount;
use App\Models\book;
use Illuminate\Pagination\Paginator;
class DiskonController extends Controller
{
    //
    public function diskon(){
        $data = discount::join('books','books.id','=','discounts.book_id')->select('discounts.*','books.book_name')->latest()->paginate(5);
        Paginator::useBootstrap();
        return view('Dsh.Diskon.layout',compact('data'));
    }

    public function add_diskon(){
        $buku = book::all();
        return view('Dsh.Diskon.add',compact('buku'));
    }

    public function save_diskon(Request $request){
      
        $request->validate([
            'book_id' =>'required',
            'percentage'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $data = new discount();
        $data->book_id = $request->book_id;
        $data->percentage = $request->percentage;
        $data->start=$request->start;
        $data->end=$request->end;
        $data->save();

        return redirect()->route('adm-diskon');
    }

    public function edit_diskon($id){
        $buku = book::all();
        $datas = discount::find($id);
        return view('Dsh.Diskon.edit',compact('buku','datas'));
    }

    public function save_edit_diskon(Request $request, $id){
        $request->validate([
            'book_id' =>'required',
            'percentage'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $data = discount::find($id);
        $data->book_id = $request->book_id;
        $data->percentage = $request->percentage;
        $data->start=$request->start;
        $data->end=$request->end;
        $data->update();

        return redirect()->route('adm-diskon');
    }

    public function delete_diskon($id){
        $data = discount::find($id);
        $data->delete();

        return redirect()->route('adm-diskon');
    }
}
