<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Nếu bảng không sử dụng định dạng số nhiều
    protected $table = 'attendances';

    // Các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'id',
        'staff_id',
    ];


}
