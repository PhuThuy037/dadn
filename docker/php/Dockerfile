# Dùng image Nginx làm base
FROM nginx:latest

# Cài đặt PHP-FPM và các extension cần thiết
RUN apt-get update && apt-get install -y \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-gd \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-zip \
    unzip \
    && apt-get clean

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy cấu hình Nginx
COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy mã nguồn Laravel (sẽ được ánh xạ qua volume)
COPY ./src /var/www/html

# Quyền thư mục
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Khởi động cả Nginx và PHP-FPM
CMD service php8.2-fpm start && nginx -g "daemon off;"