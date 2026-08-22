@extends('layout.app')

@section('content')

    <!-- CONTENT -->
                <div class="row g-0">

                    <div class="col-lg-12 g-0">

                        <div class="card w-75 mt-2 ms-3">

                            <div class="card-body w-75"  >

                                <div class="card-title">
                                    <h3>MAKE ENROLLMENTS</h3>
                                </div>
     @if(session('success'))
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
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
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                                                                <div class="form-label mt-3">
                                    <label for="role_name">
                                        SEARCH STUDENT BY CNIC
                                        <span class="text-danger">*</span>
                                    </label>
                                     <select    id="student_id"
                                        name="student_id"
                                        class="form-control mt-2 px-3"
                                        style="width: 100%;">

                                    <option value="" >Select User</option>

                                </select>
                                    
                                </div>


                                       <div class="form-label mt-3">

                                    <label for="role_name">
                                        SEARCH COURSE
                                        <span class="text-danger">*</span>
                                    </label>
                                        <select  id="course_id"
                                            name="course_id"
                                            class="form-control mt-2 px-3"
                                            style="width: 100%;">
                                    <option value=""  >Select Course</option>

                                </select>
                                </div>
                                 
                                <div class="mt-3">
                                    <button class="form-control bg-success text-light show_enrollment_details"  id='proceed_btn' >
                                       PROCEED
                                    </button>
                                   
                                </div>

                            </div>

                
                        </div>
                    </div>

                </div>

<!-- CONTENT END -->
{{-- sHOW MODAL --}}

 <div class="modal fade" id="show_student_enrollment_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">
                <i class="ri-eye-line me-2"></i>
                Enrollment Details
            </h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
            </button>
        </div>

        <div class="modal-body">

            <!-- Student Details -->
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th colspan="8">Student Details</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="table-light fw-semibold">
                        <td>Name</td>
                        <td>Gender</td>
                        <td>Age</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td>Qualification</td>
                        <td>Institute</td>
                    </tr>

                    <tr>
                        <td id="stu_name_enroll" ></td>
                        <td id="stu_gender_enroll" ></td>
                        <td id="stu_age_enroll" ></td>
                        <td id="stu_phone_enroll" ></td>
                        <td id="stu_email_enroll" ></td>
                        <td id="stu_qualification_enroll" ></td>
                        <td id="stu_institute_enroll" ></td>
                    </tr>

                </tbody>
            </table>

            <!-- Course Details -->
            <table class="table table-bordered text-center align-middle mt-4">

                <thead class="table-dark">
                    <tr>
                        <th colspan="6">Course Details</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="table-light fw-semibold">
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

              <button type="submit"
                    class="btn btn-info"
                    >
                Confirm & Save
            </button>

            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Close
            </button>
        </form>
        </div>

    </div>

</div>
      </div>

      {{-- ------------------------------ --}}

  
@endsection