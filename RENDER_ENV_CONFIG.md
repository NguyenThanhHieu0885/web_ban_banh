# 🔧 Cấu hình Environment Variables trên Render

## 📋 Hướng dẫn chi tiết

### Bước 1: Truy cập Render Dashboard

1. Đăng nhập https://dashboard.render.com
2. Chọn service **web-ban-banh** (hoặc tên service của bạn)
3. Click tab **Environment**
4. Click **Add Environment Variable**

---

### Bước 2: Thêm từng biến môi trường

Copy từng dòng dưới đây và paste vào Render:

#### 🔑 Application Settings

```
APP_NAME=WebBanBanh
```
```
APP_ENV=production
```
```
APP_KEY=base64:Myo0SC2fvKTrJ/gV5rjw5MS1cEiPPuqgnlm9FXu0e18=
```
```
APP_DEBUG=false
```
```
APP_URL=https://web-ban-banh.onrender.com
```

**⚠️ Lưu ý:** Thay `https://web-ban-banh.onrender.com` bằng URL thực tế của bạn trên Render.

---

#### 🗄️ Database Settings (Neon)

**Thông tin từ Neon của bạn:**

```
DB_CONNECTION=pgsql
```
```
DB_HOST=ep-shiny-cake-ai1e4piu-pooler.c-4.us-east-1.aws.neon.tech
```
```
DB_PORT=5432
```
```
DB_DATABASE=neondb
```
```
DB_USERNAME=neondb_owner
```
```
DB_PASSWORD=npg_Kp6tBgEZq4sW
```
```
DB_SSLMODE=require
```

---

#### 💾 Cache & Session Settings

```
SESSION_DRIVER=database
```
```
SESSION_LIFETIME=120
```
```
CACHE_STORE=database
```
```
QUEUE_CONNECTION=database
```

---

#### 📝 Logging Settings

```
LOG_CHANNEL=stack
```
```
LOG_LEVEL=error
```

---

### Bước 3: Save và Deploy

1. Sau khi thêm tất cả biến, click **Save Changes**
2. Render sẽ tự động redeploy
3. Đợi 5-10 phút để deploy hoàn tất

---

## 📝 Cách thêm từng biến

### Phương pháp 1: Thêm từng biến (Khuyến nghị)

1. Click **Add Environment Variable**
2. **Key**: Nhập tên biến (VD: `APP_NAME`)
3. **Value**: Nhập giá trị (VD: `WebBanBanh`)
4. Click **Add**
5. Lặp lại cho tất cả biến

### Phương pháp 2: Bulk Add (Nhanh hơn)

1. Click **Add from .env**
2. Paste toàn bộ nội dung dưới đây:

```env
APP_NAME=WebBanBanh
APP_ENV=production
APP_KEY=base64:Myo0SC2fvKTrJ/gV5rjw5MS1cEiPPuqgnlm9FXu0e18=
APP_DEBUG=false
APP_URL=https://web-ban-banh.onrender.com

DB_CONNECTION=pgsql
DB_HOST=ep-shiny-cake-ai1e4piu-pooler.c-4.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_Kp6tBgEZq4sW
DB_SSLMODE=require

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

3. Click **Add Variables**

---

## ✅ Kiểm tra cấu hình

Sau khi deploy xong, kiểm tra logs:

1. Vào tab **Logs** trên Render
2. Tìm dòng:
   ```
   ✓ 2025_11_07_085427_create_nguoidung_table
   ✓ 2026_02_05_034553_create_cache_table
   ✓ 2026_02_05_034617_create_sessions_table
   ==> Your service is live 🎉
   ```

3. **Nếu thấy dòng này = THÀNH CÔNG!**

---

## 🧪 Test kết nối Database

Sau khi deploy, test API:

```bash
# Test API product
curl https://web-ban-banh.onrender.com/api/product

# Hoặc mở trong browser:
https://web-ban-banh.onrender.com/api/product
```

**Kết quả mong đợi:**
- ✅ Trả về `[]` (array rỗng nếu chưa có dữ liệu)
- ✅ Hoặc trả về danh sách sản phẩm nếu đã có data
- ❌ Nếu lỗi database → Kiểm tra lại thông tin Neon

---

## 🔐 Bảo mật

### ⚠️ QUAN TRỌNG:

1. **Không** commit file `.env` lên Git
2. **Không** chia sẻ `APP_KEY` và `DB_PASSWORD` công khai
3. File `.gitignore` đã có `.env` → An toàn

### Nếu cần thay đổi APP_KEY:

```bash
# Chạy local để tạo key mới
php artisan key:generate --show

# Copy output và update trên Render
```

---

## 🆘 Troubleshooting

### Lỗi: "No application encryption key"
→ Kiểm tra `APP_KEY` đã có `base64:` ở đầu chưa

### Lỗi: "SQLSTATE[08006]" (Connection refused)
→ Kiểm tra lại:
- `DB_HOST` đúng hostname Neon
- `DB_PASSWORD` không có khoảng trắng thừa
- `DB_SSLMODE=require` đã thêm chưa

### Lỗi: "Table does not exist"
→ Reset database Neon theo file `FIX_CACHE_ERROR.md`

### Web hiển thị trắng
→ Set `APP_DEBUG=true` tạm thời để xem lỗi, sau đó đổi lại `false`

---

## 📸 Screenshot hướng dẫn

### Vị trí Environment tab:
```
Render Dashboard
  └── Your Service (web-ban-banh)
       └── Environment (tab)
            └── Add Environment Variable (button)
```

### Format mỗi biến:
```
Key:   APP_NAME
Value: WebBanBanh
```

---

## 🎯 Checklist hoàn thành

- [ ] Đã thêm tất cả biến Application Settings (5 biến)
- [ ] Đã thêm tất cả biến Database Settings (7 biến)
- [ ] Đã thêm tất cả biến Cache/Session Settings (4 biến)
- [ ] Đã thêm tất cả biến Logging Settings (2 biến)
- [ ] Đã click **Save Changes**
- [ ] Đã đợi deploy xong
- [ ] Đã test web: https://web-ban-banh.onrender.com
- [ ] Đã test API: https://web-ban-banh.onrender.com/api/product

**Tổng: 18 biến môi trường**

---

## 🚀 Sau khi cấu hình xong

1. **Đợi deploy tự động** (5-10 phút)
2. **Kiểm tra logs** - Phải thấy "Your service is live 🎉"
3. **Test web** - Truy cập URL
4. **Test API** - Gọi endpoint /api/product

**Done! Web đã sẵn sàng!** 🎉

---

## 📞 Liên hệ Support

Nếu gặp vấn đề:
1. Xem logs trên Render
2. Kiểm tra file `FIX_CACHE_ERROR.md`
3. Kiểm tra file `FIX_404_STEP_BY_STEP.md`
