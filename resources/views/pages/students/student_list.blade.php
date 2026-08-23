@extends('layout.app')

@section('content')

    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 px-3 pt-2">
            <div class="card page_card w-100">
                <div class="card-body">

                    <div class="card-title mb-0">

                        <div class="d-flex justify-content-between align-items-center page_head">
                            <div>
                                <h3 class="page_title mb-0">Students List</h3>
                                <p class="page_subtitle mb-0">Manage every enrolled student's record</p>
                            </div>

                            <div class="search_wrap">
                                <i class="ri-search-line search_icon"></i>
                                <input type="text"
                                       name="user_email"
                                       id="user_email"
                                       class="form-control search_input"
                                       placeholder="Search by name">
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
                                    {{ session('success') }}

                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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

                    </div>

                    <div>
                        <div class="table_wrap">
                            <div class="table-responsive">
                                <table class="table app_table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Picture</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">CNIC</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Cell Number</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <th scope="row">{{ $student->id }}</th>

                                                <td>
                                                    <img src="{{ asset('students_data/students_profile_images/' . $student->image) }}"
                                                         alt=""
                                                         class="img-fluid img_list_user">
                                                </td>

                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->cnic_number }}</td>
                                                <td>{{ $student->father_name }}</td>
                                                <td>{{ $student->father_cell_number }}</td>

                                                <td>
                                                    <button class="action_btn action_btn_edit edit_student"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#student_update_model"
                                                            data-id="{{ $student->id }}"
                                                            data-student="{{ $student }}"
                                                            title="Edit">
                                                        <i class="ri-edit-line"></i>
                                                    </button>

                                                    <button class="action_btn action_btn_delete delete_student"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#student_delete_model"
                                                            data-id="{{ $student->id }}"
                                                            title="Delete">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>

                                                    <button class="action_btn action_btn_view view_student"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#student_view_model"
                                                            data-student="{{ $student }}"
                                                            title="View">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <nav aria-label="Students pagination">
                                <ul class="pagination app_pagination">
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

    {{-- UPDATE MODAL --}}
    <x-modal-component
        modal_id="student_update_model"
        modal_title="Update Student"
    >

        <form
            id="studentUpdateForm"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf

            @method('PUT')

            <div class="modal-body">

                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img class="user_model_pic rounded-circle border shadow"
                         id="student_attributes"
                         src="../profile-shot-of-a-beautiful-young-brunette-with-wind-swept-hair-against-a-white-backdrop-photo.jpg"
                         alt="">

                    <div class="mt-3">
                        <input type="file"
                               class="form-control"
                               name="image"
                               id="student_image_input">
                    </div>
                </div>

                <div class="row g-3">

                    <!-- Personal Information -->
                    <div class="col-12">
                        <h6 class="modal_section_title">Personal Information</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Name</label>

                        <input type="text"
                               class="form-control"
                               name="name"
                               id="student_name"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>

                        <select class="form-select"
                                name="gender"
                                id="student_gender">
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Age</label>

                        <input type="number"
                               class="form-control"
                               name="age"
                               id="student_age"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CNIC</label>

                        <input type="text"
                               class="form-control"
                               name="cnic_number"
                               id="student_cnic"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Father Name</label>

                        <input type="text"
                               class="form-control"
                               name="father_name"
                               id="student_father_name"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Father CNIC</label>

                        <input type="text"
                               class="form-control"
                               name="father_cnic"
                               id="student_father_cnic"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Father Occupation</label>

                        <input type="text"
                               class="form-control"
                               name="father_occupation"
                               id="student_father_occupation"
                        >
                    </div>

                    <!-- Contact Information -->
                    <div class="col-12 mt-4">
                        <h6 class="modal_section_title">Contact Information</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>

                        <input type="text"
                               class="form-control"
                               name="contact_number"
                               id="student_contact_number"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Father Cell Number</label>

                        <input type="text"
                               class="form-control"
                               name="father_cell_number"
                               id="student_father_cell_number"
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Email Address</label>

                        <input type="email"
                               class="form-control"
                               name="email"
                               id="student_email"
                        >
                    </div>

                    <!-- Educational Information -->
                    <div class="col-12 mt-4">
                        <h6 class="modal_section_title">Educational Information</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Recent Qualification</label>

                        <input type="text"
                               class="form-control"
                               name="recent_education"
                               id="student_recent_qualification"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Marks</label>

                        <input type="text"
                               class="form-control"
                               name="marks"
                               id="student_marks"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Current Enrollment</label>

                        <input type="text"
                               class="form-control"
                               name="enrolled_program"
                               id="student_current_education"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Institute Name</label>

                        <input type="text"
                               class="form-control"
                               name="educational_place"
                               id="student_educational_place"
                        >
                    </div>

                    <!-- Documents -->
                    <div class="col-12 mt-4">
                        <h6 class="modal_section_title">Documents</h6>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Update Picture</label>

                        <input type="file"
                               class="form-control"
                               name="image"
                               id="student_image">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Update CNIC</label>

                        <input type="file"
                               class="form-control"
                               name="cnic_document"
                               id="student_document">
                    </div>

                </div>

            </div>

            <x-slot name="modal_footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>

                <button
                    type="submit"
                    class="btn btn-info"
                >
                    Save Changes
                </button>

            </form>

            </x-slot>

    </x-modal-component>

    {{-- DELETE MODAL --}}

    <x-modal-component
        modal_id="student_delete_model"
        modal_title="Delete Student"
    >

        <form
            id="studentDeleteForm"
            method="post"
        >
            @csrf

            @method('DELETE')

            <div class="modal-body">
                <b class="d-flex justify-content-center">
                    Are you confirm to delete that student?
                </b>
            </div>

            <x-slot name="modal_footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Yes
                </button>

            </form>

            </x-slot>

    </x-modal-component>

    {{-- VIEW MODAL --}}

    <x-modal-component
        modal_id="student_view_model"
        modal_title="View Student"
    >

        <div class="modal-body">

            <div class="d-flex justify-content-center">
                <img class="user_model_pic_1"
                     id="set_student_image"
                     src=""
                     alt="">
            </div>

            <div class="mt-3">

                <table class="table table-bordered view_info_table">

                    <tbody>

                        <!-- Caption 1 -->
                        <tr class="table-dark">
                            <th colspan="2">Personal Information</th>
                        </tr>

                        <tr>
                            <td>Name</td>
                            <td id="set_student_name"></td>
                        </tr>

                        <tr>
                            <td>Gender</td>
                            <td id="set_student_gender"></td>
                        </tr>

                        <tr>
                            <td>Age</td>
                            <td id="set_student_age"></td>
                        </tr>

                        <tr>
                            <td>CNIC</td>
                            <td id="set_student_cnic"></td>
                        </tr>

                        <tr>
                            <td>Father Name</td>
                            <td id="set_student_father_name"></td>
                        </tr>

                        <tr>
                            <td>Father CNIC</td>
                            <td id="set_student_father_cnic"></td>
                        </tr>

                        <tr>
                            <td>Father Occupation</td>
                            <td id="set_student_father_occupation"></td>
                        </tr>

                        <!-- Caption 2 -->
                        <tr class="table-dark">
                            <th colspan="2">Contact Information</th>
                        </tr>

                        <tr>
                            <td>Phone Number</td>
                            <td id="set_student_contact_number"></td>
                        </tr>

                        <tr>
                            <td>Father Cell Number</td>
                            <td id="set_student_father_cell_number"></td>
                        </tr>

                        <tr>
                            <td>Email Address</td>
                            <td id="set_student_email"></td>
                        </tr>

                        <!-- Caption 3 -->
                        <tr class="table-dark">
                            <th colspan="2">Educational Information</th>
                        </tr>

                        <tr>
                            <td>Recent Qualification</td>
                            <td id="set_student_recent_qualification"></td>
                        </tr>

                        <tr>
                            <td>Marks</td>
                            <td id="set_student_marks"></td>
                        </tr>

                        <tr>
                            <td>Current Enrollment</td>
                            <td id="set_student_current_education"></td>
                        </tr>

                        <tr>
                            <td>Institute Name</td>
                            <td id="set_student_educational_place"></td>
                        </tr>

                        <!-- Caption 3 -->
                        <tr class="table-dark">
                            <th colspan="2">Download Files</th>
                        </tr>

                        <tr>
                            <td>Picture</td>

                            <td>
                                <a href="" id="set_student_image_2" download>
                                    <i class="ri-download-line"></i>
                                    DOWNLOAD
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>CNIC</td>

                            <td>
                                <a href="" id="set_student_cnic_document" download>
                                    <i class="ri-download-line"></i>
                                    DOWNLOAD
                                </a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <x-slot name="modal_footer">

        </x-slot>

    </x-modal-component>

@endsection