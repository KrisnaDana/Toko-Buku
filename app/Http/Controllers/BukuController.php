<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use App\Models\book_image;
use App\Models\book_category;
use App\Models\book_category_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class BukuController extends Controller
{
    //
    public function buku(){
        $data = book::latest()->paginate(5);
        Paginator::useBootstrap();
        return view('Dsh.Buku.layout',compact('data'));
    }

    public function add_buku(){
        $category= book_category::all();
        return view('Dsh.Buku.add',compact('category'));
    }

    public function save_buku(Request $request){
        
        $request->validate([
            'book_name' =>'required',
            'category_id'=>'required',
            'harga'=>'required',
            'deskripsi'=>'required',
            //'book_rate'=>'required',
            'stock'=>'required',
            'weight'=>'required',
            'image_name'=>'required|image:jepg,png,jpg|max:8192',
        ]);
        //dd($request->all());

        $image= $request->file('image_name');
        $image_name =rand().".".$image->getClientOriginalExtension();

        $data = new book();
        $data->book_name = $request->book_name;
        $data->category_name = $request->category_id;
        $data->price = $request->harga;
        $data->description=$request->deskripsi;
        $data->book_rate=0;
        $data->stock=$request->stock;
        $data->weight=$request->weight;
        $data->image_name = $image_name;
        $data->save();

        $books_id =book::latest()->first();
        
        $data2 = new book_image();
        $data2->book_id = $books_id->id;
        $data2->image_name = $image_name;
        $data2->save();

        $data3 = new book_category_detail();
        $data3->book_id = $books_id->id;
        $data3->category_id= $request->category_id;
        $data3->save();

        $image->move(public_path('img'),$image_name);

        return redirect()->route('adm-buku');
    }

    public function edit_buku($id){
        $data = book::find($id);
        $category= book_category::all();
        return view('Dsh.Buku.edit',compact('data','category'));
    }

    public function save_edit_buku(Request $request, $id){

        $image = $request->file('image_name');
        $old_image_name = $request->hidden_image;
       
        if($image !=''){
            $request->validate([
                'book_name' =>'required',
                'category_id'=>'required',
                'harga'=>'required',
                'deskripsi'=>'required',
                'stock'=>'required',
                'weight'=>'required',
                'image_name'=>'required|image:jepg,png,jpg|max:8192',
            ]);
            // dd($request->all());
            $image_name =$old_image_name;
            $image->move(public_path('img'),$image_name);
        }else{
            
            $request->validate([
                'book_name' =>'required',
                'category_id'=>'required',
                'harga'=>'required',
                'deskripsi'=>'required',
                'stock'=>'required',
                'weight'=>'required',
            ]);
            $image_name =$old_image_name;
        }
        // dd($request->all());
        $data = book::find($id);
        $data->book_name = $request->book_name;
        $data->category_name = $request->category_id;
        $data->price = $request->harga;
        $data->description=$request->deskripsi;
        $data->stock=$request->stock;
        $data->weight=$request->weight;
        $data->image_name =$image_name;
        $data->update();

        $image_id=DB::Table('book_images')->where('book_id',$id)->select('id')->first();

        $data2 = book_image::find($image_id->id);
        $data2->book_id = $request->id;
        $data2->image_name = $image_name;
        $data2->update();

        $category_data=DB::Table('book_category_details')->where('book_id',$id)->select('id')->first();

        $data3 = book_category_detail::find($category_data->id);
        $data3->book_id =$request->id;
        $data3->category_id=$request->category_id;
        $data3->update();

        //dd($request->all());

        return redirect()->route('adm-buku');
    }

    public function delete_buku($id){
        $image_id=DB::Table('book_images')->where('book_id',$id)->select('id')->first();
        $category_id=DB::Table('book_category_details')->where('book_id',$id)->select('id')->first();
       
        $data = book::find($id);
        $data->delete();

        $data2 = book_image::find($image_id->id);
        $data2->delete();

        $data3 = book_category_detail::find($category_id->id);
        $data3->delete();

        return redirect()->route('adm-buku');
    }
}
