<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kiểm tra nếu table chưa tồn tại mới tạo
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id(); 
                $table->string('hoten', 100);
                $table->string('email', 100);
                $table->string('matkhau', 255);
                $table->string('sodienthoai', 15)->nullable();
                $table->string('diachi', 255)->nullable();
                $table->string('vaitro', 10)->default('user');
                $table->timestamps();
            });
            
            // Thêm unique constraint sau khi table đã được tạo
            Schema::table('users', function (Blueprint $table) {
                $table->unique('email');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};