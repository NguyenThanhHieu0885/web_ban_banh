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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->bigIncrements('mand');
            $table->string('hoten', 100);
            $table->string('email', 100)->unique();
            $table->string('matkhau', 255);
            $table->string('sodienthoai', 15)->nullable();
            $table->string('diachi', 255)->nullable();
            $table->string('vaitro', 10)->default('user');
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
