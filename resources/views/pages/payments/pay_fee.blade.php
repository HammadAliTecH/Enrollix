@extends('layout.app')

@section('content')
<!-- CONTENT AREA -->
<div class="row g-0">
    <div class="col-lg-12 g-0 px-3 pt-2">

<div class="card w-100">
  <div class="card-body">

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
    <div class="card-title"><h3>Pay Fee</h3></div>

    <!-- SEARCH BY CNIC -->
    <div class="d-flex justify-content-center mt-3 gap-2">
        <input type="text" name="cnic_search" id="cnic_search" class="form-control w-25" placeholder="Search By CNIC">
        <button type="button" id="btn_cnic_search" class="btn btn-primary">
            <i class="ri-search-line me-1"></i>
            Search
        </button>
    </div>

    <!-- RESULT AREA -->
    <div id="pay_fee_result_area" class="mt-4">
        <!-- JS yahan student summary + installments inject karega -->
    </div>

  </div>
</div>

    </div>
</div>

<!-- PAY FFEE MODAL -->
    {{-- VIEW COURSE MODAL --}}

    <x-modal-component
    modal_id="confirm_payment_model"
    modal_title="PAY FEE"
>
    <div class="modal-body">
        <form action="{{ route('payment_plan.confirm_payment') }}" method="post">
            @csrf

            <b class="d-flex justify-content-center text-center mb-3">
                Have you received this payment? Once confirmed, this installment will be marked as Paid.
            </b>

            <div class="mb-3">
                <label for="payment_mode" class="form-label">
                    Payment Mode
                </label>

                <input type="hidden" id="hidden_payment_plan_id" name="payment_plan_id">

                <select name="payment_mode"
                        id="payment_mode"
                        class="form-select"
                        required>

                    <option value="" selected disabled>
                        Select Payment Mode
                    </option>

                    <option value="bank">
                        Bank
                    </option>

                    <option value="cash">
                        Cash
                    </option>

                </select>
            </div>

        </div>

        <x-slot name="modal_footer">
            <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                Cancel
            </button>

            <button type="submit"
                    class="btn btn-success"
                    data-bs-dismiss="modal">
                Ok, Payment Received
            </button>
            </form>
        </x-slot>

    </x-modal-component>



@endsection