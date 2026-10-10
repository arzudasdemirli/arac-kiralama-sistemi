@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Mesaj Detayı</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Ad Soyad:</strong> {{ $message->ad_soyad }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Konu:</strong> {{ $message->konu }}</p>
            <p><strong>Mesaj:</strong><br>{{ $message->mesaj }}</p>

            <hr>

            <h5>Cevap</h5>
            @if($message->reply)
                <div class="alert alert-info">
                    {{ $message->reply }}
                    <br>
                    <small><em>Cevap tarihi: {{ $message->replied_at ? \Carbon\Carbon::parse($message->replied_at)->format('d.m.Y H:i') : '-' }}</em></small>

                </div>
            @else
                <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="reply" class="form-label">Cevabınızı Yazınız</label>
                        <textarea name="reply" id="reply" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Cevap Gönder</button>
                </form>
            @endif

            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary mt-3">Geri Dön</a>
        </div>
    </div>
</div>
@endsection
