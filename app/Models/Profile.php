<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\String\u;

class Profile extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'profile';
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

    public static function salaryOptions(): array
    {
        return [
            1 => 'Dưới 5 triệu',
            2 => 'Từ 5 đến 10 triệu',
            3 => 'Từ 10 đến 20 triệu',
            4 => 'Trên 20 triệu'
        ];
    }

    public function getFrontCardImageUrl(): string
    {
        return url('/uploads/') . '/' . $this->{'front-card'};
    }

    public function getBackCardImageUrl(): string
    {
        return url('/uploads/') . "/" . $this->{'back-card'};
    }

    public function getSelfieImageUrl(): string
    {
        return url('/uploads/') . "/" . $this->{'verify-photo'};
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
