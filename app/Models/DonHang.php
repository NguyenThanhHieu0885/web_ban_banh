<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhang'; // Ten bang trong CSDL
    protected $primaryKey = 'madh';// Khoa chinh
    public $incrementing = true;// Khoa chinh tu tang
    protected $keyType = 'int';// Kieu du lieu khoa chinh
    public $timestamps = false; // Ko su dung created_at va updated_at

    protected $fillable = [
        'solienhe',
        'diachigiao',
        'ngaydat',
        'trangthai',
        'mand',
        'makm'
    ];
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'mand', 'mand');
    }

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'madh', 'madh');
    }
}
