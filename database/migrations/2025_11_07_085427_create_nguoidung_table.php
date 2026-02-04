<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // 2. Tạo bảng mới
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->bigIncrements('mand'); // Khóa chính là mand
            $table->string('hoten', 100);
            $table->string('email', 100)->unique();
            $table->string('matkhau', 255);
            $table->string('sodienthoai', 15)->nullable();
            $table->string('diachi', 255)->nullable();
            $table->string('vaitro', 10)->default('user');
            
            // 3. Bắt buộc phải có timestamps (created_at, updated_at)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};