# Dự án Laravel với Docker

Đây là hướng dẫn cài đặt và chạy một dự án Laravel sử dụng Docker với Nginx, PHP-FPM, MySQL và phpMyAdmin.

## ⚙️ Cấu hình file `.env`

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=  # Tạo bằng lệnh `php artisan key:generate`
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password

SESSION_DRIVER=database
```

## Chạy Docker
docker-compose up -d

## Tạo bảng sessions (nếu dùng session database)

docker exec -it laravel_app bash
php artisan session:table
php artisan migrate
exit


Truy cập
Ứng dụng Laravel: http://localhost (hoặc http://localhost:8000 nếu đổi cổng)
phpMyAdmin: http://localhost:8080
User: laravel_user
Password: laravel_password