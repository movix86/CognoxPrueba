<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasRegistradas extends Model
{
    use HasFactory;
    protected $table = "cuentasregistradas";
    protected $fillable = ['user_origin_id', 'user_target_id', 'account_target'];
}
