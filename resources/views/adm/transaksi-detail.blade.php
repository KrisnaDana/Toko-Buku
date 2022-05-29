@extends('layouts.adm_panel')


@section('title', 'Admin | Transaksi')


@section('body')
<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$transaction->user->name}}</h4>
                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" class="form-control" readonly value="{{$transaction->province}}" name="province">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" readonly value="{{$transaction->regency}}" name="regency">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" readonly value="{{$transaction->address}}" name="address">
                </div>
                <div class="form-group">
                    <label>Kurir</label>
                    <input type="text" class="form-control" readonly value="{{$transaction->courier->courier}}" name="courier">
                </div>
            </div>
        </div>


        @foreach($transaction_detail as $transaction_details)
        <div class="card mt-2">
            @php
            $gambar = App\Models\book_image::where('book_id', '=', $transaction_details->book_id)->first();
            @endphp
            <div class="row g-0 mt-2">
                <div class="col-md-3">
                    <img class="img-fluid rounded-start" src="{{url('img/'. $gambar->image_name)}}" style="height:200px;">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h4 class="card-title">{{$transaction_details->book->book_name}}</h4>

                        <div class="form-inline">
                            <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h5>
                            <h5 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($transaction_details->selling_price)}}</h5>
                        </div>

                        @if($transaction_details->discount != 0)
                        <h6 class="card-subtitle mb-2 text-muted">
                            Diskon&nbsp;&nbsp;:
                            <span>{{$transaction_details->discount}}%</span>
                        </h6>
                        @endif

                        <div class="text-end">
                            <div class="form-inline">

                                <h6 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h6>
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($transaction_details->selling_price)}}</h6>
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">&nbsp;x&nbsp;</h6>
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">{{$transaction_details->qty}}</h6>
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">&nbsp;=&nbsp;</h6>
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h6>
                                @php
                                $wkwk = $transaction_details->selling_price * $transaction_details->qty;
                                @endphp
                                <h6 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($wkwk)}}</h6>

                            </div>


                            @auth('admin')
                            @php
                            $book_review = 0;
                            $book_review = App\Models\book_review::where('transaction_detail_id', '=', $transaction_details->id)->get();
                            @endphp

                            @if(count($book_review) > 0)
                            <div class="text-start mt-3">
                                <h6 class="card-subtitle text-muted">{{ $book_review[0]->user->name }} &nbsp;&nbsp;<span class="material-icons-sharp" style="color: #ff951b; vertical-align: top; font-size:15px;">star_purple500</span> {{$book_review[0]->rate}}</h6>
                                <p class="card-text">{{$book_review[0]->content}}</p>
                            </div>
                            <form class="form-inline mt-2" method="post" action="{{route('adm-response-submit', $book_review[0]->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('content') is-invalid @enderror" placeholder="Berikan Balasan" style="width:480px;" name="content" spellcheck="false">
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary ms-2">Kirim</button>
                            </form>
                            @endif
                            @endauth

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4" style="text-align: center">Transaksi</h4>
                <div class="row">
                    <div class="col-5">
                        <h6 class="card-subtitle mb-3 text-muted">Subtotal</h6>
                        <h6 class="card-subtitle text-muted">Ongkir</h6>
                    </div>
                    <div class="col-7">
                        <div class="form-inline mb-3">
                            <h6 class="card-subtitle text-muted">Rp.</h6>
                            <h6 class="card-subtitle text-muted">{{number_format($transaction->subtotal)}}</h6>
                        </div>
                        <div class="form-inline">
                            <h6 class="card-subtitle text-muted">Rp.</h6>
                            <h6 class="card-subtitle text-muted">{{number_format($transaction->shipping_cost)}}</h6>
                        </div>
                    </div>
                    <div class="progress-container mb-4 mt-2">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-5 mt-3">
                        <h6 class="card-subtitle mb-2 text-muted">Total</h6>
                    </div>
                    <div class="col-7 mt-3">
                        <div class="form-inline">
                            <h6 class="card-subtitle mb-2 text-muted">Rp.</h6>
                            <h6 class="card-subtitle mb-2 text-muted">{{number_format($transaction->total)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="badge badge-primary mb-4">{{$transaction->status}}</h4>
                </div>



                @auth('admin')
                @if($transaction->status == "menunggu bukti pembayaran")
                <div class="row">
                    <div class="progress-container mb-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Countdown&nbsp;:</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$interval}}</h6>
                    </div>
                </div>
                @else
                <div class="progress-container mb-4">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <form class="d-grid" method="post" action="{{route('adm-transaksi-status', $transaction->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-2">
                        <label>Ubah Status</label>
                        <select class="form-control" name="status" required>
                            <option selected value="">Pilih Status</option>
                            <option value="sudah terverifikasi">Sudah Terverifikasi</option>
                            <option value="transaksi dibatalkan">Transaksi Dibatalkan</option>
                            <option value="barang dalam pengiriman">Barang Dalam Pengiriman</option>
                            <option value="barang telah sampai di tujuan">Barang Telah Sampai Di Tujuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
                <div class="progress-container mb-4">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <a type="button" class="btn btn-info text-white mt-1 mb-2" href="{{route('adm-transaksi-bukti', $transaction->id)}}">Lihat Bukti Pembayaran</a>
                    <a href="{{url('proof_of_payment/'. $transaction->proof_of_payment)}}" type="button" class="btn btn-outline-primary" download>Unduh Bukti Pembayaran</a>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection