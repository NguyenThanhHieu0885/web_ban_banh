Write-Host "🚀 Preparing for Render Deploy..." -ForegroundColor Cyan
Write-Host ""

# 1. Generate APP_KEY
Write-Host "📝 Generating APP_KEY..." -ForegroundColor Yellow
$APP_KEY = php artisan key:generate --show
Write-Host "Your APP_KEY: $APP_KEY" -ForegroundColor Green
Write-Host "👉 Copy this and paste to Render Environment Variables" -ForegroundColor White
Write-Host ""

# 2. Check if public/index.html exists
Write-Host "🔍 Checking frontend build..." -ForegroundColor Yellow
if (Test-Path "public/index.html") {
    Write-Host "✅ public/index.html found" -ForegroundColor Green
} else {
    Write-Host "❌ public/index.html NOT found" -ForegroundColor Red
    Write-Host "👉 Run: npm run build" -ForegroundColor White
}

if (Test-Path "public/assets") {
    Write-Host "✅ public/assets/ found" -ForegroundColor Green
} else {
    Write-Host "❌ public/assets/ NOT found" -ForegroundColor Red
    Write-Host "👉 Run: npm run build" -ForegroundColor White
}
Write-Host ""

# 3. Check routes
Write-Host "🔍 Checking routes configuration..." -ForegroundColor Yellow
$webContent = Get-Content "routes/web.php" -Raw
if ($webContent -match "Route::fallback") {
    Write-Host "✅ Fallback route configured" -ForegroundColor Green
} else {
    Write-Host "❌ Fallback route NOT configured" -ForegroundColor Red
}
Write-Host ""

# 4. Check CORS
Write-Host "🔍 Checking CORS configuration..." -ForegroundColor Yellow
$corsContent = Get-Content "config/cors.php" -Raw
if ($corsContent -match "'allowed_origins' => \['\*'\]") {
    Write-Host "✅ CORS allows all origins" -ForegroundColor Green
} else {
    Write-Host "⚠️  CORS might need update for production" -ForegroundColor Yellow
}
Write-Host ""

# 5. Git status
Write-Host "📦 Git status..." -ForegroundColor Yellow
git status --short
Write-Host ""

Write-Host "✅ Ready to deploy!" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. git add ."
Write-Host "2. git commit -m 'Deploy to Render'"
Write-Host "3. git push origin main"
Write-Host "4. Go to Render and create Web Service"
Write-Host ""
Write-Host "Don't forget to:" -ForegroundColor Yellow
Write-Host "- Add Environment Variables on Render"
Write-Host "- Use the APP_KEY above"
Write-Host "- Add Neon database credentials"
Write-Host ""
Write-Host "Press any key to continue..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
