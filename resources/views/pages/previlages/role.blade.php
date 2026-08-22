@extends('layout.app')
@section('content')

    <!-- CONTENT -->
    <div class="row g-0">

        <div class="col-lg-12 g-0">

            <div class="card mt-2  ms-3">

                <div class="card-body">

                    <div class="card-title">
                        <h3>ADD ROLES</h3>
                    </div>

                    <div class="form-label mt-3">
<form action="{{route('role.store')}}" method="post" >
                        <label for="role_name">
                            Enter Role
                            <span class="text-danger">*</span>
                        </label>

                        <input class="form-control mt-2"
                               type="text"
                               name="role_name"
                               id="role_name"
                               placeholder="Set role name">

                    </div>

                    <div>
                        <label for="" class="mt-3">
                            Select Permissions
                            <span class="text-danger">*</span>
                        </label>

                        <div class="mt-3">

                            <div class="d-flex">

                                <div class="card role_permission_box_size">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   id="check1"
                                                   value="4"
                                                   >
                                            <label class="form-check-label" for="check1">
                                                <i class="ri-shield-user-line"></i>
                                                Manage Access
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card role_permission_box_size ms-3">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="check1"
                                                   name="permissions[]"
                                                   value="3"
                                                   >

                                            <label class="form-check-label" for="check1">
                                                <i class="ri-group-line"></i>
                                                Manage Users
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card role_permission_box_size ms-3">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="check1"
                                                   name="permissions[]"
                                                   value="2"
                                                   >

                                            <label class="form-check-label" for="check1">
                                                <i class="ri-book-open-line"></i>
                                                Manage Courses
                                            </label>
                                        </div>
                                    </div>
                                </div>

                              <div class="card role_permission_box_size ms-3">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="check1"
                                                   name="permissions[]"
                                                   value="1"
                                                   >

                                            <label class="form-check-label" for="check1">
                                                <i class="ri-graduation-cap-line"></i>
                                                Manage Students
                                            </label>
                                        </div>
                                    </div>
                                </div>   


                            </div>

                            <div class="d-flex mt-3">

                               

                                <div class="card role_permission_box_size ">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="check1"
                                                   name="permissions[]"
                                                   value="5"
                                                   >

                                            <label class="form-check-label" for="check1">
                                                <i class="ri-money-dollar-circle-line"></i>
                                                Manage Finance
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-center">
                        <button class="form-control bg-primary text-light w-50" type="submit">
                            SAVE
                        </button>
                    </div>
</form>
                </div>
@if(session('success'))
<div class="d-flex justify-content-center" >
    <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
    </div>
@endif
            </div>

        </div>
    </div>

@endsection