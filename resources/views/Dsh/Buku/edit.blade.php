@extends('layouts.adm_panel')

@section('title', 'Admin | Edit Buku')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="card shadow mb-4">
    <form class="form" method="post" action="{{route('adm-buku-save-edit',$data->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="card-header text-center">
            <h3 class="card-title title-up">Edit Buku</h3>
        </div>

        <div class="card-body mt-1">
            <div class="input-group no-border">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Nama
                        </i>
                    </span>
                </div>
                <input type="text" class="form-control @error('book_name') is-invalid @enderror" placeholder="Book Name" value="{{ $data->book_name }}" name="book_name" id="book_name" required >
            </div>
            @error('book_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Harga
                        </i>
                    </span>
                </div>
                <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Price" value="{{ $data->price }}" name="harga" id="harga" required >
            </div>
            @error('harga')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Berat
                        </i>
                    </span>
                </div>
                <input type="number" placeholder="Weight" class="form-control @error('weight') is-invalid @enderror" value={{  $data->weight}} name="weight" required/>
            </div>
            @error('weight')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Keterangan
                        </i>
                    </span>
                </div>
                <input type="text"  class="form-control @error('deskripsi') is-invalid @enderror" value="{{ $data->description }}" name="deskripsi" required/>
            </div>
            @error('deskripsi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Stock
                        </i>
                    </span>
                </div>
                <input type="number" placeholder="Stock" class="form-control @error('stock') is-invalid @enderror" value={{ $data->stock }} name="stock" required/>
            </div>
            @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Kategori
                        </i>
                    </span>
                </div>
                <select class="form-control @error('category_id') is-invalid @enderror" data-background-color="orange" name="category_id" required>
                    @foreach ($category as $k )
                        <option style="color:black" value="{{ $k->id }}" {{ ($data->category_name) == $k->id ? 'selected': null}} >{{ $k->category_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="input-group no-border mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Gambar
                        </i>
                    </span>
                </div>
                <input type="hidden" class="form-control @error('hidden_image') is-invalid @enderror" value="{{ $data->image_name }}" name="hidden_image" id="hidden_image" required >
                <input type="file" class="form-control mt-1 @error('image_name') is-invalid @enderror" placeholder="Book Image" name="image_name" id="image_name">
            </div>
            <td><img src="{{ URL::to('/')}}/img/{{ $data->image_name}}" width="70px" height="80px" class="mt-1"></td>
            
            @error('image_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
       
            <div class="col-lg-12 mt-4 mb-2" style="justify-content:center">
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{route('adm-buku')}}" class="btn btn-danger">back</a>
        </div>
    </form>
</div>

@endsection