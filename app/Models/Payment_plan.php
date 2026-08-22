<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment_plan extends Model
{
  use HasFactory;

  protected $fillable = [
    'plan_name',
    'total_installments',
    'total_fee',
    'starting_date',
    'due_date',
    'installment_no',
    'fee_per_installment',
    'status',
    'student_course_id',
   ];

  public function student_course()
  {
    return $this->belongsTo(Student_course::class);
  }

  public function payment_histories()
  {
    return $this->hasMany(Payment_history::class);
  }

}
