# 🔧 Fix Lỗi Migration 404

## ⚠️ Vấn đề

Lỗi khi deploy:
```
SQLSTATE[25P02]: In failed sql transaction: 7 ERROR: current transaction is aborted
```

**Nguyên nhân:** Database Neon đã có dữ liệu cũ từ lần deploy trước, migration bị conflict.

## ✅ Giải pháp nhanh - Reset Database Neon

### Cách 1: Reset từ Neon Dashboard (Khuyến nghị)

1. Vào [Neon Dashboard](https://console.neon.tech)
2. Chọn project của bạn
3. Vào tab **Branches**
4. Click vào branch `main`
5. Xóa branch `main` cũ
6. Tạo branch `main` mới
7. Copy thông tin kết nối mới (host, password có thể thay đổi)
8. Cập nhật Environment Variables trên Render
9. Redeploy trên Render

### Cách 2: Drop Tables qua SQL Editor

1. Vào [Neon Dashboard](https://console.neon.tech)
2. Chọn project → **SQL Editor**
3. Chạy các lệnh sau:

```sql
-- Drop tất cả tables
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

-- Reset xong!
```

4. Redeploy trên Render (migrations sẽ chạy lại từ đầu)

### Cách 3: Sử dụng Migration Fresh (Local test)

**⚠️ Chỉ dùng để test local, không dùng production:**

```bash
php artisan migrate:fresh
```

## 🔄 Sau khi reset

1. **Redeploy trên Render:**
   - Vào Render Dashboard
   - Chọn service của bạn
   - Click **Manual Deploy** → **Deploy latest commit**

2. **Kiểm tra logs:**
   - Xem logs để đảm bảo migration chạy thành công
   - Phải thấy: `✓ 2025_11_07_085427_create_nguoidung_table`

3. **Test web:**
   - Truy cập: `https://web-ban-banh.onrender.com`
   - Test API: `https://web-ban-banh.onrender.com/api/product`

## 📝 Code đã sửa

### 1. Migration file
- Thêm check `if (!Schema::hasTable('users'))` để tránh tạo lại table đã tồn tại
- Tách unique constraint ra để tránh lỗi transaction

### 2. Dockerfile
- Thêm `config:clear` và `cache:clear` trước khi migrate
- Bỏ `|| true` để bắt buộc migration phải thành công

## 🎯 Kết quả mong đợi

Sau khi reset database và redeploy:
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

## ⚡ Quick Commands

```bash
# Push code mới
git add .
git commit -m "Fix migration issues"
git push origin main

# Render sẽ tự động deploy lại
```

---

**Tóm tắt:** Reset database Neon → Redeploy Render → Done!
