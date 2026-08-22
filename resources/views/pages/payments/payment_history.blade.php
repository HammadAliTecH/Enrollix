@extends('layout.app')

@section('content')

           <!-- CONTENT AREA -->
                <div class="row g-0">
                    <div class="col-lg-12 g-0 px-3 pt-2">

<div class="card w-100">
  <div class="card-body">

    <div class="card-title">
        <div class="d-flex justify-content-between" >
            <div><h3>Payment History</h3></div>
            <div>
                <div class="d-flex   gap-2">
        <select name="date_filter" id="date_filter" class="form-select">
            <option value="">Filter By Date</option>
            <option value="today">Today</option>
            <option value="this_week">This Week</option>
            <option value="last_week">Last Week</option>
            <option value="this_month">This Month</option>
            <option value="last_month">Last Month</option>
        </select>
        <input type="text" name="history_search" id="history_search" class="form-control " placeholder="Search By CNIC">
        <button type="button" class="btn btn-primary">
            <i class="ri-search-line me-1"></i>
        </button>
    </div>
            </div>
        </div>
    </div>

    

    <table class="table table-bordered mt-3 text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">Plan ID</th>
                <th scope="col">Installment No</th>
                <th scope="col">Pay Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Received By</th>
                <th scope="col">Payment Mode</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PLN-1001</td>
                <td>1 of 3</td>
                <td>10,000</td>
                <td>01-06-2026</td>
                <td>Hammad Ali</td>
                <td><span class="badge text-bg-secondary">Cash</span></td>
                <td>
                    <button type="button"
                            class="btn btn-outline-info"
                            data-bs-toggle="modal"
                            data-bs-target="#payment_history_details_model"
                            title="See Details">
                        <i class="ri-eye-line"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
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


@endsection