<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            padding: 15px 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #3490dc;
            text-decoration: none;
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-link {
            color: #4a5568;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }
        .logout-btn {
            background-color: #e53e3e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c53030;
        }
        .main-content {
            padding: 40px 0;
        }
        .welcome-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .welcome-card h1 {
            color: #2d3748;
            margin-top: 0;
        }
        .welcome-card p {
            color: #4a5568;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="{{ url('/') }}" class="logo">
                    Laravel App
                </a>
                <div class="nav-links">
                    @auth
                        <span class="nav-link">Xin chào, {{ Auth::user()->name }}</span>
                        
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Đăng nhập</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Đăng ký</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="main-content">
            <div class="welcome-card">
                <h1>Chào mừng bạn đến với trang chủ</h1>
                <p>Bạn đã đăng nhập thành công vào ứng dụng Laravel.</p>
            </div>
            
            @auth
                <div class="welcome-card">
                    <h2>Thông tin tài khoản</h2>
                    <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Ngày tham gia:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                </div>
            @endauth
        </div>
    </div>
</body>
</html>