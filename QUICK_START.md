# 🚀 QUICK START - Deploy trong 5 phút

## 1️⃣ Tạo Database Neon (2 phút)
1. Vào [https://neon.tech](https://neon.tech)
2. Tạo project mới
3. Copy thông tin kết nối:
   - Host: `ep-xxx.neon.tech`
   - Database: `neondb`
   - Username: `neondb_owner`
   - Password: `xxxxxx`

## 2️⃣ Push code lên GitHub (1 phút)
```bash
git add .
git commit -m "Deploy to Render"
git push origin main
```

## 3️⃣ Deploy Render (2 phút)
1. Vào [https://render.com](https://render.com)
2. **New +** → **Web Service**
3. Chọn repo GitHub
4. Cấu hình:
   - **Runtime**: Docker
   - **Branch**: main

5. **Add Environment Variables**:
```
APP_NAME=MyWebsite
APP_ENV=production
APP_KEY=base64:CHAY_LENH_php_artisan_key:generate_--show_O_LOCAL
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=ep-xxx.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=your-password

SESSION_DRIVER=database
CACHE_STORE=database
LOG_LEVEL=error
```

6. **Create Web Service**

## ✅ Done!

Web sẽ live sau 5-10 phút tại: `https://your-app.onrender.com`

---

## 📝 Lấy APP_KEY

Chạy ở local:
```bash
php artisan key:generate --show
```

Copy toàn bộ kết quả (bao gồm `base64:`) paste vào `APP_KEY`

---

## 🧪 Test

- Trang chủ: https://your-app.onrender.com/
- Sản phẩm: https://your-app.onrender.com/product
- API: https://your-app.onrender.com/api/product

---

## ⚠️ Nếu lỗi

**500 Error** → Kiểm tra APP_KEY

**Database Error** → Kiểm tra thông tin Neon

**404 trên /product** → Đã fix trong code, redeploy

---

**Chi tiết đầy đủ:** Xem file `DEPLOY_RENDER.md`
