<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AviatorModel extends Model
{
    use HasFactory;
    protected $table = 'rounds';
    protected $fillable = [
    	'stake',
    	'win_status',
    	'multiplier',
    	'amount',
        'code',
        'exp_multiplier',
        'user_id',
    ];

}
