@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Gelen Mesajlar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Konu</th>
                <th>Durum</th>
                <th>Tarih</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->ad_soyad }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->konu }}</td>
                    <td>
                        @if($msg->read)
                            <span class="badge bg-success">Okundu</span>
                        @else
                            <span class="badge bg-warning text-dark">Okunmadı</span>
                        @endif
                    </td>
                    <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-primary">Göster</a>
                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğine emin misin?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
