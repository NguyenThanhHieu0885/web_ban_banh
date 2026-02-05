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
    Schema::create('donhang', function (Blueprint $table) {
        $table->id(); // Khóa chính của đơn hàng
        
        // --- QUAN TRỌNG: Cột này phải cùng kiểu với id của bảng users ---
        // Vì users dùng id() (là BigInt), nên ở đây BẮT BUỘC phải dùng unsignedBigInteger
        $table->unsignedBigInteger('mand'); 
        
        // Các cột khác của bạn (giữ nguyên)
        $table->date('ngaydat')->nullable();
        $table->decimal('tongtien', 10, 2)->default(0);
        $table->string('trangthai')->default('pending');
        // ... thêm các cột khác nếu bạn có ...

        $table->timestamps();

        // --- TẠO LIÊN KẾT KHÓA NGOẠI ---
        // Giải thích: Cột 'mand' tham chiếu tới cột 'id' của bảng 'users'
        $table->foreign('mand')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('donhang');
}
};
