@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Araçlarım</h2>
    <div class="row">
        @foreach ($vehicles as $vehicle)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $vehicle->resim) }}" class="card-img-top" alt="{{ $vehicle->marka }} {{ $vehicle->model }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->marka }} {{ $vehicle->model }}</h5>
                        <p class="card-text">
                            Vites: {{ $vehicle->vites }} <br>
                            Yakıt: {{ $vehicle->yakit }} <br>
                            Koltuk: {{ $vehicle->koltuk }} <br>
                            Fiyat: {{ number_format($vehicle->fiyat, 2) }} TL/gün
                        </p>
                        <a href="{{ route('user.rent.create', $vehicle->id) }}" class="btn btn-success">Kirala</a>
                        <a href="{{ route('user.vehicle.show', $vehicle->id) }}" class="btn btn-primary">Detayları Gör</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@endsection
<!-- Kiralama Modal -->
<div class="modal fade" id="kiralaModal" tabindex="-1" aria-labelledby="kiralaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="" method="POST" id="kiralaForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kiralaModalLabel">Araç Kirala</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
        </div>
        <div class="modal-body">
          <p id="aracAdi"></p>
          <div class="mb-3">
            <label for="start_date" class="form-label">Başlangıç Tarihi</label>
            <input type="date" id="start_date" name="start_date" class="form-control" required min="{{ date('Y-m-d') }}">
          </div>
          <div class="mb-3">
            <label for="end_date" class="form-label">Bitiş Tarihi</label>
            <input type="date" id="end_date" name="end_date" class="form-control" required min="{{ date('Y-m-d') }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Kirala</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var kiralaModal = document.getElementById('kiralaModal');
  kiralaModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var vehicleId = button.getAttribute('data-vehicle-id');
    var vehicleName = button.getAttribute('data-vehicle-name');
    
    // Modal başlığını ve form action URL'sini ayarla
    var modalTitle = kiralaModal.querySelector('.modal-title');
    var aracAdiP = kiralaModal.querySelector('#aracAdi');
    var form = kiralaModal.querySelector('#kiralaForm');
    
    modalTitle.textContent = vehicleName + " Kirala";
    aracAdiP.textContent = "Araç: " + vehicleName;
    
    // Kiralama formunun action url'si: /vehicles/{id}/rent (örnek)
    form.action = '/vehicles/' + vehicleId + '/rent';
  });
});
</script>


