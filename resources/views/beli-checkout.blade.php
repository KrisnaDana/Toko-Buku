@extends('layout')

@section('title', 'Toko Buku | Transaksi')

@section('body')
<form method="post" action="{{route('beli-bayar', ['id' => $book->id, 'jumlah' => $jumlah])}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{Auth::guard('user')->user()->name}}</h4>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" readonly value="{{$province_name}}" name="province">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" class="form-control" readonly value="{{$regency_name}}" name="regency">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" readonly value="{{$address}}" name="alamat">
                    </div>
                    <div class="form-group">
                        <label>Kurir</label>
                        <input type="text" class="form-control" readonly value="{{$kurir->courier}}" name="courier">
                    </div>
                </div>
            </div>


            <div class="card">
                @php
                $gambar = App\Models\book_image::where('book_id', '=', $book->id)->first();
                @endphp
                <div class="row g-0">
                    <div class="col-md-3">
                        <img class="img-fluid rounded-start" src="{{url('img/'. $gambar->image_name)}}" style="height:200px;">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4 class="card-title">{{$book->book_name}}</h4>

                            @php
                            $tanggal = Carbon\Carbon::now()->format('Y-m-d');
                            $diskon = App\Models\discount::where('book_id', '=', $book->id)->where('start', '<=', $tanggal)->where('end', '>=', $tanggal)->get();
                                $harga = $book->price;

                                if (count($diskon) > 0) {
                                foreach ($diskon as $diskons) {
                                $harga = $harga - ($harga * $diskons->percentage / 100);
                                }

                                }
                                @endphp

                                <div class="form-inline">
                                    <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h5>
                                    <h5 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($harga)}}</h5>
                                    @if(count($diskon)>0)
                                    <h5 class="card-subtitle mb-2 mt-2 ms-2 text-muted text-decoration-line-through">Rp.{{number_format($book->price)}}</h5>
                                    @endif
                                </div>


                                @if(count($diskon)>0)
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Diskon&nbsp;&nbsp;:
                                    @foreach($diskon as $diskons)
                                    @if($loop->index==0)
                                    <span>{{$diskons->percentage}}%</span>
                                    @else
                                    <span> + {{$diskons->percentage}}%</span>
                                    @endif
                                    @endforeach
                                </h6>
                                @endif

                                <div class="text-end">
                                    <div class="form-inline">
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($harga)}}</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">&nbsp;x&nbsp;</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">{{$jumlah}}</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">&nbsp;=&nbsp;</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">Rp.</h6>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">{{number_format($harga * $jumlah)}}</h6>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
                <input type="number" class="form-control" value="{{$book->id}}" name="book" hidden>
                <input type="number" class="form-control" value="{{$discount}}" name="discount" hidden>
                <input type="number" class="form-control" value="{{$selling_price}}" name="selling_price" hidden>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Pembayaran</h4>
                    <div class="row">
                        <div class="col-5">
                            <h6 class="card-subtitle mb-3 text-muted">Subtotal</h6>
                            <h6 class="card-subtitle text-muted">Ongkir</h6>
                        </div>
                        <div class="col-7">
                            <div class="form-inline mb-3">
                                <h6 class="card-subtitle text-muted">Rp.</h6>
                                <h6 class="card-subtitle text-muted">{{number_format($subtotal)}}</h6>
                            </div>
                            <div class="form-inline">
                                <h6 class="card-subtitle text-muted">Rp.</h6>
                                <h6 class="card-subtitle text-muted">{{number_format($shipping_cost)}}</h6>
                            </div>
                        </div>
                        <div class="progress-container mb-4">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <h6 class="card-subtitle mb-2 text-muted">Total</h6>
                        </div>
                        <div class="col-7">
                            <div class="form-inline">
                                <h6 class="card-subtitle mb-2 text-muted">Rp.</h6>
                                <h6 class="card-subtitle mb-2 text-muted">{{number_format($total)}}</h6>
                            </div>
                        </div>
                    </div>

                    <input type="number" class="form-control" value="{{$subtotal}}" name="subtotal" hidden>
                    <input type="number" class="form-control" value="{{$shipping_cost}}" name="shipping_cost" hidden>
                    <input type="number" class="form-control" value="{{$total}}" name="total" hidden>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#kota').on('click', function() {
        $("#kota option").each(function() {
            if ($(this).attr("id") == $('#provinsi').children(":selected").attr("id")) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
</script>
@endsection