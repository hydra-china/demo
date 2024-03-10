<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'wallets';

    protected $guarded = ['id'];

    public static function reasonOptions()
    {
        $reasons = [
            'Sai thông tin liên kết ví',
            'Rút tiền vi phạm hợp đồng vay. Đóng băng ví vay!',
            'Điểm tín dụng không đủ',
            'Số tiền rút vi phạm hợp đồng Vay. Vui lòng liên hệ CSKH',
            'Đóng băng khoản Vay',
            'Hồ sơ bất cập yêu cầu đổi STK nhận tiền',
            'Lệnh rút đã được tạo. Vui lòng nhận khoản Vay sau 10 phút',
            'Địa chỉ không khớp với CCCD/CMT',
            'Tên chủ tài khoản không hợp lệ',
            'Rút tiền về tài khoản ngân hàng thành công'
        ];

        $dataReturn = [];

        foreach ($reasons as $reason) {
            $dataReturn[$reason] = $reason;
        }

        return $dataReturn;
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
