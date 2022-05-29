@extends('layouts.adm_panel')

@section('title', 'Admin | Kategori Detail Buku Edit')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="section section-signup" style="background-position: top center; min-height: 700px;">
    <div class="container">
        <div class="row">
            <div class="card" data-background-color="orange">
                <form class="form" method="post" action="{{route('adm-img-book-category-detail-save-edit',$data->id)}}">
                    @csrf
                    <div class="card-header text-center">
                        <h3 class="card-title title-up">Add Kategiri Detail Buku Edit</h3>
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
                            <select class="form-control @error('book_id') is-invalid @enderror" data-background-color="orange" name="book_id" required>
                                @foreach ($buku as $b )
                                    <option style="color:black" value="{{ $b->id }}" {{ ($data->book_id) == $b->id ? 'selected': null}}>{{ $b->book_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('book_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="input-group no-border">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons-sharp">
                                        <span>book</span>
                                    </i>
                                </span>
                            </div>
                            <select class="form-control @error('category_id') is-invalid @enderror" data-background-color="orange" name="category_id" required>
                                @foreach ($category as $k )
                                    <option style="color:black" value="{{ $k->id }}" {{ ($data->category_id) == $k->id ? 'selected': null}} >{{ $k->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
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
            <a href="{{route('adm-img-book-category-detail')}}" class="btn btn-outline-default btn-round btn-white btn-lg">Kembali Ke Landing Page</a>
        </div>
    </div>
</div>
@endsection