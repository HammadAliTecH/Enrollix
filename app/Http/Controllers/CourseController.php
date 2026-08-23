<?php

namespace App\Http\Controllers;

use App\Models\{Course, User};
use Illuminate\Http\Request;
use App\Http\Requests\{CourseRequest, UpdateCourseRequest};

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('user')->get();

        return view('pages.courses.course_list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.courses.add_course');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        // Cover Image
        if ($request->hasFile('cover_image')) {

            $data['cover_image'] = $request->file('cover_image')
                ->store('courses/cover', 'public');
        }

        // PDF Book
        if ($request->hasFile('pdf_book')) {

            $data['pdf_book'] = $request->file('pdf_book')
                ->store('courses/pdf_book', 'public');
        }

        if ($request->payment_type == 'ONE TIME') {

            $data['total_installments'] = 'none';
        }

        Course::create($data);

        return redirect()
            ->back()
            ->with('success', 'Course Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        // Cover Image
        if ($request->hasFile('cover_image')) {

            // Delete old cover image
            if ($course->cover_image) {

                $oldCover = public_path('storage/' . $course->cover_image);

                if (file_exists($oldCover)) {
                    unlink($oldCover);
                }
            }

            // Store new cover image
            $data['cover_image'] = $request->file('cover_image')
                ->store('courses/cover', 'public');
        }

        // PDF Book
        if ($request->hasFile('pdf_book')) {

            // Delete old PDF
            if ($course->pdf_book) {

                $oldPdf = public_path('storage/' . $course->pdf_book);

                if (file_exists($oldPdf)) {
                    unlink($oldPdf);
                }
            }

            // Store new PDF
            $data['pdf_book'] = $request->file('pdf_book')
                ->store('courses/pdf_book', 'public');
        }

        // Payment Type
        if ($request->payment_type == 'ONE TIME') {

            $data['total_installments'] = 'none';
        }

        // Update Course
        $course->update($data);

        return redirect()
            ->back()
            ->with('success', 'Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Delete cover image
        if ($course->cover_image) {

            $oldCover = public_path('storage/' . $course->cover_image);

            if (file_exists($oldCover)) {
                unlink($oldCover);
            }
        }

        // Delete PDF book
        if ($course->pdf_book) {

            $oldPdf = public_path('storage/' . $course->pdf_book);

            if (file_exists($oldPdf)) {
                unlink($oldPdf);
            }
        }

        // Delete course
        $course->delete();

        return redirect()
            ->back()
            ->with('success', 'Course Deleted Successfully');
    }

    // FETCH INSTRUCTORS DATA
    public function fetchInstructors()
    {
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })
            ->with('courses')
            ->get();

        return view('pages.courses.instructor_list', compact('instructors'));
    }

    // ----------------------------------------------
    // Search course by name
    public function search(Request $request)
    {
        $search = $request->search;

        $courses = Course::where('name', 'LIKE', '%' . $search . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get()
            ->map(function ($course) {

                return [
                    'id'   => $course->id,
                    'text' => $course->name,
                ];
            });

        return response()->json($courses);
    }
}