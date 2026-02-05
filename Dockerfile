# 1. Dùng PHP 8.2 làm nền tảng
# Build timestamp: 2026-02-05 11:00 - Force cache clear
FROM php:8.2-cli

# 2. Cài đặt các thư viện cần thiết cho Linux (Zip, Git, Postgres...)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# 3. Cài đặt các Extension PHP cần thiết cho Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# 4. Cài đặt Composer (Công cụ quản lý thư viện PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Thiết lập thư mục làm việc
WORKDIR /var/www

# 6. Copy toàn bộ code vào trong Docker
COPY . .

# 7. Chạy lệnh cài đặt thư viện PHP
RUN composer install --no-dev --optimize-autoloader --no-cache

# 7.1 Clear all caches
RUN rm -rf bootstrap/cache/*.php
RUN composer dump-autoload

# 8. Chạy lệnh build Frontend (React/Vue) - Nếu có
# Nếu frontend đã build sẵn trong public/, bỏ qua bước này
# RUN npm install && npm run build

# 8.1. Set quyền cho storage và bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# 9. Mở cổng 8080 (Cổng mặc định của Render)
EXPOSE 8080

# 10. Lệnh chạy server khi web khởi động
# Migrate database trước, sau đó mới clear cache (vì cache cần table)
CMD sh -c "php artisan migrate --force && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8080"