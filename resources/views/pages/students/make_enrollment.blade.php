@extends('layout.app')

@section('content')

    <!-- CONTENT -->
    <div class="row g-0">

        <div class="col-lg-12 g-0">

            <div class="card page_card enrollment_card mt-2 ms-3">

                <div class="card-body">

                    <div class="card-title mb-0">
                        <h3 class="page_title mb-0">Make Enrollment</h3>
                        <p class="page_subtitle mb-0">Search a student and a course to create a new enrollment</p>
                    </div>

                    @if(session('success'))
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-success alert-dismissible fade show w-75 mt-3" role="alert">
                                {{ session('success') }}

                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close">
                                </button>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="field_label mt-4">
                        <label for="student_id">
                            Search Student by CNIC
                            <span class="text-danger">*</span>
                        </label>

                        <select id="student_id"
                                name="student_id"
                                class="form-control mt-2 px-3"
                                style="width: 100%;">

                            <option value="">Select User</option>

                        </select>
                    </div>

                    <div class="field_label mt-3">
                        <label for="course_id">
                            Search Course
                            <span class="text-danger">*</span>
                        </label>

                        <select id="course_id"
                                name="course_id"
                                class="form-control mt-2 px-3"
                                style="width: 100%;">

                            <option value="">Select Course</option>

                        </select>
                    </div>

                    <div class="mt-4">
                        <button class="btn_gradient show_enrollment_details" id="proceed_btn">
                            <i class="ri-arrow-right-line"></i>
                            Proceed
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- CONTENT END -->
    {{-- SHOW MODAL --}}

    <div class="modal fade" id="show_student_enrollment_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header modal_brand_header">
                    <h5 class="modal-title">
                        <i class="ri-eye-line me-2"></i>
                        Enrollment Details
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Student Details -->
                    <table class="table table-bordered text-center align-middle detail_table">
                        <thead>
                            <tr>
                                <th colspan="8">Student Details</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="detail_table_labels">
                                <td>Name</td>
                                <td>Gender</td>
                                <td>Age</td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td>Qualification</td>
                                <td>Institute</td>
                            </tr>

                            <tr>
                                <td id="stu_name_enroll"></td>
                                <td id="stu_gender_enroll"></td>
                                <td id="stu_age_enroll"></td>
                                <td id="stu_phone_enroll"></td>
                                <td id="stu_email_enroll"></td>
                                <td id="stu_qualification_enroll"></td>
                                <td id="stu_institute_enroll"></td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Course Details -->
                    <table class="table table-bordered text-center align-middle detail_table mt-4">

                        <thead>
                            <tr>
                                <th colspan="6">Course Details</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="detail_table_labels">
                                <td>ID</td>
                                <td>Course Name</td>
                                <td>Duration</td>
                                <td>Instructor</td>
                                <td>Payment Plan</td>
                                <td>Installments</td>
                            </tr>

                            <tr>
                                <td id="course_id_enroll"></td>
                                <td id="course_name_enroll"></td>
                                <td id="course_duration_enroll"></td>
                                <td id="instructor_enroll"></td>
                                <td id="payment_plan_enroll"></td>
                                <td id="installments_enroll"></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <form action="{{ route('students.enroll') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" id="hidden_student_id">
                    <input type="hidden" name="course_id" id="hidden_course_id">

                    <div class="modal-footer">

                        <button type="submit" class="btn_gradient btn_gradient_sm">
                            <i class="ri-check-line"></i>
                            Confirm &amp; Save
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    {{-- ------------------------------ --}}

@endsection