<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_image;
use App\Models\book;
use Illuminate\Pagination\Paginator;
class ImgBookController extends Controller

{
    //
    public function img_book(){
        $data = book_image::join('books','books.id','=','book_images.book_id')
        ->select('book_images.*','books.book_name')->latest()->paginate(5);
        Paginator::useBootstrap();
        // $data = book::join('book_images','book_images.book_id','=','books.id')
        // ->select('books.book_name','book_images.*')->latest()->paginate(5);
        // Paginator::useBootstrap();
        return view('Dsh.Img_Book.layout',compact('data'));
    }

    public function add_img_book(){
        $buku = book::all();
        
        return view('Dsh.Img_Book.add',compact('buku'));
    }

    public function save_img_book(Request $request){
    
        $request->validate([
            'book_id' =>'required',
            'image_name'=>'required|image:jepg,png,jpg|max:8192',
        ]);


        $image= $request->file('image_name');
        $image_name =rand().".".$image->getClientOriginalExtension();

        $data = new book_image();
        $data->book_id = $request->book_id;
        $data->image_name = $image_name;
        $data->save();

        $image->move(public_path('img'),$image_name);

        return redirect()->route('adm-img-book');
    }

    public function edit_img_book($id){
        $data = book_image::find($id);
        $buku = book::all();
       
        return view('Dsh.Img_Book.edit',compact('data','buku'));
    }

    public function save_edit_img_book(Request $request, $id){

        $image = $request->file('image_name');
        $old_image_name = $request->hidden_image;
        
        if($image !=''){
            $request->validate([
                'book_id' =>'required',
                'image_name'=>'required|image:jepg,png,jpg|max:2048',
            ]);
            
            $image_name =$old_image_name;
            $image->move(public_path('img'),$image_name);
        }else{
   
            $request->validate([
                'book_id' =>'required'
            ]);
            $image_name =$old_image_name;
        }
      // dd($request->book_id);

        $data = book_image::find($id);
        $data->book_id = $request->book_id;
        $data->image_name = $image_name;
        $data->update();

        return redirect()->route('adm-img-book');
    }

    public function delete_book_img($id){
        $data = book_image::find($id);
        $data->delete();
        return redirect()->route('adm-img-book');
    }
}
