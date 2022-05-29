@extends('layouts.adm_panel')

@section('title', 'Admin | Edit Kategori Buku')

@section('body')

<div class="card shadow mb-4">
    <form class="form" method="post" action="{{route('adm-book-category-save-edit',$data->id)}}">
        @csrf
        <div class="card-header text-center">
            <h3 class="card-title title-up">Edit Kategori Buku</h3>
        </div>

        <div class="card-body">
            <div class="input-group no-border">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-fw fa-book"></i>Kategori
                        </i>
                    </span>
                </div>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" value="{{ $data->category_name }}" name="category_name" required>
            </div>
            @error('category_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="col-lg-12 mt-4 mb-2" style="justify-content:center">
                <button type="submit" class="btn btn-primary ">Submit</button>
                <a href="{{route('adm-book-category')}}" class="btn btn-danger">back</a>
            </div>

    </form>
</div>
@endsection