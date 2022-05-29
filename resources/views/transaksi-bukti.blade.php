@extends('layouts.adm_panel')

@auth('admin')
@section('title', 'Admin | Transaksi')
@endauth

@auth('admin')
@section('body')
<div class="card mb-3">
    <div class="d-grid mx-3">
        <a type="button" class="btn btn-primary text-white mt-1 mb-2" href="{{route('adm-transaksi-detail', $transaction->id)}}">Kembali</a>
        <div class="progress-container mb-4">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <img class="card-img-top" src="{{url('../proof_of_payment/'. $transaction->proof_of_payment)}}">
</div>
@endsection
@endauth