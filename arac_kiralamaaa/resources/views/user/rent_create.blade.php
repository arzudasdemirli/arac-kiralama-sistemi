@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $vehicle->marka }} {{ $vehicle->model }} Kiralama</h2>

    <!-- Takvim gösterimi -->
    <div id="calendar" class="mb-4"></div>

    <!-- Kiralama formu -->
    <form action="{{ route('rent.store', $vehicle->id) }}" method="POST">
        @csrf
        
    <!-- Bunu ekle -->
    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

    <div class="form-group">
        <label>Başlangıç Tarihi:</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Bitiş Tarihi:</label>
        <input type="date" name="end_date" class="form-control" required>
    </div>
    <div class="mb-3">
    <label for="toplam_fiyat" class="form-label">Toplam Fiyat:</label>
    <input type="text" id="toplam_fiyat" class="form-control" disabled>
</div>

    <button class="btn btn-primary mt-2">Kirala</button>

</div>
@endsection

@section('scripts')
<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<img src="{{ asset('images/imagese/' . $vehicle->image) }}" alt="{{ $vehicle->marka }}" class="img-fluid mb-4" style="max-height: 300px;">


<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'tr',
        selectable: false,
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch(`/api/vehicle/{{ $vehicle->id }}/rentals`)
                .then(response => response.json())
                .then(data => {
                    // Her kiralama için tüm günleri tek tek event olarak oluştur
                    const events = [];
                    data.forEach(rental => {
                        const startDate = new Date(rental.start_date);
                        const endDate = new Date(rental.end_date);
                        while (startDate <= endDate) {
                            events.push({
                                title: 'Kirada',
                                start: startDate.toISOString().split('T')[0],
                                allDay: true,
                                color: '#dc3545'
                            });
                            startDate.setDate(startDate.getDate() + 1);
                        }
                    });
                    successCallback(events);
                })
                .catch(error => failureCallback(error));
        }
    });
    calendar.render();
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startInput = document.querySelector('input[name="start_date"]');
        const endInput = document.querySelector('input[name="end_date"]');
        const totalPriceInput = document.getElementById('toplam_fiyat');

        // Laravel tarafından bu blade'e gönderdiğin araç verisini alıyoruz
        const gunlukFiyat = {{ $vehicle->fiyat ?? 0 }};

        function hesaplaFiyat() {
            const startDate = new Date(startInput.value);
            const endDate = new Date(endInput.value);

            if (!isNaN(startDate) && !isNaN(endDate) && endDate >= startDate) {
                const farkGun = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                let toplam = farkGun * gunlukFiyat;

                // İndirim uygulama
                if (farkGun >= 7) {
                    toplam *= 0.90; // %10 indirim
                } else if (farkGun >= 3) {
                    toplam *= 0.95; // %5 indirim
                }

                totalPriceInput.value = toplam.toFixed(2) + ' TL (' + farkGun + ' gün)';
            } else {
                totalPriceInput.value = '';
            }
        }

        startInput.addEventListener('change', hesaplaFiyat);
        endInput.addEventListener('change', hesaplaFiyat);
    });
</script>


@endsection
