@extends('layout.app')

@section('content')

    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 d-flex pe-3">

            <div class="card w-100 mt-2 ms-3">
                <div class="card-body">

                    <div class="card-title">
                        <h3>ADD COURSES</h3>
                    </div>

                    <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

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

                        <div class="d-flex justify-content-center">

                            <div class="form-label mt-3 w-50">
                                <label for="user_name">
                                    Enter Name <span class="text-danger">*</span>
                                </label>

                                <input class="form-control mt-2"
                                       type="text"
                                       name="name"
                                       id="user_name"
                                       placeholder="Set course name">
                            </div>

                            <div class="form-label mt-3 w-50 ms-3">
                                <label for="user_name">
                                    SELECT DURATION <span class="text-danger">*</span>
                                </label>

                                <select name="duration" id="" class="form-select">
                                    <option value="" disabled selected>---------</option>
                                    <option value=" 2-MONTHS ">2-MONTHS</option>
                                    <option value="3-MONTHS">3-MONTH</option>
                                    <option value="6-MONTHS">6-MONTHS</option>
                                    <option value="ONE YEAR">ONE YEAR</option>
                                </select>
                            </div>

                            <div class="form-label mt-3 w-50 ms-3">
                                <label for="user_email">
                                    Enter Fee (PKR) <span class="text-danger">*</span>
                                </label>

                                <input class="form-control mt-2"
                                       type="text"
                                       name="fee"
                                       id="user_email"
                                       placeholder="Set email">
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">

                            <div class="form-label mt-3 w-50">
                                <label for="user_password">
                                    Payment Plan<span class="text-danger">*</span>
                                </label>

                                <select name="payment_type" id="" class="form-select">
                                    <option value="" disabled selected>---------</option>
                                    <option value="ONE TIME">ONE TIME</option>
                                    <option value="INSTALLMENTS">INSTALLMENTS</option>
                                </select>
                            </div>

                            <div class="form-label mt-3 w-50 ms-3">
                                <label for="user_password">
                                    Total Installments<span class="text-danger">*</span>
                                </label>

                                <select name="total_installments" id="" class="form-select">
                                    <option value="" disabled selected>---------</option>
                                    <option value="none">NONE</option>
                                    <option value="1">ONE TIME</option>
                                    <option value="2">TWO TIMES</option>
                                    <option value="3">THREE TIMES</option>
                                    <option value="6">HALF YEAR</option>
                                </select>
                            </div>

                            <div class="form-label mt-3 w-50 ms-3">
                                <label for="user_email">
                                    Choose Instructor <span class="text-danger">*</span>
                                </label>

                                <select id="add_user_select"
                                        name="user_id"
                                        class="form-control mt-2 px-3"
                                        style="width: 100%;">

                                    <option value="">Select User</option>

                                </select>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">

                            <div class="form-label mt-3 w-50">
                                <label for="user_image">
                                    Cover Image <span class="text-danger">*</span>
                                </label>

                                <input class="form-control mt-2"
                                       type="file"
                                       name="cover_image"
                                       id="user_image">
                            </div>

                            <div class="form-label mt-3 w-50 ms-3">
                                <label for="user_image">
                                    Description_PDF <span class="text-danger">*</span>
                                </label>

                                <input class="form-control mt-2"
                                       type="file"
                                       name="pdf_book"
                                       id="user_image">
                            </div>

                            <div class="w-50"></div>

                        </div>

                        <div class="d-flex justify-content-center">

                            <div class="mb-3 w-100">
                                <label for="description" class="form-label">
                                    Description <span class="text-danger">*</span>
                                </label>

                                <textarea class="form-control"
                                          name="description"
                                          id="description"
                                          rows="4"></textarea>
                            </div>

                        </div>

                        <div class="mt-3">
                            <button class="form-control bg-primary text-light" type="submit">
                                SAVE
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection