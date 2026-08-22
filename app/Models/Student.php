<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'gender',
    'age',                  
    'cnic_number',
    'cnic_document',
    'image',
    'father_name',
    'father_cnic',
    'father_occupation',
    'contact_number',
    'father_cell_number',
    'email',
    'address',
    'recent_education',     
    'marks',                
    'enrolled_program',     
    'educational_place',
    'additional_document',
   ];

    public function courses()
    {
        return $this->belongsToMany(Course::class , 'student_course', 'student_id', 'course_id')
                    ->withPivot('payment_plan', 'starting_date', 'ending_date')
                    ->withTimestamps();
    }

public function student_courses()
{
    return $this->hasMany(Student_course::class, 'student_id');
}



}
