@extends('layouts.adm_panel')



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
                <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.{{$harga}} <span class="text-decoration-line-through">Rp.{{$book->price}}</span></h5>
                @else
                <h5 class="card-subtitle mb-2 mt-2 text-muted">Rp.{{$book->price}}</h5>
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


</div>



@endsection