@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('images/' . $vehicle->resim) }}" class="card-img-top" alt="Araç" style="height: 200px; object-fit: cover;">

            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{ $vehicle->marka }} {{ $vehicle->model }}</h3>
                    <p class="card-text"><strong>Vites Türü:</strong> {{ $vehicle->vites }}</p>
                    <p class="card-text"><strong>Yakıt Türü:</strong> {{ $vehicle->yakit }}</p>
                    <p class="card-text"><strong>Koltuk Sayısı:</strong> {{ $vehicle->koltuk }}</p>
                    <p class="card-text"><strong>Fiyat:</strong> {{ $vehicle->fiyat }} TL / Gün</p>
                    <hr>
                    <p class="card-text"><strong>Kasko Durumu:</strong> {{ $vehicle->kasko_durumu ?? 'Bilgi Yok' }}</p>
                    <p class="card-text"><strong>Sigorta:</strong> {{ $vehicle->sigorta ?? 'Bilgi Yok' }}</p>
                    <p class="card-text"><strong>Günlük KM Sınırı:</strong> {{ $vehicle->km_siniri ?? 'Sınırsız' }}</p>
                    <p class="card-text"><strong>Teslimat Bilgisi:</strong> {{ $vehicle->teslimat ?? 'Standart Teslimat' }}</p>
                    <p class="card-text"><strong>Ek Not:</strong> {{ $vehicle->ozel_not ?? '-' }}</p>
                    <hr>
                    <a href="{{ url('/araclarim') }}" class="btn btn-secondary">← Geri Dön</a>
                    <a href="{{ route('user.rent.create', $vehicle->id) }}" class="btn btn-success mt-3">Kirala</a>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
