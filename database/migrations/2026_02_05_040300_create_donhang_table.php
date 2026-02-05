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
        $table->bigIncrements('madh'); // Khóa chính của đơn hàng
        
        // --- QUAN TRỌNG: Cột này phải cùng kiểu với id của bảng users ---
        // Vì users dùng id() (là BigInt), nên ở đây BẮT BUỘC phải dùng unsignedBigInteger
        $table->unsignedBigInteger('mand'); 
        
        // Các cột khác
        $table->string('solienhe', 15)->nullable();
        $table->string('diachigiao', 255)->nullable();
        $table->date('ngaydat')->nullable();
        $table->decimal('tongtien', 10, 2)->default(0);
        $table->string('trangthai')->default('pending');
        
        // Khóa ngoại tới bảng khuyenmai (nullable vì không bắt buộc)
        $table->unsignedBigInteger('makm')->nullable();

        // --- TẠO LIÊN KẾT KHÓA NGOẠI ---
        // Cột 'mand' tham chiếu tới cột 'id' của bảng 'users'
        $table->foreign('mand')->references('id')->on('users')->onDelete('cascade');
        
        // Cột 'makm' tham chiếu tới cột 'makm' của bảng 'khuyenmai'
        $table->foreign('makm')->references('makm')->on('khuyenmai')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::dropIfExists('donhang');
}
};
