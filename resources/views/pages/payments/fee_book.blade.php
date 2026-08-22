@extends('layout.app')

@section('content')
 <div class="row g-0">
                    <div class="col-lg-12 g-0 px-3 pt-2">
<div class="card w-100   ">
  <div class="card-body ">
    <div class="card-title">
        <div class="d-flex justify-content-between" >
            <div><h3>Fee Book</h3></div>
            <div class="d-flex justify-content-end" >
                <input type="text" name="user_email" id="user_email" class="form-control " placeholder="Search By cnic">    
            </div>
        </div>
        
    </div>
      <div class="table-responsive fee-book-table-wrapper">
       <table class="table table-bordered mt-3 fee-book-table">
  <thead class="table-dark" >
    <tr>
      <th scope="col">id</th>
      <th scope="col" class="student-name-column">Student Name</th>
      <th scope="col" class="student-id-column">Student ID</th>
      <th scope="col" class="course-name-column">Course Name</th>
      <th scope="col" >Total Amount</th>
      <th scope="col" >Payment Plan</th>
      <th scope="col" >Installments</th>
      <th scope="col" >Amount Per Installment</th>
      <th scope="col" >Status</th>
      <th scope="col" >End Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($student_courses as $student_course)
          <tr>
      <th scope="row">{{ $student_course->id }}</th>
      <td>{{ $student_course->student->name }}</td>
      <td>{{ $student_course->student->id }}</td>
      <td>{{ $student_course->course->name }}</td>
      <td>{{ $student_course->course->fee }}</td>
      <td><div class="badge bg-success text-white" >{{ $student_course->payment_map }}</div></td>
      <td>{{ $student_course->course->total_installments }}</td>
      <td>{{ $student_course->payment_plans->first()->fee_per_installment ?? 'N/A' }}</td>
    <td><div class="badge bg-danger badge_blink ">{{ $student_course->payment_plans->last()->status ?? 'N/A' }}</div></td>
     <td>{{ $student_course->ending_date }}</td>
       <td><button class="btn btn-outline-info view_enroll_details " data-bs-toggle="modal" data-bs-target="#show_enrollment_data" title="View Enrollment Document" data-enrollment="{{ $student_course->student }}" data-course='{{ $student_course->course }}' ><i class="ri-information-line"></i></button>
        <button class="btn btn-outline-success plan_detail_model " data-bs-toggle="modal" data-bs-target="#payment_plan_details_model" title="View Enrollment Document" data-id="{{ $student_course->id }}" ><i class="ri-signal-tower-line"></i>
</button>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center" >
    <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item"><a href="#" class="page-link">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active">
      <a class="page-link" href="#" aria-current="page">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
</div>
     </div>
  </div>
</div>


                    </div>
                </div>


<!-- ------------------------------------------------------------------- -->
     {{-- SHOW ENROLLMENT DATA MODAL --}}

    <div class="modal fade" id="show_enrollment_data" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content" id="enrollment_print_area">

                <div class="modal-header no-print">
                    <h5 class="modal-title">Enrollment Details</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Letterhead: visible only when printed -->
                    <div class="print-letterhead d-none">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-dark pb-2 mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="../pngegg.png"
                                     alt="Institute Logo"
                                     class="institute_logo">

                                <div>
                                    <h3 class="mb-0" style="color:navy; letter-spacing:1px;">SMS INSTITUTE</h3>
                                    <p class="mb-0 small text-secondary">
                                        Student Management System &mdash; Shahkot, Punjab
                                    </p>
                                </div>
                            </div>

                            <div class="text-end">
                                <p class="mb-0 fw-bold">ENROLLMENT FORM</p>
                                <p class="mb-0 small text-secondary" id="print_date"></p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-3">
                        <img class="user_model_pic_1"
                             id="enroll_stu_image"
                             src=""
                             alt="Student Picture">
                    </div>

                    <!-- STUDENT DETAIL -->
                    <table class="table table-bordered mb-4">
                        <tbody>

                            <tr class="table-dark">
                                <th colspan="2">Personal Information</th>
                            </tr>

                            <tr>
                                <td class="w-50">Name</td>
                                <td id="enroll_stu_name"></td>
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td id="enroll_stu_gender"></td>
                            </tr>

                            <tr>
                                <td>Age</td>
                                <td id="enroll_stu_age"></td>
                            </tr>

                            <tr>
                                <td>CNIC</td>
                                <td id="enroll_stu_cnic_number"></td>
                            </tr>

                            <tr>
                                <td>Father Name</td>
                                <td id="enroll_stu_father_name"></td>
                            </tr>

                            <tr>
                                <td>Father CNIC</td>
                                <td id="enroll_stu_father_cnic"></td>
                            </tr>

                            <tr>
                                <td>Father Occupation</td>
                                <td id="enroll_stu_father_occupation"></td>
                            </tr>

                            <tr class="table-dark">
                                <th colspan="2">Contact Information</th>
                            </tr>

                            <tr>
                                <td>Phone Number</td>
                                <td id="enroll_stu_phone_number"></td>
                            </tr>

                            <tr>
                                <td>Father Cell Number</td>
                                <td id="enroll_stu_father_cell_number"></td>
                            </tr>

                            <tr>
                                <td>Email Address</td>
                                <td id="enroll_stu_email"></td>
                            </tr>

                            <tr class="table-dark">
                                <th colspan="2">Educational Information</th>
                            </tr>

                            <tr>
                                <td>Recent Qualification</td>
                                <td id="enroll_stu_recent_qualification"></td>
                            </tr>

                            <tr>
                                <td>Marks</td>
                                <td id="enroll_stu_marks"></td>
                            </tr>

                            <tr>
                                <td>Current Enrollment</td>
                                <td id="enroll_stu_current_education"></td>
                            </tr>

                            <tr>
                                <td>Institute Name</td>
                                <td id="enroll_stu_institute_name"></td>
                            </tr>

                            <tr class="table-dark no-print">
                                <th colspan="2">Download Files</th>
                            </tr>

                            <tr class="no-print">
                                <td>Picture</td>
                                <td>
                                    <i class="ri-download-line"></i>
                                    <a href="" id="enroll_stu_image_2" download>DOWNLOAD</a>
                                </td>
                            </tr>

                            <tr class="no-print">
                                <td>CNIC</td>
                                <td>
                                    <i class="ri-download-line"></i>
                                    <a href="" id="enroll_stu_cnic_document" download>DOWNLOAD</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- COURSE DETAIL -->
                    <table class="table table-bordered table-sm mb-0">
                        <tbody>

                            <tr class="table-dark">
                                <th colspan="2">Course Information</th>
                            </tr>

                            <tr>
                                <th class="w-25">NAME</th>
                                <td id="enroll_course_name"></td>
                            </tr>

                            <tr>
                                <th>INSTRUCTOR</th>
                                <td id="enroll_course_instructor"></td>
                            </tr>

                            <tr>
                                <th>DURATION</th>
                                <td id="enroll_course_duration"></td>
                            </tr>

                            <tr>
                                <th>PAYMENT PLAN</th>
                                <td id="enroll_course_payment_plan"></td>
                            </tr>

                            <tr>
                                <th>INSTALLMENTS</th>
                                <td id="enroll_course_installments"></td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Signatures: visible only when printed -->
        

                </div>

                <div class="modal-footer no-print">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="button"
                            class="btn btn-primary"
                            onclick="printEnrollment()">
                        <i class="ri-printer-line me-1"></i>
                        Print
                    </button>

                </div>

            </div>

        </div>

    </div>

<!-- SEE FULL PAYMENT_PLAN RECORD MODAL  -->

<!-- ======== PAYMENT DETAILS ============ -->
<x-modal-component
    modal_id="confirm_payment_model"
    modal_title="PAY FEE"
>
    <div class="modal-body">
        <form action="{{ route('payment_plan.confirm_payment') }}" method="post">
            @csrf

            <b class="d-flex justify-content-center text-center mb-3">
                Have you received this payment? Once confirmed, this installment will be marked as Paid.
            </b>

            <div class="mb-3">
                <label for="payment_mode" class="form-label">
                    Payment Mode
                </label>

                <input type="hidden" id="hidden_payment_plan_id" name="payment_plan_id">

                <select name="payment_mode"
                        id="payment_mode"
                        class="form-select"
                        required>

                    <option value="" selected disabled>
                        Select Payment Mode
                    </option>

                    <option value="bank">
                        Bank
                    </option>

                    <option value="cash">
                        Cash
                    </option>

                </select>
            </div>

        </div>

        <x-slot name="modal_footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Cancel
            </button>

            <button type="submit"
                    class="btn btn-success"
                    data-bs-dismiss="modal">
                Ok, Payment Received
            </button>
            </form>
        </x-slot>

    </x-modal-component>





@endsection
















<style>
  .fee-book-table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .fee-book-table {
    min-width: 1150px;
    table-layout: auto;
  }

  .fee-book-table th,
  .fee-book-table td {
    vertical-align: middle;
    white-space: nowrap;
  }

  .fee-book-table .student-name-column,
  .fee-book-table td:nth-child(2) {
    min-width: 170px;
    white-space: normal;
  }

  .fee-book-table .course-name-column,
  .fee-book-table td:nth-child(4) {
    min-width: 210px;
    white-space: normal;
  }

  .fee-book-table th:last-child,
  .fee-book-table td:last-child {
    min-width: 120px;
  }

  @media (max-width: 576px) {
    .fee-book-table {
      min-width: 1050px;
    }

    .fee-book-table th,
    .fee-book-table td {
      padding: 0.65rem 0.75rem;
    }
  }
</style>