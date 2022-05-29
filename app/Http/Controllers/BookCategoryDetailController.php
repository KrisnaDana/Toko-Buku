<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_category_detail;
use App\Models\book;
use App\Models\book_category;
use Illuminate\Pagination\Paginator;
class BookCategoryDetailController extends Controller
{
    //
    public function book_category_detail(){
        $data = book_category_detail::join('books','books.id','=','book_category_details.book_id')->join('book_categories','book_category_details.category_id','=','book_categories.id')->select('book_category_details.*','books.book_name','book_categories.category_name')->latest()->paginate(5);
        Paginator::useBootstrap();
        return view('Dsh.Category_Detail.layout',compact('data'));
    }

    public function add_book_category_detail(){
        $buku = book::all();
        $category= book_category::all();
        return view('Dsh.Category_Detail.add',compact('buku','category'));
    }

    public function save_book_category_detail(Request $request){
        $request->validate([
            'book_id' =>'required',
            'category_id' =>'required',
        ]);

        $data = new book_category_detail();
        $data->book_id = $request->book_id;
        $data->category_id = $request->category_id;
        $data->save();

        return redirect()->route('adm-img-book-category-detail');
    }

    public function edit_book_category_detail($id){
        $data = book_category_detail::find($id);
        $buku = book::all();
        $category= book_category::all();
        return view('Dsh.Category_Detail.edit',compact('data','buku','category'));
    }

    public function save_edit_book_category_detail(Request $request, $id){
        $request->validate([
            'book_id' =>'required',
            'category_id' =>'required',
        ]);

        $data = book_category_detail::find($id);
        $data->book_id = $request->book_id;
        $data->category_id = $request->category_id;
        $data->update();

        return redirect()->route('adm-img-book-category-detail');
    }

    public function delete_book_category_detail($id){
        $data = book_category_detail::find($id);
        $data->delete();

        return redirect()->route('adm-img-book-category-detail');
    }
}
