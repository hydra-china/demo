<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'withdraws';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public static function statusOptions()
    {
        return [
            0 => 'Chờ duyệt',
            1 => 'Đã duyệt',
            2 => 'Từ chối',
        ];
    }

    public function getWalletAmountAttribute()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id')->first()?->amount;
    }

    public function approveBtn(): string
    {
        if ($this->status != 0) {
            return "";
        }

        return '<a href="' . url('admin/withdraw/approve/' . $this->id) . '" class="btn btn-sm btn-link"><i class="la la-check-circle"></i> Duyệt</a>';
    }

    public function refuseBtn(): string
    {
        if ($this->status != 0) {
            return "";
        }
        return '<a href="' . url('admin/withdraw/refuse/' . $this->id) . '" class="btn btn-sm btn-link"><i class="la la-x-ray"></i> Từ chối</a>';
    }
}
