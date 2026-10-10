<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Giriş / Kayıt – Araç Kiralama</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-roboto">
  <div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">

      <!-- Login Form -->
      <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Giriş Yap</h2>

        @if($errors->has('login'))
          <div class="mb-4 text-red-600">{{ $errors->first('login') }}</div>
        @endif

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">E-posta</label>
          <input type="email" name="email" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">Şifre</label>
          <input type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

       
        <div class="flex items-center justify-between mb-6">
          <a href="#" class="text-sm text-blue-500" onclick="showForm('forgot')">Şifremi Unuttum?</a>
          <a href="#" class="text-sm text-blue-500" onclick="showForm('register')">Kayıt Ol</a>
        </div>

        <button type="submit"
          class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Giriş Yap</button>
      </form>

      <!-- Register Form -->
      <form id="register-form" method="POST" action="{{ route('register') }}" class="hidden">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Kayıt Ol</h2>

        @if($errors->any())
          <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
          </div>
        @endif

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">Ad Soyad</label>
          <input type="text" name="name" value="{{ old('name') }}" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">E-posta</label>
          <input type="email" name="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">Şifre</label>
          <input type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">Şifre Tekrar</label>
          <input type="password" name="password_confirmation" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">Kayıt Tipi</label>
          <select name="role" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="kullanici">Kullanıcı</option>
            <option value="yonetici">Yönetici</option>
          </select>
        </div>

        <div class="text-center mb-6">
          <a href="#" class="text-sm text-blue-500" onclick="showForm('login')">Giriş Yap</a>
        </div>

        <button type="submit"
          class="w-full py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Kayıt Ol</button>
      </form>

      <!-- Forgot Password Form -->
      <form id="forgot-form" method="POST" action="{{ route('password.email') }}" class="hidden">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Şifre Sıfırla</h2>

        @if(session('status'))
          <div class="mb-4 text-green-600">{{ session('status') }}</div>
        @endif

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-600">E-posta</label>
          <input type="email" name="email" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="text-center mb-6">
          <a href="#" class="text-sm text-blue-500" onclick="showForm('login')">Giriş Yap</a>
        </div>

        <button type="submit"
          class="w-full py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">E-posta Gönder</button>
      </form>

    </div>
  </div>

  <script>
    function showForm(form) {
      document.getElementById('login-form').classList.add('hidden');
      document.getElementById('register-form').classList.add('hidden');
      document.getElementById('forgot-form').classList.add('hidden');
      document.getElementById(form + '-form').classList.remove('hidden');
    }
  </script>
</body>
</html>
