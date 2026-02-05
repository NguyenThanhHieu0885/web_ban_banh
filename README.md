# Web Bán Hàng - Laravel + React/Vue

Dự án web bán hàng với Laravel backend và React/Vue frontend.

## 🚀 Deploy lên Render

Xem hướng dẫn chi tiết tại: [DEPLOY_RENDER.md](DEPLOY_RENDER.md)

## 📋 Tính năng

- ✅ Quản lý sản phẩm
- ✅ Quản lý danh mục
- ✅ Quản lý đơn hàng
- ✅ Đăng ký/Đăng nhập người dùng
- ✅ Authentication với Laravel Sanctum
- ✅ SPA Routing (React Router / Vue Router)

## 🛠️ Tech Stack

- **Backend**: Laravel 11
- **Database**: PostgreSQL (Neon)
- **Frontend**: React/Vue (built in public/)
- **Authentication**: Laravel Sanctum
- **Deploy**: Render + Neon

## 📦 Cài đặt Local

```bash
# Clone project
git clone <your-repo-url>
cd backend

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Run server
php artisan serve
```

## 🌐 API Endpoints

### Authentication
- `POST /api/register` - Đăng ký
- `POST /api/login` - Đăng nhập
- `POST /api/logout` - Đăng xuất

### Products
- `GET /api/product` - Lấy tất cả sản phẩm
- `GET /api/product/{id}` - Lấy sản phẩm theo ID
- `POST /api/product` - Thêm sản phẩm (Admin)
- `POST /api/product/{id}` - Cập nhật sản phẩm (Admin)
- `DELETE /api/product/{id}` - Xóa sản phẩm (Admin)

### Categories
- `GET /api/category` - Lấy tất cả danh mục
- `GET /api/category/{id}` - Lấy danh mục theo ID
- `POST /api/category/add` - Thêm danh mục (Admin)

### Orders
- `POST /api/order` - Tạo đơn hàng
- `GET /api/order` - Lấy tất cả đơn hàng (Admin)

## 📝 License

MIT

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
