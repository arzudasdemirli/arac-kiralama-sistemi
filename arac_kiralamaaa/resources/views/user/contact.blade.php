@extends('layouts.app')  {{-- Veya kendi kullandığın ana layout dosyası --}}

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2>Bize Ulaşın</h2>

    {{-- Başarılı mesaj --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hata mesajları --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('contact/send.user') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Adınız</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-posta</label>
            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Mesajınız</label>
            <textarea id="message" name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
</div>
@endsection
