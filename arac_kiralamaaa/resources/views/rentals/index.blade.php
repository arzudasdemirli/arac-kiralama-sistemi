@extends('layouts.app')

@section('content')
<div class="container">
    <div id="alertPlaceholder"></div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-car"></i> Kiralama İşlemlerim</h2>
        <div>
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-success me-2">🚗 Yeni Araç Kirala</a>
            <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary">🚘 Araçlarımı Gör</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @if($rentals->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Henüz bir araç kiralamadınız.
            <a href="{{ route('vehicles.index') }}">Yeni kiralama başlatmak için tıklayın</a>.
        </div>
    @else
        <div class="row">
            @foreach($rentals as $rental)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('images/' . $rental->vehicle->resim) }}" class="card-img-top" alt="Araç Resmi" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $rental->vehicle->marka }} {{ $rental->vehicle->model }}</h5>
                        <p class="card-text mb-2">
                            <i class="fas fa-calendar-day text-primary"></i> <strong>Başlangıç:</strong> {{ \Carbon\Carbon::parse($rental->start_date)->format('d.m.Y') }}<br>
                            <i class="fas fa-calendar-check text-success"></i> <strong>Bitiş:</strong> {{ \Carbon\Carbon::parse($rental->end_date)->format('d.m.Y') }}<br>
                            <i class="fas fa-info-circle text-warning"></i> <strong>Durum:</strong>
                            @if(\Carbon\Carbon::parse($rental->end_date)->isPast())
                                <span class="badge bg-secondary">Tamamlandı</span>
                            @elseif(now()->between($rental->start_date, $rental->end_date))
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-primary">Gelecek</span>
                            @endif
                        </p>

                        <p class="card-text mb-2">
                            <i class="fas fa-coins text-info"></i> 
                            <strong>Kapora:</strong> {{ number_format($rental->deposit_amount, 2, ',', '.') }} TL
                        </p>

                        @if ($rental->deposit_paid)
                            <span class="text-success">Kapora Ödendi</span>
                        @else
                            <span class="text-danger">Kapora Bekliyor</span>
                            <button class="btn btn-sm btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#payModal{{ $rental->id }}">💳 Kapora Öde</button>

                            <!-- Kapora ödeme modal -->
                            <div class="modal fade" id="payModal{{ $rental->id }}" tabindex="-1" aria-labelledby="payModalLabel{{ $rental->id }}" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form method="POST" action="{{ route('rentals.payDeposit', $rental->id) }}">
                                    @csrf
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="payModalLabel{{ $rental->id }}">Kapora Ödeme</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>Ödenecek Tutar:</strong> {{ number_format($rental->deposit_amount, 2, ',', '.') }} TL</p>
                                      <div class="mb-3">
                                        <label>Kart Sahibi Adı</label>
                                        <input type="text" class="form-control" required placeholder="Ad Soyad">
                                      </div>
                                      <div class="mb-3">
                                        <label>Kart Numarası</label>
                                        <input type="text" class="form-control" required placeholder="**** **** **** ****">
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6 mb-3">
                                          <label>Son Kullanma Tarihi</label>
                                          <input type="text" class="form-control" required placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          <label>CVC</label>
                                          <input type="text" class="form-control" required placeholder="***">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                                      <button type="submit" class="btn btn-success">💳 Ödemeyi Tamamla</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('vehicle.show', $rental->vehicle->id) }}" class="btn btn-outline-primary btn-sm">🔁 Tekrar Kirala</a>
                            @if(now()->lt($rental->start_date))
                            <button class="btn btn-danger btn-sm btn-delete"
                                data-id="{{ $rental->id }}"
                                data-deposit="{{ $rental->deposit_paid ? '1' : '0' }}">
                                ❌ İptal Et
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Silme modal -->
<div id="deleteModal" style="display:none; position:fixed; 
    top:50%; left:50%; transform: translate(-50%, -50%);
    background:#fff; border:1px solid #ccc; padding:20px; z-index:1050; max-width:400px; width:90%;">
    <p id="modalText"></p>
    <div id="ibanForm" style="display:none; margin-top:15px;">
        <label>İade için IBAN giriniz:</label>
        <input type="text" id="ibanInput" placeholder="TR..." class="form-control mt-2">
    </div>
    <div class="mt-3 d-flex justify-content-between">
        <button id="confirmDeleteBtn" class="btn btn-danger"></button>
        <button id="cancelBtn" class="btn btn-secondary">İptal</button>
    </div>
</div>

<!-- Arka plan karartma -->
<div id="modalBackdrop" style="display:none; 
    position:fixed; top:0; left:0; width:100%; height:100%; 
    background:rgba(0,0,0,0.5); z-index:1040;"></div>

<script>
    function showAlert(message, type = 'success') {
    const alertPlaceholder = document.getElementById('alertPlaceholder');
    alertPlaceholder.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
        </div>
    `;
}
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
        const rentalId = btn.getAttribute('data-id');
        const depositPaid = btn.getAttribute('data-deposit') === '1';

        const modal = document.getElementById('deleteModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalText = document.getElementById('modalText');
        const ibanForm = document.getElementById('ibanForm');
        const ibanInput = document.getElementById('ibanInput');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        if (depositPaid) {
            modalText.textContent = "Bu aracı iptal etmek istediğinize emin misiniz? Kapora yatırılmış, iade için IBAN bilgisi gerekecek.";
            ibanForm.style.display = 'block';
            confirmDeleteBtn.textContent = "Sil ve Gönder";
        } else {
            modalText.textContent = "Bu aracı iptal etmek istediğinize emin misiniz?";
            ibanForm.style.display = 'none';
            ibanInput.value = '';
            confirmDeleteBtn.textContent = "Sil";
        }

        modal.style.display = 'block';
        modalBackdrop.style.display = 'block';

        confirmDeleteBtn.onclick = () => {
            const iban = ibanInput.value.trim();

            if (depositPaid && (!iban || !iban.startsWith('TR') || iban.length < 26)) {
                alert('Lütfen geçerli bir IBAN giriniz.');
                return;
            }
            fetch('{{ route("rental.delete") }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({  id: rentalId, iban: iban})
})
.then(res => res.json())
.then(data => {
    if (data.success) {
        alert(data.message);
        location.reload();
    } else {
        alert(data.message);
    }
})
.catch(error => {
    console.error('Hata:', error);
});


            
            
        };

        document.getElementById('cancelBtn').onclick = () => {
            modal.style.display = 'none';
            modalBackdrop.style.display = 'none';
            ibanInput.value = '';
        };
    });
});
</script>
@endsection
