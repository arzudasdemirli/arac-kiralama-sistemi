@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Profilim</h2>

    <div class="row">
        <!-- Sol Kısım: Bilgiler -->
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3">Kullanıcı Bilgileri</h5>

                <p><strong>Ad Soyad:</strong> {{ $user->name }}</p>
                <p><strong>E-posta:</strong> {{ $user->email }}</p>
                <p><strong>Telefon:</strong> {{ $user->phone ?? 'Eklenmedi' }}</p>
                <p><strong>Kayıt Tarihi:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
                <p><strong>Toplam Kiralama:</strong> {{ $user->rentals()->count() }} araç</p>

                <a href="{{ route('rentals.index') }}" class="btn btn-outline-secondary btn-sm mt-2">Kiralama Geçmişim</a>
            </div>
        </div>

        <!-- Sağ Kısım: Güncelle -->
        <div class="col-md-7">
            <div class="card shadow-sm p-4 mb-4">
                <h5>Bilgileri Güncelle</h5>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Ad Soyad</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label>E-posta</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label>Telefon</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Bilgileri Güncelle</button>
                </form>
            </div>

            <div class="card shadow-sm p-4">
                <h5>Şifre Değiştir</h5>
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Yeni Şifre</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Şifre Tekrar</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-danger">Şifreyi Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
