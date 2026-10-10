@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Araç Ekle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="marka" class="form-label">Marka</label>
            <input type="text" class="form-control" id="marka" name="marka" value="{{ old('marka') }}" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" required>
        </div>
        <div class="mb-3">
            <label for="vites" class="form-label">Vites</label>
            <input type="text" class="form-control" id="vites" name="vites" value="{{ old('vites') }}" required>
        </div>
        <div class="mb-3">
            <label for="yakit" class="form-label">Yakıt</label>
            <input type="text" class="form-control" id="yakit" name="yakit" value="{{ old('yakit') }}" required>
        </div>
        <div class="mb-3">
            <label for="koltuk" class="form-label">Koltuk Sayısı</label>
            <input type="number" class="form-control" id="koltuk" name="koltuk" value="{{ old('koltuk') }}" required>
        </div>
        <div class="mb-3">
            <label for="fiyat" class="form-label">Fiyat (TL/gün)</label>
            <input type="number" step="0.01" class="form-control" id="fiyat" name="fiyat" value="{{ old('fiyat') }}" required>
        </div>
        <div class="mb-3">
            <label for="resim" class="form-label">Araç Resmi (Opsiyonel)</label>
            <input type="file" class="form-control" id="resim" name="resim" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Araç Ekle</button>
        <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Geri</a>
    </form>
</div>
@endsection
