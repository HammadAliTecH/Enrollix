<?php

namespace App\Http\Controllers;

use App\Models\{Payment_plan, Student_course, Student, Payment_history};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_courses = Student_course::with([
            'student',
            'course.user',
            'payment_plans'
        ])->get();

        return view('pages.payments.fee_book', compact('student_courses'));
    }

    public function getPaymentPlanDetails($id)
    {
        $payment_plan = Payment_plan::where('student_course_id', $id)->get();

        return response()->json($payment_plan);
    }

    public function get_student_payment_shedule(Request $request)
    {
        $student_payment_shedule = Student::where('cnic_number', $request->cnic_number)
            ->with([
                'student_courses.course',
                'student_courses.payment_plans' => function ($query) {
                    $query->where('status', 'pending');
                }
            ])
            ->get();

        return response()->json($student_payment_shedule);
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'payment_plan_id' => 'required|exists:payment_plans,id',
            'payment_mode'    => 'required|string',
        ]);

        // 1) Update the payment plan status to paid
        $payment_plan = Payment_plan::findOrFail($request->payment_plan_id);
        $payment_plan->status = 'paid';
        $payment_plan->save();

        // 2) Create a payment history entry (the amount is taken directly from the payment plan because it is not coming from the form)
        Payment_history::create([
            'pay_amount'      => $payment_plan->fee_per_installment,
            'payment_mode'    => $request->payment_mode,
            'pay_date'        => now(),
            'user_id'         => 1,
            'payment_plan_id' => $payment_plan->id,
        ]);

        return redirect()->back()->with('success', 'Payment recorded successfully.');
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
    public function show(Payment_plan $payment_plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment_plan $payment_plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment_plan $payment_plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_plan $payment_plan)
    {
        //
    }
}