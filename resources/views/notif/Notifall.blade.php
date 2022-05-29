@extends('layout')

@section('title', 'User | Notification')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="card " style="width: 60rem;" data-background-color="white">
    <div class="card-header mt-2" style="height: 20pt; text-align:center; color:black; text-size:5pt">
      User Notification All
    </div>    
    <ul class="list-group list-group-flush mt-3 mb-3">
        @foreach ($allNotif as $notife)
            @php $notif = json_decode($notife->data); @endphp
            <li>
                <a href="{{ route('user.notification', $notife->id) }}" class="dropdown-item btnunNotif mt-1;" style="color: black;" data-num=""><img src="{{url('image/profile.jpg')}}" style="height:20px; width:20px; border-radius: 50%;" class="mr-1">[{{ $notif->nama }}] {{ $notif->message }}</a>
            </li>
        @endforeach 
    </ul>
</div>
@endsection