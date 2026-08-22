@extends('layout.app')

@section('content')
 <div class="row g-0">
                    <div class="col-lg-12 g-0 px-3 pt-2">
<div class="card w-100   ">
  <div class="card-body ">
    <div class="card-title">
        <div class="d-flex justify-content-between" >
            <div><h3>Fee Book</h3></div>
            <div class="d-flex justify-content-end" >
                <input type="text" name="user_email" id="user_email" class="form-control " placeholder="Search By cnic">    
            </div>
        </div>
        
    </div>
      <div class="table-responsive fee-book-table-wrapper">
       <table class="table table-bordered mt-3 fee-book-table">
  <thead class="table-dark" >
    <tr>
      <th scope="col">id</th>
      <th scope="col" class="student-name-column">Student Name</th>
      <th scope="col" class="student-id-column">Student ID</th>
      <th scope="col" class="course-name-column">Course Name</th>
      <th scope="col" >Total Amount</th>
      <th scope="col" >Payment Plan</th>
      <th scope="col" >Installments</th>
      <th scope="col" >Amount Per Installment</th>
      <th scope="col" >Status</th>
      <th scope="col" >End Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($student_courses as $student_course)
          <tr>
      <th scope="row">{{ $student_course->id }}</th>
      <td>{{ $student_course->student->name }}</td>
      <td>{{ $student_course->student->id }}</td>
      <td>{{ $student_course->course->name }}</td>
      <td>{{ $student_course->course->fee }}</td>
      <td><div class="badge bg-success text-white" >{{ $student_course->payment_plan }}</div></td>
      <td>{{ $student_course->course->total_installments }}</td>
      <td>{{ $student_course->fee_per_installment }}</td>
    <td><div class="badge bg-danger badge_blink ">{{ $student_course->status }}</div></td>
     <td>{{ $student_course->due_date }}</td>
       <td><button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#enrollment_view_model" title="View Enrollment Document"><i class="ri-information-line"></i></button>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#payment_details_model" title="View Enrollment Document"><i class="ri-signal-tower-line"></i>
</button>
        </td>
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

<style>
  .fee-book-table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .fee-book-table {
    min-width: 1150px;
    table-layout: auto;
  }

  .fee-book-table th,
  .fee-book-table td {
    vertical-align: middle;
    white-space: nowrap;
  }

  .fee-book-table .student-name-column,
  .fee-book-table td:nth-child(2) {
    min-width: 170px;
    white-space: normal;
  }

  .fee-book-table .course-name-column,
  .fee-book-table td:nth-child(4) {
    min-width: 210px;
    white-space: normal;
  }

  .fee-book-table th:last-child,
  .fee-book-table td:last-child {
    min-width: 120px;
  }

  @media (max-width: 576px) {
    .fee-book-table {
      min-width: 1050px;
    }

    .fee-book-table th,
    .fee-book-table td {
      padding: 0.65rem 0.75rem;
    }
  }
</style>