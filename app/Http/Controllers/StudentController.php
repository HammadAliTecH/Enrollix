<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\{Student , Student_course , Course , Payment_plan , Payment_history};
use Illuminate\Http\Request;
use App\Http\Requests\{
    StudentRequest  , UpdateStudentRequest
};

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();

        return view('pages.students.student_list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.students.add_student');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();

        // Profile Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('students_data/students_profile_images'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        // CNIC Document
        if ($request->hasFile('cnic_document')) {
            $cnic = $request->file('cnic_document');
            $cnicName = time() . '_' . $cnic->getClientOriginalName();

            $cnic->move(
                public_path('students_data/student_cnic'),
                $cnicName
            );

            $data['cnic_document'] = $cnicName;
        }

        // Additional / Other Documents
        if ($request->hasFile('additional_document')) {
            $other = $request->file('additional_document');
            $otherName = time() . '_' . $other->getClientOriginalName();

            $other->move(
                public_path('students_data/other_documents'),
                $otherName
            );

            $data['additional_document'] = $otherName;
        }

        $student = Student::create($data);

        return redirect()->back()->with(
            'success',
            'Student Created Successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        // Profile Image
        if ($request->hasFile('image')) {

            if ($student->image) {
                $oldImage = public_path(
                    'students_data/students_profile_images/' . $student->image
                );

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('students_data/students_profile_images'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        // CNIC Document
        if ($request->hasFile('cnic_document')) {

            if ($student->cnic_document) {
                $oldCnic = public_path(
                    'students_data/student_cnic/' . $student->cnic_document
                );

                if (file_exists($oldCnic)) {
                    unlink($oldCnic);
                }
            }

            $cnic = $request->file('cnic_document');
            $cnicName = time() . '_' . $cnic->getClientOriginalName();

            $cnic->move(
                public_path('students_data/student_cnic'),
                $cnicName
            );

            $data['cnic_document'] = $cnicName;
        }

        // Additional / Other Documents
        if ($request->hasFile('additional_document')) {

            if ($student->additional_document) {
                $oldDocument = public_path(
                    'students_data/other_documents/' . $student->additional_document
                );

                if (file_exists($oldDocument)) {
                    unlink($oldDocument);
                }
            }

            $other = $request->file('additional_document');
            $otherName = time() . '_' . $other->getClientOriginalName();

            $other->move(
                public_path('students_data/other_documents'),
                $otherName
            );

            $data['additional_document'] = $otherName;
        }

        $student->update($data);

        return redirect()->back()->with(
            'success',
            'Student Updated Successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->image) {
            $oldImage = public_path(
                'students_data/students_profile_images/' . $student->image
            );

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        if ($student->cnic_document) {
            $oldCnic = public_path(
                'students_data/student_cnic/' . $student->cnic_document
            );

            if (file_exists($oldCnic)) {
                unlink($oldCnic);
            }
        }

        if ($student->additional_document) {
            $oldDocument = public_path(
                'students_data/other_documents/' . $student->additional_document
            );

            if (file_exists($oldDocument)) {
                unlink($oldDocument);
            }
        }

        $student->delete();

        return redirect()->back()->with(
            'success',
            'Student Deleted Successfully'
        );
    }

    // SEARCH STUDENT BY CNIC

    // SEARCH INSTRUCTOR
    public function search(Request $request)
    {
        $search = $request->search;

        $students = Student::where('cnic_number', 'LIKE', '%' . $search . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get()
            ->map(function ($student) {

                return [
                    'id'   => $student->id,
                    'text' => $student->name,
                ];

            });

        return response()->json($students);
    }

    // FETCH STUDENT AND COURSE DATA FOR ENROLLMENT
    public function fetchStudentAndCourseData(Request $request)
    {
        $studentId = $request->student_id;
        $courseId  = $request->course_id;

        $student = Student::find($studentId);
        $course = Course::find($courseId);

        return response()->json([
            'student' => $student,
            'course'  => $course
        ]);
    }

    // ---------------------------------------------------------------------
    // make enrollment
    public function makeEnrollment(Request $request)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id'  => 'required|exists:courses,id',
    ]);

    // 1. Duplicate enrollment check
    $alreadyEnrolled = Student_course::where('student_id', $validated['student_id'])
        ->where('course_id', $validated['course_id'])
        ->exists();

    if ($alreadyEnrolled) {
        return back()->with('error', 'Ye student is course mein pehle se enrolled hai.');
    }

    // 2. Course se data lo
    $course = Course::findOrFail($validated['course_id']);

    $startingDate = Carbon::today();
    $endingDate   = $this->calculateEndingDate($startingDate, $course->duration);

    // 3. Pivot record create karo — save the instance, don't refetch
    $studentCourse = Student_course::create([
        'student_id'    => $validated['student_id'],
        'course_id'     => $validated['course_id'],
        'payment_map'  => $course->payment_type,
        'starting_date' => $startingDate,
        'ending_date'   => $endingDate,
    ]);

    // 4. Payment plan entries banao
    if ($course->payment_type === 'INSTALLMENTS') {
        $installmentCount = (int) $course->total_installments;
        $feePerInstallment = (int) ceil($course->fee / $installmentCount);

        // last installment ko remainder ke sath adjust karo (rounding fix)
        $totalAllocated = $feePerInstallment * $installmentCount;
        $lastInstallmentAdjustment = $course->fee - $totalAllocated; // negative ya zero hoga

        for ($i = 1; $i <= $installmentCount; $i++) {
            $dueDate = $startingDate->copy()->addMonths($i);

            $installmentFee = $feePerInstallment;
            if ($i === $installmentCount) {
                $installmentFee += $lastInstallmentAdjustment; // rounding difference last installment mein absorb
            }

            Payment_plan::create([
                'student_course_id'  => $studentCourse->id,
                'plan_name'           => 'Installment ' . $i . ' of ' . $installmentCount,
                'total_installments'  => $installmentCount,
                'total_fee'           => $course->fee,
                'starting_date'       => $startingDate,
                'due_date'            => $dueDate,
                'installment_no'       => $i,
                'fee_per_installment' => $installmentFee,
                'status'              => 'pending',
            ]);
        }
    } else {
        // one-time payment — single plan entry
        Payment_plan::create([
            'student_course_id'  => $studentCourse->id,
            'plan_name'           => 'Full Payment',
            'total_installments'  => 1,
            'total_fee'           => $course->fee,
            'starting_date'       => $startingDate,
            'due_date'            => $startingDate,
            'installment_no'       => 1,
            'fee_per_installment' => $course->fee,
            'status'              => 'pending',
        ]);
    }

    return redirect()->back()->with('success', 'Student successfully enrolled.');
}
    //--------------------------------------------------------------------    
    private function calculateEndingDate(Carbon $startingDate, string $duration)
    {
        $duration = strtoupper(trim($duration)); // extra spaces/case fix

        return match ($duration) {
            '2-MONTHS' => $startingDate->copy()->addMonths(2),
            '3-MONTHS' => $startingDate->copy()->addMonths(3),
            '6-MONTHS' => $startingDate->copy()->addMonths(6),
            'ONE YEAR' => $startingDate->copy()->addYear(),
            default    => $startingDate->copy(), // fallback agar koi unknown value aa jaye
        };
    }
}