document.addEventListener('DOMContentLoaded', function () {

    // For assigning roles to users
    document.querySelectorAll('.assign-roles').forEach(button => {

        button.addEventListener('click', function () {

            let id = this.dataset.id;

            document.getElementById('role_id').value = id;

            // GET PERMISSIONS
            const roles_1 = JSON.parse(this.dataset.roles);

            // FETCH JUST IDs OF PERMISSIONS FROM DATA
            let assign_ids = roles_1.map(p => p.pivot.role_id);

            // FIRST UNCHECK ALL CHECKBOXES
            document.querySelectorAll('.role-checkbox').forEach(checkbox => {

                checkbox.checked = false;

                // THEN CHECK ACCORDING TO IDs
                assign_ids.forEach(id => {

                    const checkbox = document.querySelector(
                        `.role-checkbox[value="${id}"]`
                    );

                    if (checkbox) {
                        checkbox.checked = true;
                    }

                });

            });

        });

    });


    // ----------------------------------------------------------------
    // Set modal for updating user
    document.querySelectorAll('.edit_user').forEach(button => {

        button.addEventListener('click', function () {

            const userData = this.dataset.user_data; // data-role-name attribute
            const userId = this.dataset.id; // data-id attribute

            console.log(userId);

            const user_filter_data = JSON.parse(userData);

            // Set values in input fields
            document.getElementById('user_image').src =
                'uploads/users/' + user_filter_data.profile_img;

            document.getElementById('user_name').value =
                user_filter_data.name;

            document.getElementById('user_email').value =
                user_filter_data.email;

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('userUpdateForm');

            form.action = `/user/${userId}`; // or the base URL + id generated using route()

        });

    });


    // ----------------------------------------------------------------------
    // DELETING USER
    // For deleting role name
    document.querySelectorAll('.delete_user').forEach(button => {

        button.addEventListener('click', function () {

            const userId = this.dataset.id; // data-id attribute

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('userDeleteForm');

            form.action = `/user/${userId}`; // or the base URL + id generated using route()

        });

    });


    // ----------------------------------------------------------------
    // Set modal for viewing an individual user
    document.querySelectorAll('.see_user').forEach(button => {

        button.addEventListener('click', function () {

            const userData = this.dataset.user_data; // data-role-name attribute
            const userId = this.dataset.id; // data-id attribute

            const user_filter_data = JSON.parse(userData);

            console.log(user_filter_data);

            // Set values in input fields
            document.getElementById('set_user_image').src =
                'uploads/users/' + user_filter_data.profile_img;

            document.getElementById('set_user_name').innerText =
                user_filter_data.name;

            document.getElementById('set_user_email').innerText =
                user_filter_data.email;

            document.getElementById('set_user_date').innerText =
                user_filter_data.created_at;

            var inner_tags = '';

            user_filter_data.roles.forEach(function (each_role) {

                inner_tags +=
                    `<span class="badge text-bg-success">${each_role.name}</span>`;

            });

            document.getElementById('set_roles').innerHTML = inner_tags;

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('userUpdateForm');

            form.action = `/user/${userId}`; // or the base URL + id generated using route()

        });

    });

});