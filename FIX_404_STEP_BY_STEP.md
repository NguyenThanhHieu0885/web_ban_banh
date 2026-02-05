# ✅ HƯỚNG DẪN FIX LỖI 404 - Step by Step

## 🎯 Mục tiêu
Web đang live nhưng có lỗi migration. Chúng ta cần reset database và deploy lại.

## 📋 Checklist

### Bước 1: Reset Database Neon (5 phút)

#### Option A: Reset qua SQL Editor (Nhanh nhất - Khuyến nghị)

1. ✅ Vào https://console.neon.tech
2. ✅ Chọn project của bạn
3. ✅ Click vào **SQL Editor** (icon ở menu bên trái)
4. ✅ Copy và paste đoạn SQL sau:

```sql
-- Drop tất cả tables theo đúng thứ tự (tránh foreign key error)
DROP TABLE IF EXISTS chitietdonhang CASCADE;
DROP TABLE IF EXISTS donhang CASCADE;
DROP TABLE IF EXISTS sanpham CASCADE;
DROP TABLE IF EXISTS danhmuc CASCADE;
DROP TABLE IF EXISTS khuyenmai CASCADE;
DROP TABLE IF EXISTS personal_access_tokens CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS migrations CASCADE;
DROP TABLE IF EXISTS cache CASCADE;
DROP TABLE IF EXISTS cache_locks CASCADE;
DROP TABLE IF EXISTS sessions CASCADE;
```

5. ✅ Click **Run** hoặc nhấn `Ctrl + Enter`
6. ✅ Kiểm tra kết quả - phải thấy "DROP TABLE" cho tất cả tables

#### Option B: Reset Branch (Lâu hơn)

1. Vào https://console.neon.tech
2. Chọn project → **Branches**
3. Delete branch `main`
4. Create branch `main` mới
5. **⚠️ Lưu ý**: Thông tin kết nối có thể thay đổi, cập nhật lại trên Render

---

### Bước 2: Push Code Mới (2 phút)

Code đã được sửa để tránh lỗi migration. Push lên GitHub:

```bash
# Di chuyển vào thư mục project
cd d:\NguyenThanhHieu\MonHoc_HK_8\Web\srcUpHost\backend\backend

# Check git status
git status

# Add tất cả thay đổi
git add .

# Commit với message rõ ràng
git commit -m "Fix migration errors - Add hasTable checks and foreign key constraints"

# Push lên GitHub
git push origin main
```

---

### Bước 3: Redeploy trên Render (Auto)

Sau khi push, Render sẽ **tự động deploy** lại.

**Hoặc deploy thủ công:**

1. Vào https://dashboard.render.com
2. Chọn service **web-ban-banh**
3. Click **Manual Deploy** → **Deploy latest commit**

---

### Bước 4: Theo dõi Logs (5 phút)

1. Trên Render Dashboard, click vào tab **Logs**
2. Theo dõi quá trình deploy
3. **Tìm dòng này:**

```
==> Running migrations.
✓ 2025_11_07_085427_create_nguoidung_table
✓ 2025_11_16_145412_create_personal_access_tokens_table
✓ 2025_11_21_143847_create_donhang_table
✓ 2025_11_21_144423_create_khuyenmai_table
✓ 2025_11_21_145410_create_danhmuc_table
✓ 2025_11_21_145636_create_sanpham_table
✓ 2025_11_21_150236_create_chitietdonhang_table

==> Your service is live 🎉
```

4. **Nếu thấy như trên = THÀNH CÔNG!** ✅

---

### Bước 5: Test Web (2 phút)

Test các URL sau:

#### ✅ Frontend Routes
- [ ] https://web-ban-banh.onrender.com/
- [ ] https://web-ban-banh.onrender.com/product
- [ ] https://web-ban-banh.onrender.com/register

#### ✅ API Routes
- [ ] https://web-ban-banh.onrender.com/api/product
- [ ] https://web-ban-banh.onrender.com/api/category

**Cách test API:**
```bash
# Test API product
curl https://web-ban-banh.onrender.com/api/product

# Hoặc mở trực tiếp trên browser
```

**Kết quả mong đợi:**
- Frontend routes: Hiển thị trang web (không 404)
- API routes: Trả về JSON (có thể là array rỗng `[]` nếu chưa có dữ liệu)

---

## 🔧 Các thay đổi code đã thực hiện

### 1. Tất cả Migration Files
- ✅ Thêm check `if (!Schema::hasTable(...))` để tránh tạo lại table
- ✅ Fix foreign key constraints: chỉ rõ column name

### 2. Migration Users
- ✅ Fix reference từ `nguoidung` → `users`
- ✅ Tách unique constraint ra để tránh transaction error

### 3. Migration DonHang
- ✅ Fix foreign key: `constrained('nguoidung')` → `constrained('users', 'id')`

### 4. Dockerfile
- ✅ Thêm `config:clear` và `cache:clear`
- ✅ Bỏ `|| true` để bắt buộc migration phải thành công

---

## ⚠️ Nếu vẫn lỗi

### Lỗi: "SQLSTATE[25P02]"
→ Database chưa được reset. Quay lại Bước 1.

### Lỗi: "Foreign key violation"
→ Drop tables theo đúng thứ tự trong SQL ở Bước 1.

### Lỗi: "APP_KEY missing"
```bash
# Local: Generate APP_KEY
php artisan key:generate --show

# Copy output và paste vào Render Environment Variables
```

### 404 trên routes frontend
→ Code đã fix. Clear browser cache và thử lại.

---

## 🎉 Kết quả cuối cùng

Sau khi hoàn thành tất cả bước:

✅ Database tables được tạo thành công  
✅ Web hiển thị đúng tại https://web-ban-banh.onrender.com  
✅ Tất cả routes frontend hoạt động (/product, /register, ...)  
✅ API endpoints hoạt động (/api/product, /api/category, ...)  
✅ Không còn lỗi 404 hay migration errors  

---

**Tổng thời gian:** ~15 phút

**Bắt đầu từ Bước 1!** 🚀
