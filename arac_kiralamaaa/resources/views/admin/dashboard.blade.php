@extends('layouts.admin')

@section('title', 'Yönetici Paneli - Anasayfa')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Yönetici Paneline Hoş Geldin!</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-header">Toplam Araçlar</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h2 class="card-title display-4">{{ $totalVehicles }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success h-100">
                <div class="card-header">Aktif Kiralamalar</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h2 class="card-title display-4">{{ $activeRentals }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-header">Okunmamış Mesajlar</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h2 class="card-title display-4">{{ $unreadMessages }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info h-100">
                <div class="card-header text-white">Toplam Kiralamalar</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h2 class="card-title display-4 text-white">{{ $totalRentals ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Son Kiralamalar -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clock"></i> Son Kiralamalar
                    <a href="{{ route('admin.rentals.index') }}" class="btn btn-sm btn-outline-primary float-end">Tümünü Gör</a>
                </div>
                <div class="card-body p-0">
                    @if($recentRentals->isEmpty())
                        <p class="p-3 mb-0">Henüz kiralama bulunmamaktadır.</p>
                    @else
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Araç</th>
                                <th>Kullanıcı</th>
                                <th>Başlangıç</th>
                                <th>Bitiş</th>
                                <th>Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRentals as $rental)
                            <tr>
                                <td>{{ $rental->vehicle->marka }} {{ $rental->vehicle->model }}</td>
                                <td>{{ $rental->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($rental->start_date)->format('d.m.Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($rental->end_date)->format('d.m.Y') }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($rental->end_date)->isPast())
                                        <span class="badge bg-secondary">Tamamlandı</span>
                                    @elseif(now()->between($rental->start_date, $rental->end_date))
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-primary">Gelecek</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- Son Mesajlar -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-envelope"></i> Son Mesajlar
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary float-end">Tümünü Gör</a>
                </div>
                <div class="card-body p-2" style="max-height: 350px; overflow-y: auto;">
                    @forelse($recentMessages as $message)
                    <div class="border-bottom mb-2 pb-2">
                        <strong>{{ $message->user->name ?? $message->ad_soyad }}</strong><br>
                        <small class="text-muted">{{ \Illuminate\Support\Str::limit($message->content, 60) }}</small><br>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    @empty
                    <p class="text-muted">Yeni mesaj bulunmamaktadır.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Kiralama Durumları Grafik -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card p-3">
                <h5>Kiralama Durumları</h5>
                <canvas id="rentalStatusChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('rentalStatusChart').getContext('2d');
    const rentalStatusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Tamamlandı', 'Gelecek'],
            datasets: [{
                label: 'Kiralama Durumu',
                data: [{{ $activeRentals ?? 0 }}, {{ $completedRentals ?? 0 }}, {{ $futureRentals ?? 0 }}],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(108, 117, 125, 0.7)',
                    'rgba(0, 123, 255, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endpush
