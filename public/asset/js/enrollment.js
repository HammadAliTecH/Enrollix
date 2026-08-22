document.addEventListener('DOMContentLoaded', function() {


document.querySelectorAll('.show_enrollment').forEach(button => {
    button.addEventListener('click', function () {
        const enrollmentData = this.dataset.enrollment;   // data-role-name attribute se
        
           
         const  enrollment_filter_data = JSON.parse(enrollmentData);
          console.log(enrollment_filter_data);

        // Input fields mein value set karo
        document.getElementById('enroll_stu_image').src = '/students_data/students_profile_images/' + enrollment_filter_data.student.image;
        document.getElementById('enroll_stu_name').innerText = enrollment_filter_data.student.name;
        document.getElementById('enroll_stu_gender').innerText = enrollment_filter_data.student.gender;
        document.getElementById('enroll_stu_age').innerText = enrollment_filter_data.student.age;
        document.getElementById('enroll_stu_cnic_number').innerText = enrollment_filter_data.student.cnic_number;
        document.getElementById('enroll_stu_father_name').innerText = enrollment_filter_data.student.father_name;
        document.getElementById('enroll_stu_father_cnic').innerText = enrollment_filter_data.student.father_cnic;
        document.getElementById('enroll_stu_father_occupation').innerText = enrollment_filter_data.student.father_occupation;



        document.getElementById('enroll_stu_phone_number').innerText = enrollment_filter_data.student.contact_number;
        document.getElementById('enroll_stu_father_cell_number').innerText = enrollment_filter_data.student.father_cell_number;
        document.getElementById('enroll_stu_email').innerText = enrollment_filter_data.student.email;

       document.getElementById('enroll_stu_current_education').innerText = enrollment_filter_data.student.enrolled_program;
       document.getElementById('enroll_stu_recent_qualification').innerText = enrollment_filter_data.student.recent_education;
       document.getElementById('enroll_stu_marks').innerText = enrollment_filter_data.student.marks;
       document.getElementById('enroll_stu_institute_name').innerText = enrollment_filter_data.student.educational_place;

       document.getElementById('enroll_stu_image_2').href = '/students_data/students_profile_pictures/' + enrollment_filter_data.student.image;
       document.getElementById('enroll_stu_cnic_document').href = '/students_data/students_cnic_documents/' + enrollment_filter_data.student.cnic_document;

        document.getElementById('enroll_course_name').innerText = enrollment_filter_data.course.name;
        document.getElementById('enroll_course_instructor').innerText = enrollment_filter_data.course.user.name;
        document.getElementById('enroll_course_duration').innerHTML = '<span class="badge text-bg-success">'+enrollment_filter_data.course.duration+'</span>';
        document.getElementById('enroll_course_payment_plan').innerText = enrollment_filter_data.course.payment_type;
        document.getElementById('enroll_course_installments').innerText = enrollment_filter_data.course.total_installments;
        
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

            const enrollmentId = this.dataset.id;            // data-id attribute se

            // Agar form action bhi set karni ho (route model binding ke liye)
            const form = document.getElementById('enrollmentDeleteForm');

            form.action = `/student_course/${enrollmentId}`; // ya route() se banaya hua base URL + id

        });

    });
});