@extends('layouts.adm_panel')

@section('title', 'Admin | Add Buku')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="card shadow mb-4">
    <form class="form" method="post" action="{{route('adm-buku-save')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-header text-center">
            <h3 class="card-title title-up">Tambah Buku</h3>
        </div>

        <div class="card-body">
            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                            
                        </i>
                    </span>
                </div>
                <input type="text" class="form-control @error('book_name') is-invalid @enderror" placeholder="Book Name" name="book_name" value="{{old('book_name')}}" required>
            </div>
            @error('book_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Price" name="harga" id="harga" required >
            </div>
            @error('harga')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <input type="number" placeholder="Weight" class="form-control @error('weight') is-invalid @enderror" name="weight" required/>
            </div>
            @error('weight')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <input type="text" placeholder="Deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required/>
            </div>
            @error('deskripsi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <input type="number" placeholder="Stock" class="form-control @error('stock') is-invalid @enderror" name="stock" required/>
            </div>
            @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <select class="form-control @error('category_id') is-invalid @enderror" data-background-color="orange" name="category_id" required>
                    @foreach ($category as $datas )
                        <option style="color:black" value="{{ $datas->id }}">{{ $datas->category_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            
            <div class="input-group no-border mt-1 mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>
                        </i>
                    </span>
                </div>
                <input type="file" class="form-control mt-1  @error('image_name') is-invalid @enderror" placeholder="Book Image"  name="image_name" id="image_name" required >
            </div>
            @error('image_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
       
            <div class="col-lg-12 mt-4 mb-2" style="justify-content:center">
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{route('adm-buku')}}" class="btn btn-danger">back</a>
        </div>
    </form>
</div>

@endsection