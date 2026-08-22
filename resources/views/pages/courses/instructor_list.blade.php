@extends('layout.app')

@section('content')

                <!-- CONTENT AREA -->
                <div class="row g-0">
                    <div class="col-lg-12 g-0 px-3 pt-2">
<div class="card w-100   ">
  <div class="card-body ">
    <div class="card-title">
      <div class="d-flex justify-content-between" >
        <div><h3>INSTRUCTORS LIST</h3></div>
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
     <div>
        <table class="table table-bordered mt-3">
  <thead class="table-dark" >
    <tr>
      <th scope="col">id</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col" >Course</th>
      <th scope="col" >Portfolio</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($instructors as $instructor)
        
    
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td><img src="{{ asset('uploads/users/' . $instructor->profile_img) }}" alt="" class="img-fluid " style="height: 50px; width: 50px;" ></td>
      <td id="instructor_name" >{{ $instructor->name }}</td>
      <td id="course_name" >{{ $instructor->courses->pluck('name')->implode(', ') ?? 'No Course' }}</td>
      <td><button class="btn btn-info" ><i class="ri-user-line"></i>
</button></td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center" >
    <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item"><a href="#" class="page-link">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active">
      <a class="page-link" href="#" aria-current="page">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
</div>
     </div>
  </div>
</div>


                    </div>
                </div>

@endsection