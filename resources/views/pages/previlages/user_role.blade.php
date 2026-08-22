@extends('layout.app')

@section('content')

    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 px-3 pt-2">
            <div class="card w-100">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>USERS LIST</h3>
                            </div>

                            <div>
                                <input
                                    type="text"
                                    name="user_email"
                                    id=""
                                    class="form-control"
                                    placeholder="Search By Name"
                                >
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

                        <div>
                            <table class="table table-bordered mt-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>

                                            <td>
                                                <img
                                                    src="{{ asset('uploads/users/' . $user->profile_img) }}"
                                                    alt=""
                                                    class="img-fluid img_list_user"
                                                >
                                            </td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                <button
                                                    class="btn btn-outline-primary fs-10 d-block assign-roles"
                                                    data-bs-toggle="modal"
                                                    data-id="{{ $user->id }}"
                                                    data-roles="{{ $user->roles }}"
                                                    data-bs-target="#user_role_model_assign"
                                                >
                                                    <i class="ri-admin-line"></i>
                                                </button>
                                            </td>

                                            <td>
                                                <button
                                                    class="btn btn-outline-warning edit_user"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#user_update_model"
                                                    data-id="{{ $user->id }}"
                                                    data-user_data="{{ $user }}"
                                                >
                                                    <i class="ri-edit-line"></i>
                                                </button>

                                                <button
                                                    class="btn btn-outline-danger ms-2 delete_user"
                                                    data-bs-toggle="modal"
                                                    data-id="{{ $user->id }}"
                                                    data-bs-target="#user_delete_model"
                                                >
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>

                                                <button
                                                    class="btn btn-outline-success ms-2 see_user"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#user_view_model"
                                                    data-id="{{ $user->id }}"
                                                    data-user_data="{{ $user }}"
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
    </div>

    {{-- USER ROLE SETTING MODAL --}}
    <x-modal-component
        modal_id="user_role_model_assign"
        modal_title="Choose Roles"
    >
        <div class="modal-body">

            <form action="{{ route('edit_roles') }}" method="post">
                @csrf

                <div class="d-flex justify-content-center flex-wrap gap-2 w-100">

                    @foreach($roles as $role)
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="form-check">
                                    <input
                                        class="form-check-input role-checkbox"
                                        type="checkbox"
                                        value="{{ $role->id }}"
                                        name="roles[]"
                                        id="check1"
                                    >

                                    <label class="form-check-label" for="check1">
                                        <i class="ri-shield-user-line"></i>
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
        </div>

        <input type="hidden" name="id" id="role_id">

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
                class="btn btn-primary"
            >
                Save Changes
            </button>
            </form>
        </x-slot>
    </x-modal-component>

    {{-- UPDATE USER MODAL --}}
    <x-modal-component
        modal_id="user_update_model"
        modal_title="Update User"
    >
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <img
                    id="user_image"
                    class="user_model_pic"
                    src=""
                    alt=""
                >
            </div>

            <form
                id="userUpdateForm"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-label mt-3">
                    <label for="">Update Name</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="name"
                        id="user_name"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Email</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="email"
                        id="user_email"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Password</label>

                    <input
                        class="form-control mt-2"
                        type="text"
                        name="password"
                        id="user_password"
                    >
                </div>

                <div class="form-label mt-3">
                    <label for="">Update Image</label>

                    <input
                        class="form-control mt-2"
                        type="file"
                        name="profile_img"
                        id=""
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
                    class="btn btn-primary"
                >
                    Save Changes
                </button>
                </form>
            </x-slot>
    </x-modal-component>

    {{-- VIEW USER MODAL --}}
    <x-modal-component
        modal_id="user_view_model"
        modal_title="User Profile"
    >
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <img
                    class="user_model_pic_1"
                    id="set_user_image"
                    src=""
                    alt=""
                >
            </div>

            <div class="mt-3">
                <div>
                    <h6>NAME:</h6>
                    <span id="set_user_name"></span>
                </div>

                <div class="mt-2">
                    <h6>EMAIL:</h6>
                    <span id="set_user_email"></span>
                </div>

                <div class="mt-2">
                    <h6>ROLES:</h6>
                    <span
                        class="badge text-bg-success"
                        id="set_roles"
                    ></span>
                </div>

                <div class="mt-2">
                    <h6>DATE:</h6>
                    <span id="set_user_date"></span>
                </div>
            </div>
        </div>

        <x-slot name="modal_footer">
        </x-slot>
    </x-modal-component>

    {{-- DELETE USER MODAL --}}
    <x-modal-component
        modal_id="user_delete_model"
        modal_title="Delete User"
    >
        <form
            action=""
            id="userDeleteForm"
            method="post"
        >
            @csrf
            @method('DELETE')

            <div class="modal-body">
                <b class="d-flex justify-content-center">
                    Are you confirm to delete that user?
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

@endsection