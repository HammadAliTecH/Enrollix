<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student_course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_courses = Student_course::with(['student', 'course.user'])->get();
        return view('pages.students.enrollment_list', compact('student_courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student_course $student_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student_course $student_course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student_course $student_course)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($validatedData['course_id']);
        $startingDate = $student_course->starting_date
            ? Carbon::parse($student_course->starting_date)
            : Carbon::today();

        $endingDate = $this->calculateEndingDate($startingDate, $course->duration);

        $student_course->update([
            'student_id' => $validatedData['student_id'],
            'course_id' => $validatedData['course_id'],
            'payment_plan' => $course->payment_type,
            'starting_date' => $startingDate,
            'ending_date' => $endingDate,
        ]);

        return redirect()->back()->with('success', 'Enrollment updated successfully.');
    }

    private function calculateEndingDate(Carbon $startingDate, string $duration): Carbon
    {
        return match (strtoupper(trim($duration))) {
            '2-MONTHS' => $startingDate->copy()->addMonths(2),
            '3-MONTHS' => $startingDate->copy()->addMonths(3),
            '6-MONTHS' => $startingDate->copy()->addMonths(6),
            'ONE YEAR' => $startingDate->copy()->addYear(),
            default => $startingDate->copy(),
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student_course $student_course)
    {
        $student_course->delete();
        return redirect()->back()->with('success', 'Enrollment deleted successfully.');
    }
}
