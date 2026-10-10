@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yeni Şifre Belirle</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email -->
        <div class="form-group">
            <label for="email">E-posta</label>
            <input
              type="email"
              name="email"
              id="email"
              value="{{ old('email', $email) }}"
              required
              class="form-control"
            >
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="password">Yeni Şifre</label>
            <input
              type="password"
              name="password"
              id="password"
              required
              class="form-control"
            >
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Yeni Şifre (Tekrar)</label>
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              required
              class="form-control"
            >
        </div>

        <button type="submit" class="btn btn-primary mt-3">Şifreyi Güncelle</button>
    </form>
</div>
@endsection
