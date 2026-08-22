@extends('layout.app')

@section('content')

    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 px-3 pt-2">

            <div class="card w-100">
                <div class="card-body">

                    <div class="card-title">
                        <div class="d-flex justify-content-between" >
                            <div><div><h3>COURSES LIST</h3></div></div>
                            <div>
                                   <input
                            type="text"
                            name="user_email"
                            id="user_email"
                            class="form-control"
                            placeholder="Search By Name"
                        >

                            </div>

                        </div>
                    </div>

                    @if(session('success'))
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
                                {{ session('success') }}

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"
                                ></button>
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

                    
                    <div>
                        <table class="table table-bordered mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Instructor</th>
                                    <th scope="col">Payment Plan</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>
                                            <img
                                                src="{{ asset('storage/' . $course->cover_image) }}"
                                                class="img-fluid img_list_course"
                                            >
                                        </td>

                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->duration }}</td>
                                        <td>{{ $course->user->name }}</td>
                                        <td>{{ $course->payment_type }}</td>

                                        <td>
                                            <button
                                                class="btn btn-outline-warning edit_course"
                                                data-bs-toggle="modal"
                                                data-bs-target="#course_update_model"
                                                data-id="{{ $course->id }}"
                                                data-course="{{ $course }}"
                                                name="update_course"
                                            >
                                                <i class="ri-edit-line"></i>
                                            </button>

                                            <button
                                                class="btn btn-outline-danger ms-2 delete_course"
                                                data-bs-toggle="modal"
                                                data-bs-target="#course_delete_model"
                                                data-id="{{ $course->id }}"
                                            >
                                                <i class="ri-delete-bin-line"></i>
                                            </button>

                                            <button
                                                class="btn btn-outline-success ms-2 view_course"
                                                data-bs-toggle="modal"
                                                data-bs-target="#course_view_model"
                                                data-course="{{ $course }}"
                                            >
                                                <i class="ri-eye-line"></i>
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
                                        <a
                                            class="page-link"
                                            href="#"
                                            aria-current="page"
                                        >
                                            2
                                        </a>
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

    {{-- EDIT COURSE MODAL --}}

    <x-modal-component
        modal_id="course_update_model"
        modal_title="Update Course"
        modal_dialog_class="modal-dialog-scrollable"
    >

        <form id="courseUpdateForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-body">

                <div class="d-flex justify-content-center">
                    <img
                        class="user_model_pic"
                        id="course_image"
                        src="profile-shot-of-a-beautiful-young-brunette-with-wind-swept-hair-against-a-white-backdrop-photo.jpg"
                        alt=""
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Name</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="name"
                        id="course_name"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Fee</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="fee"
                        id="course_fee"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Duration</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="duration"
                        id="course_duration"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Instructor</label>

                    <select
                        id="update_user_select"
                        name="user_id"
                        class="form-control mt-2 px-3"
                        style="width: 100%;"
                    >

                        <option value="">Select User</option>

                    </select>
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Payment Plan</label>

                    <select
                        name="payment_type"
                        id="course_payment_type"
                        class="form-select"
                    >
                        <option value="">---------</option>
                        <option value="ONE TIME">ONE TIME</option>
                        <option value="INSTALLMENTS">INSTALLMENTS</option>
                    </select>
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Installments</label>

                    <select
                        name="total_installments"
                        id="course_installments"
                        class="form-select"
                    >
                        <option value="">---------</option>
                        <option value="none">NONE</option>
                        <option value="per month">PER MONTH</option>
                        <option value="per two months">PER TWO MONTHS</option>
                        <option value="per three months">PER THREE MONTHS</option>
                        <option value="half year">HALF YEAR</option>
                    </select>
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Cover</label>

                    <input
                        class="form-control mt-2"
                        type="file"
                        name="cover_image"
                        id="course_cover"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update PDF</label>

                    <input
                        class="form-control mt-2"
                        type="file"
                        name="pdf_book"
                        id="course_pdf"
                    >
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
                    class="btn btn-danger"
                >
                    Save Changes
                </button>

            </form>

            </x-slot>

    </x-modal-component>

    {{-- DELETE COURSE MODAL --}}

    <x-modal-component
        modal_id="course_delete_model"
        modal_title="Delete Course"
    >

        <form
            id="courseDeleteForm"
            method="post"
        >
            @csrf
            @method('DELETE')

            <div class="modal-body">
                <b class="d-flex justify-content-center">
                    Are you confirm to delete that course?
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

    {{-- VIEW COURSE MODAL --}}

    <x-modal-component
        modal_id="course_view_model"
        modal_title="Course Details"
    >

        <div class="modal-body">

            <div class="d-flex justify-content-center">
                <img
                    class="course_model_pic_1 w-100 rounded-top"
                    id="set_course_image"
                    src=""
                    alt=""
                >
            </div>

            <div class="">
                <table class="table table-bordered table-sm mb-0">
                    <tbody>

                        <tr class="table-dark">
                            <th colspan="2">Course Information</th>
                        </tr>

                        <tr>
                            <th class="w-25">NAME</th>
                            <td id="set_course_name"></td>
                        </tr>

                        <tr>
                            <th>INSTRUCTOR</th>
                            <td id="set_course_instructor"></td>
                        </tr>

                        <tr>
                            <th>DURATION</th>
                            <td id="set_course_duration"></td>
                        </tr>

                        <tr>
                            <th>PAYMENT PLAN</th>
                            <td id="set_course_payment_type"></td>
                        </tr>

                        <tr>
                            <th>INSTALLMENTS</th>
                            <td id="set_course_installments">NONE</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

        <x-slot name="modal_footer">
        </x-slot>

    </x-modal-component>

@endsection