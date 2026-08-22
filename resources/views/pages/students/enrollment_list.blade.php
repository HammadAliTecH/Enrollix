@extends('layout.app')

@section('content')
    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 px-3 pt-2">

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

            <div class="card w-100">
                <div class="card-body">
                    <div class="card-title">
                        <div class='d-flex justify-content-between'>
                            <div>
                                <h3>Enrollments List</h3>
                            </div>

                            <div class="d-flex justify-content-center gap-3">
                                <select name="" id="" class="form-control">
                                    <option value="">FILTER BY COURSES <i class="ri-arrow-down-s-line ms-2"></i></option>
                                    <option value="">LARAVEL</option>
                                    <option value="">PHP & MYSQL</option>
                                </select>

                                <input type="text"
                                       name="user_email"
                                       id="user_email"
                                       class="form-control"
                                       placeholder="Search By cnic">
                            </div>
                        </div>
                    </div>

                    <div>
                        <table class="table table-bordered mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Register Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Starting Date</th>
                                    <th scope="col">Ending Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($student_courses as $student_course)
                                    <tr>
                                        <th scope="row">{{ $student_course->id }}</th>
                                        <td>{{ $student_course->student->name }}</td>
                                        <td>{{ $student_course->course->name }}</td>
                                        <td>{{ $student_course->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="badge bg-success text-white">In Progess</div>
                                        </td>
                                        <td>{{ $student_course->starting_date }}</td>
                                        <td>{{ $student_course->ending_date }}</td>
                                        <td>
                                            <button class="btn btn-outline-info show_enrollment"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#show_enrollment_data"
                                                    data-enrollment="{{ $student_course }}">
                                                <i class="ri-file-text-line"></i>
                                            </button>

                                            <button class="btn btn-outline-warning ms-2 edit_enrollment"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#enrollment_update_model"
                                                    data-id="{{ $student_course->id }}">
                                                <i class="ri-edit-line"></i>
                                            </button>

                                            <button class="btn btn-outline-danger ms-2 delete_enrollment"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#enrollment_delete_model"
                                                    data-id="{{ $student_course->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a href="#" class="page-link">Previous</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>

                                    <li class="page-item active">
                                        <a class="page-link" href="#" aria-current="page">2</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
                    <div class="print-letterhead mt-5">
                        <div class="row">
                            <div class="col-6 text-center">
                                <div class="border-top border-dark mx-4 pt-1">Student Signature</div>
                            </div>

                            <div class="col-6 text-center">
                                <div class="border-top border-dark mx-4 pt-1">Registrar Signature</div>
                            </div>
                        </div>
                    </div>

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

    {{-- DELETE ENROLLMENT --}}
    <x-modal-component
        modal_id="enrollment_delete_model"
        modal_title="Delete Enrollment">

        <form
            id="enrollmentDeleteForm"
            method="post">

            @csrf

            @method('DELETE')

            <div class="modal-body">
                <b class="d-flex justify-content-center">
                    Are you confirm to delete that enrollment?
                </b>
            </div>

            <x-slot name="modal_footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button
                    type="submit"
                    class="btn btn-danger">
                    Yes
                </button>

            </form>

            </x-slot>

    </x-modal-component>

    {{-- UPDATE ENROLLMENT --}}
    <x-modal-component
        modal_id="enrollment_update_model"
        modal_title="Update Enrollment">

        <form
            id="enrollmentUpdateForm"
            method="post">

            @csrf

            @method('PUT')

            <div class="modal-body">

                <div class="col-lg-12">
                    <div class="form-label mt-2">
                        <label for="search_user_name">
                            Search By CNIC <span class="text-danger">*</span>
                        </label>

                        <select
                            id="update_student_id"
                            name="student_id"
                            class="form-control mt-2 px-3"
                            style="width: 100%;">

                            <option value="">Select Student</option>

                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-label mt-2">
                        <label for="search_course_name">
                            Search By Course Name <span class="text-danger">*</span>
                        </label>

                        <select
                            id="update_course_id"
                            name="course_id"
                            class="form-control mt-2 px-3"
                            style="width: 100%;">

                            <option value="">Select Course</option>

                        </select>
                    </div>
                </div>

            </div>

            <x-slot name="modal_footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button
                    type="submit"
                    class="btn btn-danger">
                    Save Changes
                </button>

            </form>

            </x-slot>

    </x-modal-component>

@endsection


<script>
    function printEnrollment() {
        var d = document.getElementById('print_date');

        if (d) {
            d.textContent = 'Date: ' + new Date().toLocaleDateString('en-GB');
        }

        window.print();
    }
</script>

<style>
    @media print {

        @page {
            size: A4;
            margin: 15mm;
        }

        body * {
            visibility: hidden;
        }

        #enrollment_print_area,
        #enrollment_print_area * {
            visibility: visible;
        }

        #enrollment_view_model {
            display: block !important;
            position: absolute;
            inset: 0;
            background: #fff;
        }

        #enrollment_view_model .modal-dialog {
            max-width: 100% !important;
            margin: 0 !important;
            transform: none !important;
        }

        #enrollment_print_area {
            border: none !important;
            box-shadow: none !important;
        }

        .no-print,
        .btn-close {
            display: none !important;
        }

        .print-letterhead {
            display: block !important;
        }

        .user_model_pic_1 {
            width: 110px !important;
            height: 110px !important;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #000;
        }

        .institute_logo {
            width: 50px !important;
            height: 50px !important;
            object-fit: contain;
        }

        table {
            page-break-inside: avoid;
        }

        .table-dark th {
            background-color: #d9d9d9 !important;
            color: #000 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>