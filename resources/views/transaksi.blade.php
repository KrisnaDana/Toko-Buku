@extends('layout')

@auth('admin')
@section('title', 'Admin | Transaksi')
@endauth

@auth('user')
@section('title', 'Toko Buku | Transaksi')
@endauth

@auth('user')
@section('body')
@foreach($transaction as $transactions)
<a href="{{route('transaksi-detail', $transactions->id)}}">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{$transactions->status}}</h4>
            <h6 class="card-subtitle mb-3 mt-2 text-muted">Tanggal&nbsp;:&nbsp;{{$transactions->created_at->format('Y-m-d')}}</h6>
            <h6 class="card-subtitle mb-2 text-muted">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;Rp.{{number_format($transactions->total)}}</h6>
            @if($transactions->status == "menunggu bukti pembayaran")
            <div class="form-inline">
                <p class="card-text">Countdown&nbsp;:&nbsp;{{$interval[$loop->index]}}</p>

            </div>
            @endif
        </div>
    </div>
</a>
@endforeach
@endsection
@endauth

@auth('admin')
@section('body')
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th class="text-center" style="width: 50px;">No</th>
            <th class="text-center" style="width: 200px;">Nama User</th>
            <th class="text-center" style="width: 300px;">Status</th>
            <th class="text-center" style="width: 300px;">Tanggal</th>
            <th class="text-center" style="width: 300px;">Total</th>
            <th class="text-center" style="width: 100px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaction as $transactions)
        <tr>
            <th class="text-center"> {{$loop->index+1+($transaction->currentPage()-1)*10}}</th>
            <td class="text-center">{{$transactions->user->name}}</td>
            <td>{{$transactions->status}}</td>
            <td class="text-center">{{$transactions->created_at}}</td>
            <td class="text-center">Rp.{{number_format($transactions->total)}}</td>
            <td class="text-center">
                <a type="button" class="btn btn-primary text-white" href="{{route('adm-transaksi-detail', $transactions->id)}}">Ubah Status</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$transaction->links()}}
@endsection
@endauth