@extends('layouts.adm_panel')
@section('title', 'Admin | Add Gambar Buku')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="card shadow mb-4">
    <form class="form" method="post" action="{{route('adm-img-book-save')}}" enctype="multipart/form-data" >
        @csrf
        {{-- <div class="card-header text-center">
            <h3 class="card-title title-up" >Tambah Gambar Buku</h3>
        </div> --}}

        <div class="card-body">
            <div class="input-group no-border">
                {{-- <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons-sharp">
                            <span>book</span>
                        </i>
                    </span>
                </div> --}}
                <select class="form-control @error('book_id') is-invalid @enderror" data-background-color="orange" name="book_id" required>
                    @foreach ($buku as $data )
                        <option style="color:black" value="{{ $data->id }}">{{ $data->book_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('book_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border">
                {{-- <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons-sharp">
                            <span>book</span>
                        </i>
                    </span>
                </div> --}}
                <input type="file" class="form-control mt-1  @error('image_name') is-invalid @enderror" placeholder="Book Image"  name="image_name" id="image_name" required >
            </div>
            @error('image_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

      
  
       
        <div class="col-lg-12 mt-4 mb-2" style="justify-content:center">
            <button type="submit" class="btn btn-neutral btn-round btn-lg">Submit</button>
            <a href="{{route('adm-buku')}}" class="btn btn-danger">back</a>
        </div>
    
    </form>
</div>
@endsection