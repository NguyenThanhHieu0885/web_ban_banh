<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitietdonhang'; // Ten bang trong CSDL
    protected $primaryKey = 'mactdh';// Khoa chinh
    public $incrementing = true;// Khoa chinh tu tang
    protected $keyType = 'int';// Kieu du lieu khoa chinh
    public $timestamps = false; // Ko su dung created_at va updated_at
    protected $fillable = [
        'soluong',
        'dongia',
        'madh',
        'masp'
    ];
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'madh', 'madh');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'masp', 'masp');
    }
}
