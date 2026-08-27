document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.show_enrollment').forEach(button => {

        button.addEventListener('click', function () {

            const enrollmentData = this.dataset.enrollment; // data-role-name attribute

            const enrollment_filter_data = JSON.parse(enrollmentData);

            console.log(enrollment_filter_data);

            // Set values in input fields
            document.getElementById('enroll_stu_image').src =
                '/students_data/students_profile_images/' +
                enrollment_filter_data.student.image;

            document.getElementById('enroll_stu_name').innerText =
                enrollment_filter_data.student.name;

            document.getElementById('enroll_stu_gender').innerText =
                enrollment_filter_data.student.gender;

            document.getElementById('enroll_stu_age').innerText =
                enrollment_filter_data.student.age;

            document.getElementById('enroll_stu_cnic_number').innerText =
                enrollment_filter_data.student.cnic_number;

            document.getElementById('enroll_stu_father_name').innerText =
                enrollment_filter_data.student.father_name;

            document.getElementById('enroll_stu_father_cnic').innerText =
                enrollment_filter_data.student.father_cnic;

            document.getElementById('enroll_stu_father_occupation').innerText =
                enrollment_filter_data.student.father_occupation;

            document.getElementById('enroll_stu_phone_number').innerText =
                enrollment_filter_data.student.contact_number;

            document.getElementById('enroll_stu_father_cell_number').innerText =
                enrollment_filter_data.student.father_cell_number;

            document.getElementById('enroll_stu_email').innerText =
                enrollment_filter_data.student.email;

            document.getElementById('enroll_stu_current_education').innerText =
                enrollment_filter_data.student.enrolled_program;

            document.getElementById('enroll_stu_recent_qualification').innerText =
                enrollment_filter_data.student.recent_education;

            document.getElementById('enroll_stu_marks').innerText =
                enrollment_filter_data.student.marks;

            document.getElementById('enroll_stu_institute_name').innerText =
                enrollment_filter_data.student.educational_place;

            document.getElementById('enroll_stu_image_2').href =
                '/students_data/students_profile_pictures/' +
                enrollment_filter_data.student.image;

            document.getElementById('enroll_stu_cnic_document').href =
                '/students_data/students_cnic_documents/' +
                enrollment_filter_data.student.cnic_document;

            document.getElementById('enroll_course_name').innerText =
                enrollment_filter_data.course.name;

            document.getElementById('enroll_course_instructor').innerText =
                enrollment_filter_data.course.user.name;

            document.getElementById('enroll_course_duration').innerHTML =
                '<span class="badge text-bg-success">' +
                enrollment_filter_data.course.duration +
                '</span>';

            document.getElementById('enroll_course_payment_plan').innerText =
                enrollment_filter_data.course.payment_type;

            document.getElementById('enroll_course_installments').innerText =
                enrollment_filter_data.course.total_installments;

        });

    });


    // -----------------------------------------------------------
    document.querySelectorAll('.view_enroll_details').forEach(button => {

        button.addEventListener('click', function () {

            const enrollmentData = this.dataset.enrollment; // data-role-name attribute
            const courseData = this.dataset.course; // data-role-name attribute

            const course_filter_data = JSON.parse(courseData);

            const enrollment_filter_data = JSON.parse(enrollmentData);

            console.log(enrollment_filter_data);

            // Set values in input fields
            document.getElementById('enroll_stu_image').src =
                '/students_data/students_profile_images/' +
                enrollment_filter_data.image;

            document.getElementById('enroll_stu_name').innerText =
                enrollment_filter_data.name;

            document.getElementById('enroll_stu_gender').innerText =
                enrollment_filter_data.gender;

            document.getElementById('enroll_stu_age').innerText =
                enrollment_filter_data.age;

            document.getElementById('enroll_stu_cnic_number').innerText =
                enrollment_filter_data.cnic_number;

            document.getElementById('enroll_stu_father_name').innerText =
                enrollment_filter_data.father_name;

            document.getElementById('enroll_stu_father_cnic').innerText =
                enrollment_filter_data.father_cnic;

            document.getElementById('enroll_stu_father_occupation').innerText =
                enrollment_filter_data.father_occupation;

            document.getElementById('enroll_stu_phone_number').innerText =
                enrollment_filter_data.contact_number;

            document.getElementById('enroll_stu_father_cell_number').innerText =
                enrollment_filter_data.father_cell_number;

            document.getElementById('enroll_stu_email').innerText =
                enrollment_filter_data.email;

            document.getElementById('enroll_stu_current_education').innerText =
                enrollment_filter_data.enrolled_program;

            document.getElementById('enroll_stu_recent_qualification').innerText =
                enrollment_filter_data.recent_education;

            document.getElementById('enroll_stu_marks').innerText =
                enrollment_filter_data.marks;

            document.getElementById('enroll_stu_institute_name').innerText =
                enrollment_filter_data.educational_place;

            document.getElementById('enroll_stu_image_2').href =
                '/students_data/students_profile_pictures/' +
                enrollment_filter_data.image;

            document.getElementById('enroll_stu_cnic_document').href =
                '/students_data/students_cnic_documents/' +
                enrollment_filter_data.cnic_document;

            document.getElementById('enroll_course_name').innerText =
                course_filter_data.name;

            document.getElementById('enroll_course_instructor').innerText =
                course_filter_data.user.name;

            document.getElementById('enroll_course_duration').innerHTML =
                '<span class="badge text-bg-success">' +
                course_filter_data.duration +
                '</span>';

            document.getElementById('enroll_course_payment_plan').innerText =
                course_filter_data.payment_type;

            document.getElementById('enroll_course_installments').innerText =
                course_filter_data.total_installments;

        });

    });


    $('#update_student_id').select2({
        placeholder: 'Type student cnic...',

        ajax: {
            url: '/students/search',
            dataType: 'json',
            delay: 250,

            data: function (params) {
                return {
                    search: params.term
                };
            },

            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });


    // ADD COURSE SELECT2
    $('#update_course_id').select2({
        placeholder: 'Type course name...',

        ajax: {
            url: '/courses/search',
            dataType: 'json',
            delay: 250,

            data: function (params) {
                return {
                    search: params.term
                };
            },

            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });


    // EDIT ENRPOLLMENT BUTTON
    document.querySelectorAll('.edit_enrollment').forEach(button => {

        button.addEventListener('click', function () {

            const enrollmentId = this.dataset.id;

            document.getElementById('enrollmentUpdateForm').action =
                `/student_course/${enrollmentId}`;

        });

    });


    // -----------------------------------------------------------
    // DELETE ENROLLMENT BUTTON
    document.querySelectorAll('.delete_enrollment').forEach(button => {

        button.addEventListener('click', function () {

            const enrollmentId = this.dataset.id; // data-id attribute

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('enrollmentDeleteForm');

            form.action = `/student_course/${enrollmentId}`; // or the base URL + id generated using route()

        });

    });


    // ----------------------------------------------------------------------------------
    $(document).on('click', '.plan_detail_model', function () {

        // Get student_course_id from the button's data-id
        let student_course_id = $(this).data('id');

        // Clear old content so previous data is not displayed
        $('#payment_plan_body_content').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
        `);

        $.ajax({
            url: '/payment_plan/details/' + student_course_id,
            type: "GET", // The route is GET, and the controller also expects GET
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {

                console.log(response);

                let html = '';

                if (response.length === 0) {

                    html = `
                        <div class="alert alert-warning mb-0">
                            No payment plan found for this student.
                        </div>
                    `;

                } else {

                    // Create a table for each installment
                    $.each(response, function (index, plan) {

                        html += `
                            <table class="table table-bordered text-center align-middle mb-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="5">Installment ${index + 1}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-light fw-semibold">
                                        <td>ID</td>
                                        <td>Starting Date</td>
                                        <td>Ending Date</td>
                                        <td>Amount</td>
                                        <td>Status</td>
                                    </tr>
                                    <tr>
                                        <td>${plan.id}</td>
                                        <td>${plan.starting_date}</td>
                                        <td>${plan.due_date}</td>
                                        <td>${plan.fee_per_installment}</td>
                                        <td>
                                            ${plan.status == 'paid'
                                                ? '<i class="ri-checkbox-circle-fill text-success fs-5"></i>'
                                                : '<i class="ri-close-circle-fill text-danger fs-5"></i>'}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        `;

                    });

                }

                $('#payment_plan_body_content').html(html);

            },

            error: function (xhr) {

                console.log(xhr);

                $('#payment_plan_body_content').html(
                    `<div class="alert alert-danger mb-0">DATA NOT LOADED , TRY AGAIN.</div>`
                );

            }
        });

    });


    // -----------------------------------------------------------------------------------------------
    // Search also works with the Enter key
    $(document).ready(function () {

        $('#cnic_search').on('keypress', function (e) {

            if (e.which === 13) {
                $('#btn_cnic_search').click();
            }

        });


        $('#btn_cnic_search').on('click', function () {

            let cnic = $('#cnic_search').val().trim();

            if (cnic === '') {

                $('#pay_fee_result_area').html(
                    `<div class="alert alert-warning">Please enter a CNIC.</div>`
                );

                return;
            }


            $('#pay_fee_result_area').html(`
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            `);


            $.ajax({
                url: '/student/payment-schedule',
                type: "GET",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    cnic_number: cnic
                },

                success: function (response) {

                    console.log(response);

                    if (!response || response.length === 0) {

                        $('#pay_fee_result_area').html(
                            `<div class="alert alert-danger">No student found against this CNIC.</div>`
                        );

                        return;
                    }


                    let html = '';

                    // LEVEL 1: each student
                    $.each(response, function (i, student) {

                        // ---- STUDENT SUMMARY TABLE ----
                        html += `
                            <table class="table table-bordered text-center align-middle mt-4 mb-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="5" class="text-start ps-5">Student Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-light fw-semibold">
                                        <td>Name</td>
                                        <td>CNIC</td>
                                        <td>Phone Number</td>
                                        <td>Email</td>
                                        <td>Gender</td>
                                    </tr>
                                    <tr>
                                        <td>${student.name ?? '-'}</td>
                                        <td>${student.cnic_number ?? '-'}</td>
                                        <td>${student.contact_number ?? '-'}</td>
                                        <td>${student.email ?? '-'}</td>
                                        <td>${student.gender ?? '-'}</td>
                                    </tr>
                                </tbody>
                            </table>
                        `;


                        if (!student.student_courses || student.student_courses.length === 0) {

                            html += `
                                <div class="alert alert-warning mb-4">
                                    No enrolled course found for this student.
                                </div>
                            `;

                            return; // Continue to the next item
                        }


                        // LEVEL 2: each student_course (enrollment)
                        $.each(student.student_courses, function (j, sc) {

                            let course = sc.course ?? null;
                            let paymentPlans = sc.payment_plans ?? [];


                            html += `
                                <table class="table table-bordered text-center align-middle mb-2">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th colspan="4" class="text-start ps-3">
                                                Course: ${course ? course.name : '-'}
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            `;


                            if (paymentPlans.length === 0) {

                                html += `
                                    <div class="alert alert-warning mb-4">
                                        No payment plan found for this course.
                                    </div>
                                `;

                                return; // Continue to the next item
                            }


                            // LEVEL 3: each payment_plan (installment)
                            $.each(paymentPlans, function (k, plan) {

                                html += `
                                    <table class="table table-bordered text-center align-middle mb-4">
                                        <thead class="table-dark">
                                            <tr>
                                                <th colspan="7">Installment ${k + 1}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-light fw-semibold">
                                                <td>Plan Type</td>
                                                <td>Total Installments</td>
                                                <td>Installment No</td>
                                                <td>Amount</td>
                                                <td>Start Date</td>
                                                <td>Due Date</td>
                                                <td>Action</td>
                                            </tr>
                                            <tr>
                                                <td>${plan.plan_name ?? '-'}</td>
                                                <td>${plan.total_installments ?? '-'}</td>
                                                <td>${plan.installment_no ?? (k + 1)}</td>
                                                <td>${plan.fee_per_installment ?? '-'}</td>
                                                <td>${plan.starting_date ?? '-'}</td>
                                                <td>${plan.due_date ?? '-'}</td>
                                                <td>
                                                    ${plan.status == 1
                                                        ? '<span class="text-success fw-semibold">Paid</span>'
                                                        : `<button type="button"
                                                                class="btn btn-outline-success pay_installment_btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirm_payment_model"
                                                                data-id="${plan.id}"
                                                                title="Pay Installment">
                                                                <i class="ri-bank-card-line"></i>
                                                           </button>`}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                `;

                            });

                        });

                    });


                    $('#pay_fee_result_area').html(html);

                },

                error: function (xhr) {

                    console.log(xhr);

                    $('#pay_fee_result_area').html(
                        `<div class="alert alert-danger">Something went wrong. Please try again.</div>`
                    );

                }
            });

        });

    });


    // Because pay_installment_btn is dynamically injected through AJAX,
    // $(document).on() is required — direct .click() will not work

    $(document).on('click', '.pay_installment_btn', function () {

        // Get data-id from the clicked button
        let plan_id = $(this).data('id');

        console.log('Selected Payment Plan ID:', plan_id);

        // Set it in the modal's hidden input
        $('#hidden_payment_plan_id').val(plan_id);

    });

});