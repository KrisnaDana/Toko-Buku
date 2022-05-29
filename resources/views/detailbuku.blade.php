@extends('layout')

@auth('user')
@section('title', 'Toko Buku | Buku')
@endauth

@auth('admin')
@section('title', 'Admin | Buku')
@endauth

@section('body')

<div class="row">
    <div class="col-2">
        @foreach($book_image as $book_images)
        <img class="card-img-top mb-2" src="{{url('img/'. $book_images->image_name)}}" style="height:200px; width: auto; max-width:200px;">
        @endforeach
    </div>

    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$book->book_name}}</h4>
                @if(!empty($discount))
                <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.{{number_format($harga)}} <span class="text-decoration-line-through">Rp.{{number_format($book->price)}}</span></h5>
                @else
                <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.{{number_format($book->price)}}</h5>
                @endif

                @if(!empty($discount))
                <h6 class="card-subtitle mb-2 text-muted">
                    Diskon&nbsp;&nbsp;:
                    @foreach($discount as $discounts)
                    @if($loop->index==0)
                    <span>{{$discounts->percentage}}%</span>
                    @else
                    <span> + {{$discounts->percentage}}%</span>
                    @endif
                    @endforeach
                </h6>
                @endif
                <h6 class="card-subtitle mb-2 text-muted">Stok&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$book->stock}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Berat&nbsp;&nbsp;&nbsp;&nbsp;: {{$book->weight}} Kg</h6>
                <p class="card-text">{{$book->description}}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-10">
                        <h4 class="card-title">Ulasan</h4>
                    </div>
                    <div class="col">
                        <h4 class="card-title" style="vertical-align: top;"><span class="material-icons-sharp" style="color: #FFE61B; vertical-align: top; font-size:27px;">star_purple500</span> {{round($book->book_rate, 1)}}</h4>
                    </div>

                </div>

                @if(!empty($book_review))
                @foreach($book_review as $book_reviews)
                <div class="progress-container mb-4">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <h6 class="card-subtitle text-muted">{{ $book_reviews->user->name }} &nbsp;&nbsp;<span class="material-icons-sharp" style="color: #FFE61B; vertical-align: top; font-size:15px;">star_purple500</span> {{$book_reviews->rate}}</h6>
                <p class="card-text">{{$book_reviews->content}}</p>

                @php
                $response = App\Models\response::where('review_id', '=', $book_reviews->id)->get();
                @endphp

                @if(count($response)>0)
                @foreach($response as $responses)
                <div style="margin-left:300px;">
                    <h6 class="card-subtitle text-muted">Admin | {{ $responses->admin->name }}</h6>
                    <p class="card-text mb-3">{{$responses->content}}</p>
                </div>
                @endforeach
                @endif

                @endforeach
                @endif
            </div>
        </div>
    </div>

    @auth('user')
    @if($book->stock != 0)
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atur Jumlah</h4>
                <input class="form-control form-control-lg" type="number" value="1" id="jumlah" min="1" max="{{$book->stock}}" onkeyup="stock = '<?php echo $book->stock; ?>';   if(this.value<0){this.value= this.value * -1}else if(this.value==0){this.value = 1}else if(this.value > stock){this.value = stock}">
                <h6 class="card-subtitle mb-2 mt-2 text-muted">Subtotal : Rp. <span id="subtotal">
                        @if(!empty($discount))
                        {{number_format($harga)}}
                        @else
                        {{number_format($book->price)}}
                        @endif
                    </span></h6>

                <form class="d-grid" method="post" action="{{route('keranjang-tambah', $book->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input type="number" class="form-control" value="1" id="keranjang" name="jumlah_keranjang" hidden>
                    <button type="submit" class="btn btn-primary">+ Keranjang</button>
                </form>

                <form class="d-grid" method="post" action="{{route('beli-alamat', $book->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input type="number" class="form-control" value="1" id="beli" name="jumlah_beli" hidden>
                    <button type="submit" class="btn btn-outline-primary">Beli Langsung</button>
                </form>

            </div>
        </div>
    </div>
    @endif
    @if(!empty($discount))
    @php
    $harga_fix = $harga;
    @endphp
    @else
    @php
    $harga_fix = $book->price
    @endphp
    @endif

    @endauth
</div>

@auth('user')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var jumlah = "jumlah";
        var harga = "<?php echo $harga_fix; ?>";
        $("#" + jumlah).change(function() {
            var cek = harga * $("#jumlah").val();
            var hasil = cek.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            $("#subtotal").text(hasil);
            $("#keranjang").val($("#jumlah").val());
            $("#beli").val($("#jumlah").val());
        });
    });
</script>
@endauth

@endsection