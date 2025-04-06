<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            color: #3490dc;
            margin: 0;
            font-size: 28px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a5568;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #3490dc;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 144, 220, 0.25);
        }
        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 12px 0;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2779bd;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .remember-me input {
            margin-right: 8px;
        }
        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Đăng nhập</h1>
        </div>

        @if($errors->any())
            <div class="alert">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            </div>

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit" class="btn">
                Đăng nhập
            </button>

            @if (Route::has('password.request'))
                <div style="text-align: center; margin-top: 15px;">
                    <a href="{{ route('password.request') }}" style="color: #3490dc; text-decoration: none;">
                        Quên mật khẩu?
                    </a>
                </div>
            @endif
        </form>
    </div>
</body>
</html>