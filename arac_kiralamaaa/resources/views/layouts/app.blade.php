<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arac Kiralama</title>
    <!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- İstersen Tailwind veya Bootstrap ekle -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="bg-light">

   <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <!-- Logo ve başlık -->
        <a class="navbar-brand d-flex align-items-center" href="/user/home">
            <i class="fas fa-car-side fa-lg text-warning me-2"></i>
            <span class="fw-bold fs-4 text-warning"> KolayKirala</span>
        </a>

        <!-- Mobil menü butonu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menü linkleri -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav" >
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link active" href="/user/home">
                        <i class="fas fa-home me-1"></i> Anasayfa
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/araclarim">
                        <i class="fas fa-car me-1"></i> Araçlar
                    </a>
                </li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('rentals.index') }}">
    <i class="fas fa-file-contract me-1"></i> Kiralama İşlemlerim
</a>
</li>
                                <li class="nav-item"><a class="nav-link" href="/profil"><i class="fas fa-user me-1"></i>Profil</a></li>


              
                <li class="nav-item mx-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt me-1"></i> Çıkış
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
</nav>
<style>
    .navbar .nav-link {
        color: #fff;
        transition: color 0.2s ease;
    }

    .navbar .nav-link:hover {
        color: #ffc107;
    }

    .navbar-brand span {
        letter-spacing: 1px;
    }
   
  body {
    padding-top: 70px;
  }
</style>




    <!-- Ana içerik -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer (opsiyonel) -->
    <footer class="text-center py-4 mt-5">
      © {{ date('Y') }} Arac Kiralama
    </footer>

    <!-- JS (opsiyonel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
       @yield('scripts')
</body>
</html>
