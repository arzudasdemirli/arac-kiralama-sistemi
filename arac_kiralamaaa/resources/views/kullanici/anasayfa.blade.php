@extends('layouts.app')

@section('content')
 
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        @foreach([
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYI-4JbwtrJZWYU2XogkjcCZ06zLPiQhmLWQ&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMU6fxsCqKUz0mR7oJzd_IaqkQkC1QA8k5kw&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRk3w5wJNiZ3ih7jgNPbRKO_Sl3tUrYFF-RjA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFsa9gUlw_Xvfh66_VHA30Zi2FZ1dFBmF5fw&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbsp1o1zkeoYbqAqk1uOSCm8Q3DJKKDgXD3g&s'
        ] as $index => $url)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="hero-slide d-flex align-items-center justify-content-center" style="background-image: url('{{ $url }}');">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bold">Hayalindeki Aracı Bugün Kirala</h1>
                    <p class="lead">Lüks, konfor ve uygun fiyat bir arada!</p>
                    <a href="/araclar" class="btn btn-warning btn-lg">Araçları Görüntüle</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>




     

<!-- POPÜLER ARAÇLAR -->

<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">🚘 Popüler Araçlar</h2>
    <div id="populerAraclar" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      
      
        <div class="carousel-inner">
            @foreach(array_chunk([
                ['model' => 'BMW 3 Serisi', 'img' => 'https://source.unsplash.com/400x250/?bmw-car'],
                ['model' => 'Audi A4', 'img' => 'https://source.unsplash.com/400x250/?audi-car'],
                ['model' => 'Mercedes C', 'img' => 'https://source.unsplash.com/400x250/?mercedes-car'],
                ['model' => 'Volkswagen Golf', 'img' => 'https://source.unsplash.com/400x250/?golf-car'],
                ['model' => 'Toyota Corolla', 'img' => 'https://source.unsplash.com/400x250/?toyota-car'],
                ['model' => 'Renault Megane', 'img' => 'https://source.unsplash.com/400x250/?renault-car'],
                ['model' => 'Peugeot 3008', 'img' => 'https://source.unsplash.com/400x250/?peugeot-car'],
                ['model' => 'Hyundai Tucson', 'img' => 'https://source.unsplash.com/400x250/?tucson-car'],
                ['model' => 'Ford Focus', 'img' => 'https://source.unsplash.com/400x250/?ford-car']
            ], 3) as $index => $chunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach($chunk as $car)
                            <div class="col-md-4">
                                <div class="card arac-card mb-3 shadow-sm">
                                    
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $car['model'] }}</h5>
                                        <p class="card-text">Konforlu sürüş, yüksek performans ve güvenilirlik.</p>
                                        <a href="/araclar" class="btn btn-outline-primary">Detayları Görüntüle</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- KİRALAMA SÜRECİ -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">📋 Araç Kiralama Süreci</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fas fa-car fa-3x text-warning mb-3"></i>
                <h5>1. Araç Seç</h5>
                <p>Sana uygun aracı listemizden seç.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                <h5>2. Tarih Belirle</h5>
                <p>Kiralama tarihlerini seç ve rezervasyon yap.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-key fa-3x text-danger mb-3"></i>
                <h5>3. Teslim Al</h5>
                <p>Seçtiğin aracı belirttiğin noktadan teslim al.</p>
            </div>
        </div>
    </div>

</section>

<!-- STİLLER -->
<style>
    .hero-slide {
        height: 100vh;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .hero-slide .text-center {
        z-index: 2;
        position: relative;
    }

    .arac-card {
        transition: transform 0.3s ease;
    }

    .arac-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- SLIDER STİLİ -->
<style>
.hero-slide {
    height: 100vh;
    background-size: cover;
    background-position: center;
    position: relative;
}

.hero-slide::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0, 0, 0, 0.6); /* Arka planı karart */
    z-index: 1;
}

.hero-slide .text-center {
    z-index: 2;
    position: relative;
}

@media (max-width: 768px) {
    .hero-slide h1 {
        font-size: 2rem;
    }

    .hero-slide p {
        font-size: 1rem;
    }
}
</style>

          <!-- Bize Ulaşın -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
    </div>
@endif

<section id="contact" class="contact-section text-white py-5" style="background: linear-gradient(to right, #212529, #343a40);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-warning">Bize Ulaşın</h2>
      <p class="text-light">Aklınıza takılan tüm sorular için bizimle iletişime geçebilirsiniz.</p>
    </div>

    <div class="row g-4">
      <!-- İletişim Kartları -->
      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 shadow-lg border-0">
          <div class="card-body text-center">
            <i class="bi bi-geo-alt-fill display-5 text-warning"></i>
            <h5 class="card-title mt-3">Adresimiz</h5>
            <p class="card-text">İstanbul, Türkiye</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 shadow-lg border-0">
          <div class="card-body text-center">
            <i class="bi bi-envelope-fill display-5 text-warning"></i>
            <h5 class="card-title mt-3">E-posta</h5>
            <p class="card-text">destek@arackiralama.com</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card bg-dark text-white h-100 shadow-lg border-0">
          <div class="card-body text-center">
            <i class="bi bi-telephone-fill display-5 text-warning"></i>
            <h5 class="card-title mt-3">Telefon</h5>
            <p class="card-text">+90 555 123 4567</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Mesaj Formu -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg border-0">
          <div class="card-body p-4">
           <form method="POST" action="{{ route('contact.send.user') }}">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Adınız</label>
                  <input type="text" class="form-control" name="ad_soyad" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">E-posta</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Mesajınız</label>
                  <textarea class="form-control" name="mesaj" rows="5" required></textarea>
                </div>
              </div>
              <div class="text-end mt-3">
                <button type="submit" class="btn btn-warning btn-lg">Gönder</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</section>
<style>
.contact-section {
  background: linear-gradient(to right, #f8f9fa, #eaeaea);
}

.contact-section h2 {
  color: #343a40;
}

.contact-section .form-control:focus {
  border-color: #ffc107;
  box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}
</style>




@endsection
