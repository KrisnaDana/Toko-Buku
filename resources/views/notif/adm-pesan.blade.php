@extends('layouts.adm_panel')

@section('title', 'Admin | Notification')

@section('body')
<link rel="stylesheet" type="text/css" href="/css/star.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="card " style="width: 75rem;" data-background-color="white">
    <div class="card-header mt-2" style="height: 40pt; text-align:center; color:black; text-size:5pt">
      Admin Notification All
    </div>    
 
<!-- alert data pesan ------------------------------------------------------------- -->
    @php $admin_notifikasi = App\Models\admin_notification::where('notifiable_id',3)->where('read_at', NULL)->orderBy('created_at','desc')->paginate(5); @endphp
    @forelse ($admin_notifikasi as $notifikasi)
        @php $notif = json_decode($notifikasi->data); @endphp
        <a href="{{ route('admin.notification', $notifikasi->id) }}" class="dropdown-item btnunNotif" data-num=""><img src="{{url('image/profile.jpg')}}" style="height:20px; width:20px; border-radius: 50%;" class="mr-1">[{{ $notif->nama }}] {{ $notif->message }}</a>
    @empty
       
        <center><small style="text-align: center">Tidak ada notifikasi</small></center>
         
    @endforelse

 
<!-- alert data pesan ------------------------------------------------------------- -->

</div>
@endsection