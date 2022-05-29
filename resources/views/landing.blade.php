@extends('landing-layout')

@section('title', 'Toko Buku')

@section('body')
<div class="container mt-5">
    <div class="ml-5">


        @foreach($data as $buku)
        @foreach($datas as $p)
        @if($buku->id == $p->book_id)
        <div class="card mr-3" style="width: 240px; height:400px;">
            <div class="text-center">
                <img class="card-img-top" src="{{ URL::to('/')}}/img/{{ $p->image_name}}" style="height:200px; width:235px;">
                {{-- <img class="card-img-top" src="{{url('image/buku_hack_nasa.jpg')}}" style="height:200px; width:auto;"> --}}
            </div>
            <div class="card-body">
                <p class="card-text" style="font-size:16px; color:black; font-weight:bold; text-align:center;">
                    @auth('user')
                    <a href="{{route('detailbuku', $buku->id)}}" style="color: black">{{ $buku->book_name }}</a>
                    @endauth

                    @auth('admin')
                    <a href="{{route('adm-detailbuku', $buku->id)}}" style="color: black">{{ $buku->book_name }}</a>
                    @endauth
                </p>
                {{-- <h6 class="card-title">{{ $buku->book_price }}</h6> --}}
                <?php
                $k = 1;
                $new_harga = 0;
                ?>
                @foreach($diskon as $d)

                @if($p->book_id == $d->book_id && $d->end >= $time)
                <del>
                    <p class="card-text" style="font-size:18px; color:rgb(255, 98, 0);  font-weight:bold;  text-align:center;">Rp. {{ number_format($buku->price) }}</p>
                </del>
                <?php
                $k = 2;
                $new_harga = $buku->price - ($buku->price * $d->percentage / 100)
                ?>
                <p class="card-text" style="font-size:16px; color:rgb(0, 0, 0);  font-weight:bold; text-align:center;">Rp. {{ number_format($new_harga) }} </p>
                @endif

                @endforeach
                @if($k !=2)
                <p class="card-text" style="font-size:16px; color:rgb(0, 0, 0);  font-weight:bold; text-align:center;">Rp. {{ number_format($buku->price) }} </p>
                @endif

                <div class="row">
                    <?php
                    $k = 1;
                    ?>
                    @foreach($diskon as $d )
                    @if($p->book_id == $d->book_id && $time <= $d->end)
                        <?php
                        $k = 2;
                        //$new_harga = $buku->price - ($buku->price * $d->percentage / 100)
                        ?>
                        <span class="col-1 material-icons-sharp me-1 " style="color: #FFE61B; justify-content:center;">star_purple500</span>
                        <p class="col card-text mt-1 " style="font-size:11px; font-weight:bold; color:black; justify-content:center;">{{ round($buku->book_rate, 1) }} | Stock {{ $buku->stock }} | <span style="color: #ff8502; font-weight:bold;"> Disc {{ $d->percentage }} % </span></p>
                        <p style="font-size:12px; color:black; font-weight:bold; text-align:center;">End : {{ $d->end }}-23-59</p>

                        @endif
                        @endforeach
                        @if($k !=2)
                        <span class="col-1 material-icons-sharp me-1 " style="color: #FFE61B;">star_purple500</span>
                        <p class="col card-text mt-1 " style="font-size:11px; font-weight:bold; color:black;">{{ round($buku->book_rate, 1) }} | Stock {{ $buku->stock }} | Disc 0 % </p>
                        @endif
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endforeach
    </div>
</div>
@endsection