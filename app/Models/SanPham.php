<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham'; // Ten bang trong CSDL
    protected $primaryKey = 'masp';// Khoa chinh
    public $incrementing = true;// Khoa chinh tu tang
    protected $keyType = 'int';// Kieu du lieu khoa chinh
    public $timestamps = false; // Ko su dung created_at va updated_at

    protected $fillable = [
        'tensp',
        'giasp',
        'hinhsp',
        'madm'
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'madm', 'madm');
    }
    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'masp', 'masp');
    }
}
