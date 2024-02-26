<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'loans';
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

    public static function loanStatusOption(): array
    {
        return [
            0 => 'Chờ duyệt',
            1 => 'Đã duyệt',
            2 => 'Đã từ chối'
        ];
    }

    public function Profile()
    {
        return Profile::query()->where('user_id', $this->user_id)->first();
    }

    public function Staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getProfileNameAttribute()
    {
        return $this->Profile()?->name ?? 'Tai khoan bi xoa';
    }

    public function getTimestampAttribute()
    {
        return Carbon::parse($this->created_at)->timestamp;
    }

    public function getPhoneAttribute()
    {
        return $this->Profile()?->phone;
    }


}
