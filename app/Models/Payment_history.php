<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment_history extends Model
{
    use HasFactory;

    protected $fillable = [
    'pay_amount',
    'payment_mode',
    'pay_date',
    'user_id',
    'payment_plan_id',
   ];

    public function payment_plan()
    {
        return $this->belongsTo(payment_plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
