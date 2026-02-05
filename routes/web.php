<?php

use Illuminate\Support\Facades\Route;

// Route cho trang chủ
Route::get('/', function () {
    return response()->file(public_path('index.html'));
});

// Fallback route - Xử lý tất cả các route frontend (SPA)
// Bất kỳ route nào không phải API sẽ trả về index.html
// Điều này cho phép React Router hoặc Vue Router xử lý routing
Route::fallback(function () {
    return response()->file(public_path('index.html'));
});
