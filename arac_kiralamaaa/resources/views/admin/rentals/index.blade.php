@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Tüm Kiralamalar</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kullanıcı</th>
                <th>E-posta</th>
                <th>Araç</th>
                <th>Başlangıç</th>
                <th>Bitiş</th>
                <th>Oluşturulma</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->user->email }}</td>
                    <td>{{ $rental->vehicle->marka }} {{ $rental->vehicle->model }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ $rental->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
