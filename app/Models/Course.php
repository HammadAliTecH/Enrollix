<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{

use HasFactory;

protected $fillable = [
    'name',
    'duration',
    'fee',
    'description',
    'pdf_book',
    'cover_image',
    'payment_type',
    'total_installments',
    'user_id',
];

public function user()
{
    return $this->belongsTo(User::class);
}
public function students()
{
    return $this->belongsToMany(Student::class , 'student_course', 'course_id', 'student_id')
                ->withPivot('payment_plan', 'starting_date', 'ending_date')
                ->withTimestamps();
}

}
