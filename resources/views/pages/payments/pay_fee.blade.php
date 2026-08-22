@extends('layout.app')

@section('content')
     <!-- CONTENT AREA -->
                <div class="row g-0">
                    <div class="col-lg-12 g-0 px-3 pt-2">

<div class="card w-100">
  <div class="card-body">

    <div class="card-title"><h3>Pay Fee</h3></div>

    <!-- SEARCH BY CNIC -->
    <div class="d-flex justify-content-center mt-3 gap-2">
        <input type="text" name="cnic_search" id="cnic_search" class="form-control w-25" placeholder="Search By CNIC">
        <button type="button" class="btn btn-primary">
            <i class="ri-search-line me-1"></i>
            Search
        </button>
    </div>

    <!-- STUDENT SUMMARY -->
    <table class="table table-bordered text-center align-middle mt-4 mb-4">
        <thead class="table-dark">
            <tr>
                <th colspan="6" class="text-start ps-5" >Student Details</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-light fw-semibold">
                <td>Name</td>
                <td>CNIC</td>
                <td>Course</td>
                <td>Phone Number</td>
                <td>Total Fee</td>
                <td>Status</td>
            </tr>
            <tr>
                <td>Hammad Ali</td>
                <td>35502-0187428-5</td>
                <td>Laravel Development</td>
                <td>03072555161</td>
                <td>30,000</td>
                <td><div class="badge bg-danger badge_blink">Pending</div></td>
            </tr>
        </tbody>
    </table>

    <!-- INSTALLMENT 1 -->
    <table class="table table-bordered text-center align-middle mt-4 mb-4">
        <thead class="table-dark">
            <tr>
                <th colspan="8">Installment 1</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-light fw-semibold">
                <td>Course</td>
                <td>Plan</td>
                <td>Installments</td>
                <td>Installment No</td>
                <td>Amount</td>
                <td>Due Date</td>
                <td>Start Date</td>
                <td>Action</td>
            </tr>
            <tr>
                <td>Laravel Development</td>
                <td>Installment</td>
                <td>3</td>
                <td>1</td>
                <td>10,000</td>
                <td>30-06-2026</td>
                <td>01-06-2026</td>
                <td>
                    <button type="button"
                            class="btn btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#confirm_payment_model"
                            title="Pay Installment">
                        <i class="ri-bank-card-line"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- INSTALLMENT 2 -->
    <table class="table table-bordered text-center align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th colspan="8">Installment 2</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-light fw-semibold">
                <td>Course</td>
                <td>Plan</td>
                <td>Installments</td>
                <td>Installment No</td>
                <td>Amount</td>
                <td>Due Date</td>
                <td>Start Date</td>
                <td>Action</td>
            </tr>
            <tr>
                <td>Laravel Development</td>
                <td>Installment</td>
                <td>3</td>
                <td>2</td>
                <td>10,000</td>
                <td>31-07-2026</td>
                <td>01-07-2026</td>
                <td>
                    <button type="button"
                            class="btn btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#confirm_payment_model"
                            title="Pay Installment">
                        <i class="ri-bank-card-line"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

  </div>
</div>

                    </div>
                </div>
@endsection