@extends('layouts.adm_panel')

@section('yield')
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        @php $admin_unRead = App\Models\admin_notification::where('notifiable_id',3)->where('read_at', NULL)->orderBy('created_at','desc')->count(); @endphp
        <span class="badge bg-danger">@php echo $admin_unRead @endphp</span>
    </a>
    
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Pesan Notifikasi
        </h6>
    <!-- alert data pesan ------------------------------------------------------------- -->
        @php $admin_notifikasi = App\Models\admin_notification::where('notifiable_id',3)->where('read_at', NULL)->orderBy('created_at','desc')->paginate(5); @endphp
        @forelse ($admin_notifikasi as $notifikasi)
            @php $notif = json_decode($notifikasi->data); @endphp
            <a href="{{ route('admin.notification', $notifikasi->id) }}" class="dropdown-item btnunNotif" data-num=""><small> <img src="{{url('image/profile.jpg')}}" style="height:15px; width:15px; border-radius: 50%;" class="mr-1">[{{ $notif->nama }}] {{ $notif->message }}</small></a>
        @empty
           
            <center><small style="text-align: center">Tidak ada notifikasi</small></center>
             
        @endforelse
  
        @if($admin_unRead >= 4)
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('adm-pesan') }}">Show All Alerts</a>
        @endif
    <!-- alert data pesan ------------------------------------------------------------- -->
    </div>
</li>
    
@endsection