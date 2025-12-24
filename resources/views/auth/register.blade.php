<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jasa Cuci Mobil & Motor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .register-container { background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); padding: 2rem; width: 100%; max-width: 400px; }
        .logo { text-align: center; font-size: 2rem; margin-bottom: 1rem; }
        .title { text-align: center; color: #1f2937; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 500; }
        .form-group input { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; }
        .form-group input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .btn { width: 100%; padding: 0.75rem; background: #667eea; color: white; border: none; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #5568d3; }
        .alert { padding: 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
        .text-center { text-align: center; }
        .text-center a { color: #667eea; text-decoration: none; }
        .text-center a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">🚗</div>
        <h1 class="title">Daftar Akun</h1>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <p class="text-center" style="margin-top: 1rem;">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
</body>
</html>
