<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffQRCode extends Model
{
    use HasFactory;

    // Nếu bảng không sử dụng định dạng số nhiều
    protected $table = 'staff_qr_code';

    // Các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'id',
        'image',
        'code',
        'name',
    ];
}
