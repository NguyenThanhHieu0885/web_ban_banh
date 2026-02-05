# 🚨 LỖI MIGRATION - GIẢI PHÁP NHANH

## ❌ Lỗi gặp phải:
```
SQLSTATE[25P02]: In failed sql transaction
ERROR: current transaction is aborted
```

## 🎯 Nguyên nhân:
**Database Neon CHƯA được reset!** Table cũ vẫn còn → Conflict khi migrate.

---

## ✅ GIẢI PHÁP - LÀM NGAY (3 phút)

### Bước 1: Reset Database Neon (QUAN TRỌNG!)

1. Vào https://console.neon.tech
2. Chọn project của bạn
3. Click **SQL Editor**
4. **Copy và RUN lệnh này:**

```sql
-- DROP TẤT CẢ TABLES
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

5. Nhấn **Run** hoặc `Ctrl + Enter`
6. **Phải thấy:** "DROP TABLE" cho tất cả tables

**⚠️ BẮT BUỘC phải làm bước này trước!**

---

### Bước 2: Redeploy trên Render

**Option A: Manual Deploy (Nhanh nhất)**

1. Vào https://dashboard.render.com
2. Chọn service **web-ban-banh**
3. Click **Manual Deploy** → **Deploy latest commit**
4. Đợi 5-10 phút

**Option B: Push code lại**

```bash
git commit --allow-empty -m "Trigger redeploy"
git push origin main
```

---

### Bước 3: Theo dõi Logs

Trên Render → Tab **Logs**

**Phải thấy:**
```
==> Running migrations.
✓ 2025_11_07_085427_create_nguoidung_table
✓ 2025_11_16_145412_create_personal_access_tokens_table
✓ 2025_11_21_143847_create_donhang_table
✓ 2025_11_21_144423_create_khuyenmai_table
✓ 2025_11_21_145410_create_danhmuc_table
✓ 2025_11_21_145636_create_sanpham_table
✓ 2025_11_21_150236_create_chitietdonhang_table
✓ 2026_02_05_034553_create_cache_table
✓ 2026_02_05_034617_create_sessions_table

==> Your service is live 🎉
```

**Nếu thấy 9 dấu ✓ = THÀNH CÔNG!**

---

## 🔍 Tại sao lỗi?

Migration có check `if (!Schema::hasTable('users'))` nhưng:
- PostgreSQL sử dụng **transactions** cho migrations
- Nếu có table cũ + unique constraints → Transaction abort
- Code không thể rollback được

**Giải pháp duy nhất:** Reset database trước khi deploy!

---

## ✅ Checklist

- [ ] ✅ Đã chạy SQL DROP tables trên Neon
- [ ] ✅ Kiểm tra tất cả tables đã xóa
- [ ] ✅ Đã trigger redeploy trên Render
- [ ] ✅ Đợi deploy xong (logs không có lỗi)
- [ ] ✅ Thấy "Your service is live 🎉"
- [ ] ✅ Test web: https://web-ban-banh.onrender.com

---

## 🆘 Nếu vẫn lỗi

### Lỗi: "Table already exists"
→ Quay lại Bước 1, chạy lại SQL DROP

### Lỗi: "Connection refused"
→ Kiểm tra Environment Variables (DB_HOST, DB_PASSWORD)

### Lỗi: "SQLSTATE[42P01]"
→ Table không tồn tại - Migration đang chạy, đợi thêm

---

## 📞 Quick Debug

### Kiểm tra tables trên Neon:

```sql
-- Xem tất cả tables hiện có
SELECT tablename FROM pg_tables WHERE schemaname = 'public';
```

**Kết quả mong đợi sau khi DROP:** Không có table nào (hoặc 0 rows)

---

**TÓM TẮT:**
1. DROP tables trên Neon SQL Editor
2. Redeploy trên Render
3. Kiểm tra logs
4. Test web

**Thời gian: 3 phút** ⚡
