#!/bin/bash

echo "🚀 Preparing for Render Deploy..."
echo ""

# 1. Generate APP_KEY
echo "📝 Generating APP_KEY..."
APP_KEY=$(php artisan key:generate --show)
echo "Your APP_KEY: $APP_KEY"
echo "👉 Copy this and paste to Render Environment Variables"
echo ""

# 2. Check if public/index.html exists
echo "🔍 Checking frontend build..."
if [ -f "public/index.html" ]; then
    echo "✅ public/index.html found"
else
    echo "❌ public/index.html NOT found"
    echo "👉 Run: npm run build"
fi

if [ -d "public/assets" ]; then
    echo "✅ public/assets/ found"
else
    echo "❌ public/assets/ NOT found"
    echo "👉 Run: npm run build"
fi
echo ""

# 3. Check routes
echo "🔍 Checking routes configuration..."
if grep -q "Route::fallback" routes/web.php; then
    echo "✅ Fallback route configured"
else
    echo "❌ Fallback route NOT configured"
fi
echo ""

# 4. Check CORS
echo "🔍 Checking CORS configuration..."
if grep -q "'allowed_origins' => \['\*'\]" config/cors.php; then
    echo "✅ CORS allows all origins"
else
    echo "⚠️  CORS might need update for production"
fi
echo ""

# 5. Git status
echo "📦 Git status..."
git status --short
echo ""

echo "✅ Ready to deploy!"
echo ""
echo "Next steps:"
echo "1. git add ."
echo "2. git commit -m 'Deploy to Render'"
echo "3. git push origin main"
echo "4. Go to Render and create Web Service"
echo ""
echo "Don't forget to:"
echo "- Add Environment Variables on Render"
echo "- Use the APP_KEY above"
echo "- Add Neon database credentials"
