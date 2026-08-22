@extends('layout.app')
@section('content')

    <div class="row g-0">

        <div class="col-lg-12 g-0 px-3 pt-3">

            <div class="card w-100">

                <div class="card-body">

                    <div class="card-title d-flex justify-content-between">

                        <div>
                            <h3>ASSIGN PERMISSIONS</h3>
                        </div>

                        <div>
                            <input type="text"
                                   name=""
                                   id=""
                                   class="form-control"
                                   placeholder="Search By Name">
                        </div>

                    </div>

                    <div>

                        <table class="table table-bordered mt-3">

                            <thead class="table-dark">

                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>

                            </thead>

                            <tbody>
@foreach($roles as $role)

    <tr>

        <th scope="row">{{ $loop->iteration }}</th>

        <td>{{ $role->name }}</td>

        <td>
            <button class="btn btn-outline-primary fs-10 d-block assign-permissions"
                    data-bs-toggle="modal"
                    data-bs-target="#permission_assign_model"
                    data-id="{{ $role->id }}"
                    data-permissions="{{$role->permissions}}"
                    >
                <i class="ri-user-settings-line"></i>
            </button>
        </td>

        <td>{{ $role->created_at->format('d/m/Y') }}</td>

        <td>

            <button class="btn btn-outline-warning edit_role_name "
                    data-bs-toggle="modal"
                    data-bs-target="#permission_update_model"
                     data-name="{{ $role->name }}"
                     data-id="{{ $role->id }}"
                   
                    >
                <i class="ri-edit-line"></i>
            </button>

            <button class="btn btn-outline-danger ms-2 delete_role_name"
                    data-bs-toggle="modal"
                    data-bs-target="#permission_delete_model"
                    data-id="{{ $role->id }}"
                    >
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
                                        <a class="page-link"
                                           href="#"
                                           aria-current="page">
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

    {{-- EDIT ROLE MODAL --}}

    <x-modal-component
        modal_id="permission_update_model"
        modal_title="Edit Role Name"
    >

        <div class="form-label mt-3">
<form id="roleUpdateForm" method="post" >
    @csrf
    @method('PUT')
            <label for="">
                Edit Role
                <span class="text-danger">*</span>
            </label>

            <input class="form-control mt-2 "
                   type="text"
                   name="name"
                   id="edit_role_name">

        </div>
        <x-slot name="modal_footer">

            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Close
            </button>

            <button type="submit"
                    class="btn btn-primary">
                Save Changes
            </button>
</form>
        </x-slot>

    </x-modal-component>

    {{-- EDIT PERMISSION MODAL --}}

    <x-modal-component
        modal_id="permission_assign_model"
        modal_title="Choose Permissions"
    >
    <form action="{{ route('edit_permissions') }}" method="post" >
        @csrf
        <div class="d-flex">

            <div class="card w-50">

                <div class="card-body">

                    <div class="form-check">

                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                               name="permissions[]"
                               id="check1"
                               value="4">

                        <label class="form-check-label" for="check1">

                            <i class="ri-shield-user-line"></i>
                            Manage Access

                        </label>

                    </div>

                </div>

            </div>

            <div class="card w-50 ms-3">

                <div class="card-body">

                    <div class="form-check">

                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                                name="permissions[]"
                               id="check1"
                               value="3">

                        <label class="form-check-label" for="check1">

                            <i class="ri-group-line"></i>
                            Manage Users

                        </label>

                    </div>

                </div>

            </div>

        </div>

        <div class="d-flex mt-3">

            <div class="card w-50">

                <div class="card-body">

                    <div class="form-check">

                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                                name="permissions[]"
                               id="check1"
                               value="2">

                        <label class="form-check-label" for="check1">

                            <i class="ri-book-open-line"></i>
                            Manage Courses

                        </label>

                    </div>

                </div>

            </div>

            <div class="card w-50 ms-3">

                <div class="card-body">

                    <div class="form-check">

                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                                name="permissions[]"
                               id="check1"
                               value="1">

                        <label class="form-check-label" for="check1">

                            <i class="ri-graduation-cap-line"></i>
                            Manage Students

                        </label>

                    </div>

                </div>

            </div>

        </div>

        <div class="d-flex mt-3">

            <div class="card w-50">

                <div class="card-body">

                    <div class="form-check">

                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                                name="permissions[]"
                               id="check1"
                               value="5">

                        <label class="form-check-label" for="check1">

                            <i class="ri-money-dollar-circle-line"></i>
                            Manage Finance

                        </label>

                    </div>

                </div>

            </div>

        </div>
                 <input
                     type="hidden"
                    name="id"
                    id="role_id"
                >
        <x-slot name="modal_footer">

            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Close
            </button>

            <button type="submit"
                    class="btn btn-primary">
                Save Changes
            </button>
</form>
        </x-slot>

    </x-modal-component>

    {{-- DELETE ROLE MODAL --}}

    <x-modal-component
        modal_id="permission_delete_model"
        modal_title="Delete Role Name"
    >

    <form id="roleDeleteForm" method="post" >
    @csrf
    @method('DELETE')
        <div class="modal-body">

            <b class="d-flex justify-content-center">
                Are you confirm to delete that role?
            </b>

        </div>

        <x-slot name="modal_footer">

            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Close
            </button>

            <button type="submit"
                    class="btn btn-danger">
                Yes
            </button>
        </form>
        </x-slot>

    </x-modal-component>

@endsection
