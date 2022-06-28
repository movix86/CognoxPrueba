<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasRegistradas extends Model
{
    use HasFactory;
    protected $table = "cuentasregistradas";
    protected $fillable = ['account_target', 'user_origin_id', 'user_target_id'];
}
