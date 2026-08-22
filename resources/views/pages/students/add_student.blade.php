@extends('layout.app')

@section('content')

    <!-- CONTENT AREA -->
    <div class="row g-0">
        <div class="col-lg-12 g-0 d-flex pe-3">
            <div class="card w-100 mt-2 ms-3" style="height: 750px; overflow-x: auto;">
                <div class="card-body">
                    <div class="card-title">
                        <h3>ADD STUDENTS</h3>
                    </div>
<form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
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

                    <div class="card">
                        <div class="card-body w-100 px-0 pt-0">
                            <div class="card-title bg-dark w-100 mt-0 rounded-top">
                                <h5 class="text-light ms-4 py-2">Personal Information</h5>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-3 w-50">
                                    <label for="user_name">
                                        Enter Name <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="name"
                                           id="user_name"
                                           value="{{ old('name') }}"
                                           placeholder="Set course name">
                                </div>

                                <div class="form-label mt-4 w-50 ms-3">
                                    <label for="user_name">
                                        Gender <span class="text-danger">*</span>
                                    </label>
                                    <select name="gender" id="" class="form-select">
                                        <option value="">---------</option>
                                        <option value="MALE" {{ old('gender') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                        <option value="FEMALE" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                    </select>
                                </div>

                                <div class="form-label mt-3 w-50 ms-3">
                                    <label for="user_email">
                                        Age <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="age"
                                           id="user_email"
                                           value="{{ old('age') }}"
                                           placeholder="Enter Age">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-3 w-50">
                                    <label for="user_name">
                                        CNIC<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="cnic_number"
                                           id="user_name"
                                           value="{{ old('cnic_number') }}"
                                           placeholder="Enter CNIC">
                                </div>

                                <div class="d-flex ms-3 w-50">
                                    <div class="form-label mt-3">
                                        <label for="user_name">
                                            Attach CNIC<span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control mt-2"
                                               type="file"
                                               name="cnic_document"
                                               id="user_name"
                                               placeholder="Attach CNIC">
                                    </div>
                                </div>

                                <div class="form-label mt-3 w-50 ms-3">
                                    <label for="user_name">
                                        Image<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="file"
                                           name="image"
                                           id="user_name"
                                           placeholder="Attach Image">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-3 w-50">
                                    <label for="user_name">
                                        Father Name<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="father_name"
                                           id="user_name"
                                           value="{{ old('father_name') }}"
                                           placeholder="Enter Father's Name">
                                </div>

                                <div class="form-label mt-3 w-50 ms-3">
                                    <label for="user_name">
                                        Father CNIC<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="father_cnic"
                                           id="user_name"
                                           value="{{ old('father_cnic') }}"
                                           placeholder="Enter Father's CNIC">
                                </div>

                                <div class="form-label mt-3 w-50 ms-3">
                                    <label for="user_name">
                                        Father Occupation<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="father_occupation"
                                           id="user_name"
                                           value="{{ old('father_occupation') }}"
                                           placeholder="Enter Father's Occupation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body w-100 px-0 pt-0">
                            <div class="card-title bg-dark w-100 mt-0 rounded-top">
                                <h5 class="text-light ms-4 py-2">Contact Information</h5>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-3 w-50">
                                    <label for="user_name">
                                        Enter Phone No <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="contact_number"
                                           id="user_name"
                                           value="{{ old('contact_number') }}"
                                           placeholder="Enter Contact Number">
                                </div>

                                <div class="form-label mt-3 ms-3 w-50">
                                    <label for="user_name">
                                        Enter Father/Sibling Cell No <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="father_cell_number"
                                           id="user_name"
                                           value="{{ old('father_cell_number') }}"
                                           placeholder="Enter Father/Sibling Cell Number">
                                </div>

                                <div class="form-label mt-3 w-50 ms-3">
                                    <label for="user_email">
                                        Email Adress<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="email"
                                           name="email"
                                           id="user_email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter Email Address">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="mb-3 w-100">
                                    <label for="description" class="form-label">
                                        Address <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control"
                                              id="description"
                                              name="address"
                                              rows="4">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body w-100 px-0 pt-0">
                            <div class="card-title bg-dark w-100 mt-0 rounded-top">
                                <h5 class="text-light ms-4 py-2">Education Detail</h5>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-3 w-50">
                                    <label for="user_name">
                                        Recent Completed Degree <span class="text-danger">*</span>
                                    </label>
                                    <select name="recent_education" id="" class="form-select">
                                        <option value="">---------</option>
                                        <option value="8TH" {{ old('recent_education') == '8TH' ? 'selected' : '' }}>8TH</option>
                                        <option value="MATRIC (PART-I)" {{ old('recent_education') == 'MATRIC (PART-I)' ? 'selected' : '' }}>MATRIC (PART-I)</option>
                                        <option value="MATRIC (PART-II)" {{ old('recent_education') == 'MATRIC (PART-II)' ? 'selected' : '' }}>MATRIC (PART-II)</option>
                                        <option value="INTERMEDIATE (PART-I)" {{ old('recent_education') == 'INTERMEDIATE (PART-I)' ? 'selected' : '' }}>INTERMEDIATE (PART-I)</option>
                                        <option value="INTERMEDIATE (PART-II)" {{ old('recent_education') == 'INTERMEDIATE (PART-II)' ? 'selected' : '' }}>INTERMEDIATE (PART-II)</option>
                                    </select>
                                </div>

                                <div class="form-label mt-2 w-50 ms-3">
                                    <label for="user_name">
                                        Marks/CGPA <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="marks"
                                           id="user_name"
                                           value="{{ old('marks') }}"
                                           placeholder="Obtain/Out_of">
                                </div>

                                <div class="form-label mt-3 ms-3 w-50">
                                    <label for="user_name">
                                        Current Enroll Program <span class="text-danger">*</span>
                                    </label>
                                    <select name="enrolled_program" id="" class="form-select">
                                        <option value="">---------</option>
                                        <option value="8TH" {{ old('enrolled_program') == '8TH' ? 'selected' : '' }}>8TH</option>
                                        <option value="MATRIC (PART-I)" {{ old('enrolled_program') == 'MATRIC (PART-I)' ? 'selected' : '' }}>MATRIC (PART-I)</option>
                                        <option value="MATRIC (PART-II)" {{ old('enrolled_program') == 'MATRIC (PART-II)' ? 'selected' : '' }}>MATRIC (PART-II)</option>
                                        <option value="INTERMEDIATE (PART-I)" {{ old('enrolled_program') == 'INTERMEDIATE (PART-I)' ? 'selected' : '' }}>INTERMEDIATE (PART-I)</option>
                                        <option value="INTERMEDIATE (PART-II)" {{ old('enrolled_program') == 'INTERMEDIATE (PART-II)' ? 'selected' : '' }}>INTERMEDIATE (PART-II)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-3">
                                <div class="form-label mt-2 w-50">
                                    <label for="user_name">
                                        College/University Name <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control mt-2"
                                           type="text"
                                           name="educational_place"
                                           id="user_name"
                                           value="{{ old('educational_place') }}"
                                           placeholder="Enter College/University Name">
                                </div>

                                <div class="form-label mt-2 w-50 ms-3">
                                    <label for="user_name">
                                        Additional Documents (If_Required)
                                    </label>
                                    <input class="form-control mt-2"
                                           type="file"
                                           name="additional_document"
                                           id="user_name"
                                           placeholder="Upload Documents">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="form-control bg-primary text-light" type="submit" >SAVE</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>

@endsection