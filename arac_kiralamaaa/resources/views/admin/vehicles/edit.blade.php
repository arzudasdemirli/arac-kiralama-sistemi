@extends('layouts.admin') {{-- Admin panel ortak layout'u varsa onu kullan --}}

@section('content')
<div class="container mt-4">
    <h2>Araç Düzenle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- PUT metoduyla güncelleme --}}
        
        <div class="mb-3">
            <label for="brand" class="form-label">Marka</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Yıl</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $vehicle->year) }}" required>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Renk</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $vehicle->color) }}">
        </div>

        <div class="mb-3">
            <label for="daily_price" class="form-label">Günlük Fiyat (₺)</label>
            <input type="number" step="0.01" class="form-control" id="daily_price" name="daily_price" value="{{ old('daily_price', $vehicle->daily_price) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Araç Görseli</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($vehicle->image)
                <p>Mevcut görsel:</p>
                <img src="{{ asset('images/' . $vehicle->resim) }}" class="card-img-top" alt="Araç" style="height: 200px; object-fit: cover;">

            
                @endif
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection
