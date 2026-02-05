<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Dọn dẹp nếu lỡ còn sót
        Schema::dropIfExists('nguoidung');

        // 2. Tạo bảng với tên viết thường (Chuẩn PostgreSQL)
        Schema::create('nguoidung', function (Blueprint $table) {
            // Dùng id() thay vì bigIncrements('mand') để tránh lỗi vặt
            $table->id(); 
            
            $table->string('hoten', 100);
            
            // Tách unique ra để tránh lỗi Transaction
            $table->string('email', 100); 
            
            $table->string('matkhau', 255);
            $table->string('sodienthoai', 15)->nullable();
            $table->string('diachi', 255)->nullable();
            $table->string('vaitro', 10)->default('user');
            
            // Bắt buộc phải có cái này
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};