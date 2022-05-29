@extends('layouts.adm_panel')


@section('title', 'Admin | Profil')
@section('body')
<div class="container card ">
<div class="text-center mt-3">
    @if(!empty($profil->profile_image))
    <img class="card-img-top" src="{{url('profile_image/'. $profil->profile_image)}}" style="height:200px; width: 200px;">
    @else
    <img class="card-img-top" src="{{url('image/profile.jpg')}}" style="height:200px; width: 200px;">
    @endif
</div>

<form action="{{route('adm-profil-submit', $profil->id)}}" method="post" enctype="multipart/form-data" class="mb-3">
    @csrf
    <div class="form-group mb-2">
        <label>Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$profil->username}}" readonly>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$profil->name}}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$profil->phone}}">
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Foto Profil</label>
        <input class="form-control @error('profile_image') is-invalid @enderror" type="file" name="profile_image">
        @error('profile_image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">Ubah</button>
        <a href="{{route('adm-beranda')}}" type="button" class="btn btn-danger">Kembali</a>
    </div>

</form>
</div>
@endsection


