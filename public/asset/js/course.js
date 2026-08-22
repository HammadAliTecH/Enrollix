document.addEventListener('DOMContentLoaded', function () {

    // ADD COURSE SELECT2
    $('#add_user_select').select2({
        placeholder: 'Type user name...',

        ajax: {
            url: '/users/search',
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


    // EDIT COURSE BUTTON
    document.querySelectorAll('.edit_course').forEach(button => {

        button.addEventListener('click', function () {

            const courseId = this.dataset.id;
            const course_filter_data = JSON.parse(this.dataset.course);

            document.getElementById('course_image').src =
                '/storage/' + course_filter_data.cover_image;

            document.getElementById('course_name').value =
                course_filter_data.name;

            document.getElementById('course_fee').value =
                course_filter_data.fee;

            document.getElementById('course_duration').value =
                course_filter_data.duration;

            document.getElementById('course_payment_type').value =
                course_filter_data.payment_type;

            document.getElementById('course_installments').value =
                course_filter_data.total_installments;


            // FORM ACTION
            document.getElementById('courseUpdateForm').action =
                `/course/${courseId}`;


            // EXISTING USER
            let userSelect = $('#update_user_select');

            userSelect.empty();

            let option = new Option(
                course_filter_data.user.name,
                course_filter_data.user.id,
                true,
                true
            );

            userSelect.append(option);

        });
    });


    // ----------------------------------------------------------------------
    // DELETING COURSE
    //for deleting role name
    document.querySelectorAll('.delete_course').forEach(button => {

        button.addEventListener('click', function () {

            const courseId = this.dataset.id;            // data-id attribute se

            // Agar form action bhi set karni ho (route model binding ke liye)
            const form = document.getElementById('courseDeleteForm');

            form.action = `/course/${courseId}`; // ya route() se banaya hua base URL + id

        });

    });


    // ----------------------------------------------------------------
    // set model for see course indiviual
    document.querySelectorAll('.view_course').forEach(button => {

        button.addEventListener('click', function () {

            const courseData = this.dataset.course;   // data-course attribute se


            const  course_filter_data = JSON.parse(courseData);

            console.log(course_filter_data);

            // Input fields mein value set karo
            document.getElementById('set_course_image').src = '/storage/' + course_filter_data.cover_image;

            document.getElementById('set_course_name').innerText = course_filter_data.name;

            document.getElementById('set_course_instructor').innerText = course_filter_data.user.name;

            document.getElementById('set_course_duration').innerText = course_filter_data.duration;

            document.getElementById('set_course_payment_type').innerText = course_filter_data.payment_type;

            document.getElementById('set_course_installments').innerText = course_filter_data.total_installments;

            // Agar form action bhi set karni ho (route model binding ke liye)
            const form = document.getElementById('userUpdateForm');

            form.action = `/user/${userId}`; // ya route() se banaya hua base URL + id

        });

    });


    // ------------------------------------------------
    // INITIALIZE SELECT2 WHEN MODAL IS ACTUALLY OPEN
    // ------------------------------------------------

    $('#course_update_model').on('shown.bs.modal', function () {

        if (!$('#update_user_select').hasClass('select2-hidden-accessible')) {

            $('#update_user_select').select2({

                dropdownParent: $('#course_update_model'),

                width: '100%',

                placeholder: 'Type user name...',
                allowClear: true,

                ajax: {
                    url: '/users/search',
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

        }

    });

});