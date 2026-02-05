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
        if (!Schema::hasTable('chitietdonhang')) {
            Schema::create('chitietdonhang', function (Blueprint $table) {
                $table->bigIncrements('mactdh');
                $table->integer('soluong');
                $table->integer('dongia');
                $table->foreignId('madh')
                        ->constrained('donhang', 'madh')
                        ->onDelete('cascade');
                $table->foreignId('masp')
                        ->constrained('sanpham', 'masp')
                        ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonhang');
    }
};
