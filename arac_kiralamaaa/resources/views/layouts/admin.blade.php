<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold text-warning" href="#">🚗 KolayKirala</a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('admin.vehicles.index') }}">
                    <i class="bi bi-car-front"></i> Araçlarım
                </a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('admin.messages.index') }}">
                    <i class="bi bi-chat-dots"></i> Mesajlar
                </a>
            </li>
            {{-- Kiralamalar kaldırıldığı için gerek yok --}}
              <li class="nav-item"><a class="nav-link" href="{{ route('admin.rentals.index') }}">Kiralamalar</a></li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Çıkış
                </a>
            </li>
        </ul>
    </div>
</nav>


<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
<style>
    .menu-item {
        transition: all 0.3s ease;
        color: #ffffff;
    }

    .menu-item:hover {
        color: #ffc107 !important; /* sarı renk */
        transform: translateY(-2px);
    }

    .menu-item i {
        margin-right: 5px;
    }
</style>

