@extends('layout.app')
@section('content')

     <!-- CONTENT AREA -->
                <div class="row g-0"   >
                    <div class="col-lg-12 g-0 d-flex "  >
<div class="card w-100  mt-3 ms-3" style="overflow-y: auto" >
  <div class="card-body " >
    <div class="card-title"><h3>ADD USERS</h3></div>
  <form action="{{route('user.store')}}" method="post"   enctype="multipart/form-data" >
    @csrf
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
     @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center" >
    <div class="form-label mt-3 w-50">
      <label for="user_name">
    Enter Name <span class="text-danger">*</span>
</label>
<input class="form-control mt-2"
       type="text"
       name="name"
       id="user_name"
       placeholder="Set role name">

    </div>
    <div class="form-label mt-3 w-50 ms-3 ">
       <label for="user_email">
    Enter Email <span class="text-danger">*</span>
</label>
<input class="form-control mt-2"
       type="text"
       name="email"
       id="user_email"
       placeholder="Set email">
    </div>
    </div>


      <div class="d-flex justify-content-center" >
    <div class="form-label mt-3 w-50">
       <label for="password">
    Enter Password <span class="text-danger">*</span>
</label>
<input class="form-control mt-2"
       type="text"
       name="password"
       id="user_password"
       placeholder="Set password">
    </div>
    <div class="form-label mt-3 w-50 ms-3 ">
    <label for="user_image">
    Profile Image <span class="text-danger">*</span>
</label>
       <input class="form-control mt-2"
       type="file"
       name="profile_img"
       id="user_image">
    </div>
    </div>

                    <div>
                        <label for="" class="mt-3">
                            Select Roles
                            <span class="text-danger">*</span>
                        </label>

                        <div class="mt-3">

                            <div class="d-flex flex-wrap gap-2">
                             @foreach($roles as $role)

                                <div class="card role_permission_box_size">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   value="{{ $role->id }}"
                                                   name="roles[]"
                                                   id="check1">

                                            <label class="form-check-label" for="check1">
                                                <i class="ri-shield-user-line"></i>
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                                

                                
                            </div>


                        </div>
                    </div>
    <div class="mt-3 d-flex justify-content-center " ><button class="form-control bg-primary text-light w-50" >SAVE</button></div>
  </div>
</div>
</form>

                   </div>
                </div>

@endsection