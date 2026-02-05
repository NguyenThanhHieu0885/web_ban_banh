# ⚡ COPY & PASTE - Environment Variables cho Render

## 📋 Copy toàn bộ và paste vào Render

Vào Render Dashboard → Service → Environment → **Add from .env**

Paste đoạn này:

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

## ⚠️ Lưu ý:

1. **APP_URL**: Thay `https://web-ban-banh.onrender.com` bằng URL thực tế của bạn
2. **APP_KEY**: Đã generate sẵn, có thể dùng luôn
3. **DB_PASSWORD**: Đã điền sẵn từ Neon của bạn

## ✅ Sau khi paste:

1. Click **Add Variables**
2. Click **Save Changes**  
3. Đợi Render deploy (5-10 phút)
4. Done! 🎉

---

**Chi tiết đầy đủ:** Xem file `RENDER_ENV_CONFIG.md`
