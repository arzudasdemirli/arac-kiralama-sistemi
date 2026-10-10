@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Kiralama İşlemlerim</h2>
    <div class="row">
        @forelse($rentals as $rental)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <img src="{{ asset('images/' . $vehicle->resim) }}" class="card-img-top" alt="Araç" style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title">{{ $rental->vehicle->marka }} {{ $rental->vehicle->model }}</h5>
                    <p class="card-text">
                        <strong>Başlangıç:</strong> {{ \Carbon\Carbon::parse($rental->start_date)->format('d.m.Y') }}<br>
                        <strong>Bitiş:</strong> {{ \Carbon\Carbon::parse($rental->end_date)->format('d.m.Y') }}<br>
                        <strong>Durum:</strong> 
                        @if(\Carbon\Carbon::parse($rental->end_date)->isPast())
                            Tamamlandı
                        @elseif(\Carbon\Carbon::parse($rental->start_date)->isToday())
                            Bugün Başladı
                        @else
                            Gelecek
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @empty
        <p>Hiç kiralama işlemi bulunamadı.</p>
        @endforelse
    </div>
</div>
@endsection
