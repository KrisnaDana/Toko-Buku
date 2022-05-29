@extends('layouts.adm_panel')
@section('title', 'Admin | Edit Gambar Buku')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="section section-signup" style="background-position: top center; min-height: 700px;">
    <div class="container">
        <div class="row">
            <div class="card" data-background-color="orange">
                <form class="form" method="post" action="{{route('adm-img-book-save-edit',$data->id)}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="card-header text-center">
                        <h3 class="card-title title-up">Edit Gambar Buku</h3>
                    </div>

                    <div class="card-body">
                        <div class="input-group no-border">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons-sharp">
                                        <span>book</span>
                                    </i>
                                </span>
                            </div>
                            <select class="form-control @error('book_id') is-invalid @enderror"  id="book_id" name="book_id" required>
                                @foreach ($buku as $book )
                                    <option style="color:black"  value="{{ $book->id }}" {{ $book->id == $data->book_id ? 'selected':null }}>{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('book_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group no-border">
                            <input type="hidden" class="form-control @error('hidden_image') is-invalid @enderror" value="{{ $data->image_name }}" name="hidden_image" id="hidden_image" required >
                            <input type="file" class="form-control mt-1 @error('image_name') is-invalid @enderror" placeholder="Book Image" name="image_name" id="image_name">
                        </div>
                        
                        @error('image_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
 
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-neutral btn-round btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col text-center mt-4">
            <a href="{{route('adm-img-book')}}" class="btn btn-outline-default btn-round btn-white btn-lg">Kembali Ke Landing Page</a>
        </div>
    </div>
</div>
@endsection