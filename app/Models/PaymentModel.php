<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'reference';
    public $incrementing = false;
    protected $fillable = [
        'reference',
        'user_id',
        'payment_type',
        'amount',
    ];
}
