<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_category;
use Illuminate\Pagination\Paginator;
class BookCategoryController extends Controller
{
    //
    public function book_category(){
        $data = book_category::latest()->paginate(5);
        Paginator::useBootstrap();
        return view('Dsh.Book_Category.layout',compact('data'));
    }

    public function add_book_category(){
        return view('Dsh.Book_Category.add');
    }

    public function save_book_category(Request $request){
        $request->validate([
            'category_name' =>'required|unique:book_categories,category_name',
        ]);

        $data = new book_category();
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->route('adm-book-category');
    }

    public function edit_book_category($id){
        $data = book_category::find($id);
        
        return view('Dsh.Book_Category.edit',compact('data'));
    }

    public function save_edit_book_category(Request $request, $id){
        $request->validate([
            'category_name' =>'required',
        ]);

        $data = book_category::find($id);
        $data->category_name = $request->category_name;
        $data->update();

        return redirect()->route('adm-book-category');
    }

    public function delete_book_category($id){
        $data = book_category::find($id);
        $data->delete();

        return redirect()->route('adm-book-category');
    }
}
