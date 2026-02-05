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
        if (!Schema::hasTable('donhang')) {
            Schema::create('donhang', function (Blueprint $table) {
                $table->bigIncrements('madh');
                $table->string('solienhe', 15);
                $table->string('diachigiao', 255);
                $table->dateTime('ngaydat');
                $table->string('trangthai', 20);
                $table->foreignId('mand')->nullable()
                        ->constrained('users', 'id')       // FK tới bảng users (không phải nguoidung)
                        ->onDelete('cascade'); 
                $table->foreignId('makm')->nullable()
                        ->constrained('khuyenmai', 'makm')       // FK tới bảng khuyenmai
                        ->onDelete('cascade'); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
