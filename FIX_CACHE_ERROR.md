# ⚡ FIX NGAY - Lỗi Cache Table

## Lỗi gặp phải:
```
SQLSTATE[42P01]: Undefined table: 7 ERROR: relation "cache" does not exist
```

## ✅ Đã sửa:

1. **Tạo migration cache table** - Mới tạo
2. **Tạo migration sessions table** - Mới tạo  
3. **Sửa Dockerfile** - Bỏ `cache:clear` trước migrate

## 🚀 Làm ngay (3 phút):

### 1. Reset database Neon

Vào https://console.neon.tech → SQL Editor, chạy:

```sql
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

### 2. Push code

```bash
git add .
git commit -m "Add cache and sessions migrations"
git push origin main
```

### 3. Đợi Render deploy

Lần này sẽ thấy:

```
✓ 2025_11_07_085427_create_nguoidung_table
✓ 2025_11_16_145412_create_personal_access_tokens_table
✓ 2025_11_21_143847_create_donhang_table
✓ 2025_11_21_144423_create_khuyenmai_table
✓ 2025_11_21_145410_create_danhmuc_table
✓ 2025_11_21_145636_create_sanpham_table
✓ 2025_11_21_150236_create_chitietdonhang_table
✓ 2026_02_05_034553_create_cache_table  ← MỚI
✓ 2026_02_05_034617_create_sessions_table  ← MỚI

==> Your service is live 🎉
```

## 🎯 Done!

Web sẽ live hoàn toàn tại: https://web-ban-banh.onrender.com

---

**Tổng thời gian: 3 phút** ⚡
