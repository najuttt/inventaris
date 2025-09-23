@extends('layouts.index')

@section('content')
<div class="container">
    <h3>Dashboard Pegawai</h3>

    <h5 class="mt-4">Notifikasi</h5>
    @if($notifications->isEmpty())
        <p class="text-muted">Belum ada notifikasi.</p>
    @else
        <ul class="list-group">
            @foreach($notifications as $notif)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $notif->title }} - {{ $notif->message }}
                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
