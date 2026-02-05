# 🗑️ SQL RESET DATABASE NEON

## Copy và chạy trên Neon SQL Editor

Vào: https://console.neon.tech → Project → SQL Editor

**Paste và Run:**

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

## ✅ Sau khi chạy xong:

1. Kiểm tra kết quả - Phải thấy "DROP TABLE" cho tất cả
2. Redeploy trên Render
3. Done!

---

## 🔍 Kiểm tra database đã sạch chưa:

```sql
SELECT tablename FROM pg_tables WHERE schemaname = 'public';
```

**Kết quả mong đợi:** 0 rows (không có table nào)

---

**Sau khi DROP → Quay lại file `FIX_NOW.md`**
