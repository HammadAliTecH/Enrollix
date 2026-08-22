<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_course extends Model
{
   use HasFactory;
    protected $table = 'student_course';

   protected $fillable = [
    'student_id',
    'course_id',
    'payment_map',
    'starting_date',
    'ending_date',
   ];

   public function payment_plans()
   {
      return $this->hasMany(Payment_plan::class ,'student_course_id' );
   }
   public function student()
   {
      return $this->belongsTo(Student::class);
   }
   public function course()
   {
      return $this->belongsTo(Course::class);   
   }
 
}
