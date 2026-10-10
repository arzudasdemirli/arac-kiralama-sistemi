@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kayıt Ol</h2>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div>
            <label>Ad Soyad</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>E-posta</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>Şifre</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Şifre Tekrar</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>Kayıt Tipi</label>
            <select name="role" required>
                <option value="kullanici">Kullanıcı</option>
                <option value="yonetici">Yönetici</option>
            </select>
        </div>

        <button type="submit">Kayıt Ol</button>
    </form>
</div>
@endsection
