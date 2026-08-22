document.addEventListener('DOMContentLoaded', function () {


// EDIT STUDENT BUTTON
document.querySelectorAll('.edit_student').forEach(button => {

    button.addEventListener('click', function () {

        const studentId = this.dataset.id;
        const student_filter_data = JSON.parse(this.dataset.student);

        document.querySelector('.user_model_pic').src =
            '/students_data/students_profile_images/' + student_filter_data.image;

        document.getElementById('student_name').value =
            student_filter_data.name;

        document.getElementById('student_gender').value =
            student_filter_data.gender;

        document.getElementById('student_age').value =
            student_filter_data.age;

        document.getElementById('student_cnic').value =
            student_filter_data.cnic_number;

        document.getElementById('student_father_name').value =
            student_filter_data.father_name;

        document.getElementById('student_father_cnic').value =
            student_filter_data.father_cnic;

        document.getElementById('student_father_occupation').value =
            student_filter_data.father_occupation;

        document.getElementById('student_contact_number').value =
            student_filter_data.contact_number;

        document.getElementById('student_father_cell_number').value =
            student_filter_data.father_cell_number;

        document.getElementById('student_email').value =
            student_filter_data.email;

        document.getElementById('student_current_education').value =
            student_filter_data.enrolled_program;

        document.getElementById('student_recent_qualification').value =
            student_filter_data.recent_education;
        
        document.getElementById('student_marks').value =
            student_filter_data.marks;

        document.getElementById('student_educational_place').value =
            student_filter_data.educational_place;

        // FORM ACTION
        document.getElementById('studentUpdateForm').action =
            `/student/${studentId}`;

    });

});

    // ----------------------------------------------------------------------
    // DELETING STUDENT
    document.querySelectorAll('.delete_student').forEach(button => {

        button.addEventListener('click', function () {

            const studentId = this.dataset.id;            // data-id attribute se

            // Agar form action bhi set karni ho (route model binding ke liye)
            const form = document.getElementById('studentDeleteForm');

            form.action = `/student/${studentId}`; // ya route() se banaya hua base URL + id

        });

    });
// ----------------------------------------------------------------------
    // VIEW STUDENT BUTTON
    document.querySelectorAll('.view_student').forEach(button => {
       
        button.addEventListener('click', function () {  
               const studentData = this.dataset.student;   // data-student attribute se


            const  student_filter_data = JSON.parse(studentData);

            console.log(student_filter_data);

            document.getElementById('set_student_image').src = '/students_data/students_profile_images/' + student_filter_data.image;

            document.getElementById('set_student_name').innerText = student_filter_data.name;

            document.getElementById('set_student_gender').innerText = student_filter_data.gender;

            document.getElementById('set_student_age').innerText = student_filter_data.age;

            document.getElementById('set_student_cnic').innerText = student_filter_data.cnic_number;

            document.getElementById('set_student_father_name').innerText = student_filter_data.father_name;

            document.getElementById('set_student_father_cnic').innerText = student_filter_data.father_cnic;

            document.getElementById('set_student_father_occupation').innerText = student_filter_data.father_occupation;

            document.getElementById('set_student_contact_number').innerText = student_filter_data.contact_number;

            document.getElementById('set_student_father_cell_number').innerText = student_filter_data.father_cell_number;

            document.getElementById('set_student_email').innerText = student_filter_data.email;

            document.getElementById('set_student_current_education').innerText = student_filter_data.enrolled_program;

            document.getElementById('set_student_recent_qualification').innerText = student_filter_data.recent_education;

            document.getElementById('set_student_marks').innerText = student_filter_data.marks;

            document.getElementById('set_student_educational_place').innerText = student_filter_data.educational_place;

            document.getElementById('set_student_image_2').href = '/students_data/students_profile_images/' + student_filter_data.image;

            document.getElementById('set_student_cnic_document').href = '/students_data/students_cnic_documents/' + student_filter_data.cnic_document;
            
        });

    });


// ------------------------------------------------------
// MAKE ENROLLMENTS

// search for student by cnic
 $('#student_id').select2({
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
    $('#course_id').select2({
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

// -------------------------------------------
// ENROLLMENT MODAL OPENING
$('#proceed_btn').click(function () {

    let student_id = $('#student_id').val();
    let course_id = $('#course_id').val();

    $.ajax({

        url: '/fetch-student-course',

        type: "POST",

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        data: {
            student_id: student_id,
            course_id: course_id
        },

        success: function (response) {

            // Controller se data aa gaya

            console.log(response);

            // Modal ke andar data show karo
            $('#stu_name_enroll').text(response.student.name);
            $('#course_name_enroll').text(response.course.name);
            $('#stu_gender_enroll').text(response.student.gender);
            $('#stu_age_enroll').text(response.student.age);
            $('#stu_phone_enroll').text(response.student.contact_number);
            $('#stu_email_enroll').text(response.student.email);
            $('#stu_qualification_enroll').text(response.student.recent_education);
            $('#stu_institute_enroll').text(response.student.educational_place);
            $('#course_id_enroll').text(response.course.id);
            $('#course_duration_enroll').text(response.course.duration);
            $('#instructor_enroll').text(response.course.user_id);
            $('#payment_plan_enroll').text(response.course.payment_type);
            $('#installments_enroll').text(response.course.total_installments);

            $('#course_id_enroll').text(response.course.id);
            $('#course_duration_enroll').text(response.course.duration);
            $('#instructor_enroll').text(response.course.user_id);
            $('#payment_plan_enroll').text(response.course.payment_type);
            $('#installments_enroll').text(response.course.total_installments);

            $('#hidden_student_id').val(response.student.id);
            $('#hidden_course_id').val(response.course.id);

            // Modal open
            $('#show_student_enrollment_modal').modal('show');
        }

    });

});



});