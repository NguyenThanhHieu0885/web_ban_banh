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
        if (!Schema::hasTable('khuyenmai')) {
            Schema::create('khuyenmai', function (Blueprint $table) {
                $table->bigIncrements('makm');
                $table->string('tenkm', 100);
                $table->string('loaikm', 20);
                $table->integer('giatri');
                $table->dateTime('ngaybd');
                $table->dateTime('ngaykt');
                $table->string('dieukien', 30)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khuyenmai');
    }
};
