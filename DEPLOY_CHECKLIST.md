# ✅ Checklist Deploy Render

## Trước khi Deploy

- [ ] Đã build frontend: `npm run build`
- [ ] File `public/index.html` tồn tại
- [ ] File `public/assets/` có các file JS và CSS
- [ ] Đã tạo database trên Neon
- [ ] Đã có thông tin kết nối Neon (host, database, username, password)

## Cấu hình Code

- [✅] `routes/web.php` - Đã thêm fallback route cho SPA
- [✅] `config/cors.php` - Đã cho phép tất cả origins
- [✅] `.env.example` - Đã cấu hình PostgreSQL
- [✅] `Dockerfile` - Đã cấu hình đúng
- [ ] `.env` local - Kiểm tra có chạy được không

## Push lên GitHub

```bash
git add .
git commit -m "Ready for Render deploy"
git push origin main
```

## Trên Render.com

### 1. Tạo Web Service
- [ ] Đã tạo Web Service
- [ ] Đã chọn GitHub repository
- [ ] Runtime: Docker
- [ ] Branch: main

### 2. Environment Variables (Quan trọng!)

Copy và paste vào Render Environment:

```
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=CHAY_LENH_php_artisan_key:generate_--show
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=ep-xxx-xxx.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=your-password-here

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

**Thay thế:**
- `APP_KEY`: Chạy `php artisan key:generate --show` ở local
- `APP_URL`: URL Render của bạn
- `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: Từ Neon

### 3. Deploy
- [ ] Click "Create Web Service"
- [ ] Đợi build xong (5-10 phút)
- [ ] Kiểm tra logs không có lỗi

## Sau khi Deploy

### Test các route:
- [ ] Trang chủ: `https://your-app.onrender.com/`
- [ ] Trang sản phẩm: `https://your-app.onrender.com/product`
- [ ] Trang đăng ký: `https://your-app.onrender.com/register`
- [ ] API sản phẩm: `https://your-app.onrender.com/api/product`
- [ ] API danh mục: `https://your-app.onrender.com/api/category`

### Nếu có lỗi:

**500 Internal Server Error**
→ Kiểm tra APP_KEY trong Environment Variables

**Database connection error**
→ Kiểm tra thông tin Neon (host, database, username, password)

**404 trên route /product, /register**
→ Code đã sửa, redeploy lại

**CORS Error khi gọi API**
→ Code đã sửa, redeploy lại

**Page trắng/không load**
→ Kiểm tra public/index.html và public/assets/ có đầy đủ không

## Lệnh hữu ích

### Lấy APP_KEY
```bash
php artisan key:generate --show
```

### Test database local
```bash
php artisan migrate
```

### Build frontend
```bash
npm run build
```

### Test local
```bash
php artisan serve
```

## Lưu ý quan trọng

⚠️ **Free tier Render**: 
- Web sẽ sleep sau 15 phút không hoạt động
- Lần đầu truy cập sau khi sleep sẽ mất 30-50 giây để wake up
- Đủ cho demo và project học tập

⚠️ **Database Neon**:
- Free tier có giới hạn 0.5GB storage
- 192 hours compute time/tháng
- Đủ cho project nhỏ

⚠️ **Frontend**:
- Phải build trước khi push
- Không được thêm `public/` vào .gitignore
- File index.html và assets/ phải có trong Git

## Done! 🎉

Nếu tất cả đều OK, web của bạn đã live tại: `https://your-app.onrender.com`
