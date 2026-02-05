# Hướng dẫn Deploy Web lên Render

## 1. Chuẩn bị Database trên Neon

1. Truy cập [Neon](https://neon.tech)
2. Tạo database PostgreSQL mới
3. Lưu lại thông tin kết nối:
   - Host
   - Database name
   - Username
   - Password
   - Port (thường là 5432)

## 2. Push code lên GitHub

```bash
git add .
git commit -m "Deploy to Render"
git push origin main
```

## 3. Cấu hình Render

### Bước 1: Tạo Web Service
1. Đăng nhập [Render](https://render.com)
2. Click **New +** → **Web Service**
3. Kết nối GitHub repository của bạn
4. Cấu hình:
   - **Name**: tên-web-của-bạn
   - **Region**: Singapore (gần VN nhất)
   - **Branch**: main
   - **Root Directory**: để trống
   - **Runtime**: Docker
   - **Plan**: Free

### Bước 2: Cấu hình Environment Variables

Vào tab **Environment** và thêm các biến sau:

```
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your-neon-host.neon.tech
DB_PORT=5432
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

**⚠️ Quan trọng:**
- `APP_KEY`: Chạy lệnh `php artisan key:generate --show` ở local để lấy key
- Thay thế tất cả thông tin database bằng thông tin từ Neon

### Bước 3: Deploy

1. Click **Create Web Service**
2. Đợi Render build và deploy (khoảng 5-10 phút)
3. Khi deploy xong, truy cập URL: `https://your-app.onrender.com`

## 4. Kiểm tra

### Test các route:
- ✅ Trang chủ: `https://your-app.onrender.com/`
- ✅ Sản phẩm: `https://your-app.onrender.com/product`
- ✅ Đăng ký: `https://your-app.onrender.com/register`
- ✅ API: `https://your-app.onrender.com/api/product`

### Nếu gặp lỗi:

1. **500 Error**: Kiểm tra APP_KEY đã đúng chưa
2. **Database connection failed**: Kiểm tra lại thông tin Neon
3. **404 trên route frontend**: Đã sửa trong code rồi, redeploy lại
4. **CORS Error**: Đã cho phép tất cả origins

## 5. Lấy APP_KEY

Chạy lệnh này ở local:

```bash
php artisan key:generate --show
```

Copy toàn bộ chuỗi (bao gồm `base64:`) và paste vào biến `APP_KEY` trên Render.

## 6. Cập nhật code

Khi có thay đổi code:

```bash
git add .
git commit -m "Update code"
git push origin main
```

Render sẽ tự động deploy lại.

## Troubleshooting

### Lỗi "No application encryption key"
→ Thêm APP_KEY vào Environment Variables

### Lỗi "SQLSTATE[08006]"
→ Kiểm tra lại thông tin database Neon

### Frontend không load
→ Chạy lại `npm run build` và push code

### API trả về 404
→ Đảm bảo gọi API với prefix `/api/`

Example: `fetch('https://your-app.onrender.com/api/product')`
