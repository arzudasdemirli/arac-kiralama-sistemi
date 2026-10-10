@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tüm Araçlar</h2>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success">Yeni Araç Ekle</a>
</div>

<div class="container mt-4">
    <h2 class="mb-4">Tüm Araçlar</h2>
    <div class="row">
        @foreach ($vehicles as $vehicle)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="{{ asset('images/' . $vehicle->resim) }}" class="card-img-top" alt="Araç" style="height: 200px; object-fit: cover;">



                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->marka }} {{ $vehicle->model }}</h5>
                        <p class="card-text">
                            Vites: {{ $vehicle->vites }} <br>
                            Yakıt: {{ $vehicle->yakit }} <br>
                            Koltuk: {{ $vehicle->koltuk }} <br>
                            Fiyat: {{ number_format($vehicle->fiyat, 2) }} TL/gün
                        </p>

                        @php
                            $kiralanmis = $vehicle->rentals()->where('end_date', '>=', now())->exists();
                        @endphp
                        <p class="mb-2">
                            <span class="badge {{ $kiralanmis ? 'bg-danger' : 'bg-success' }}">
                                {{ $kiralanmis ? 'Kiralanmış' : 'Müsait' }}
                            </span>
                        </p>

                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>

                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Sil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
