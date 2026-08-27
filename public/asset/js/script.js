document.addEventListener('DOMContentLoaded', function () {


    // For assigning permissions to roles
    document.querySelectorAll('.assign-permissions').forEach(button => {

        button.addEventListener('click', function () {

            let id = this.dataset.id;

            document.getElementById('role_id').value = id;

            // GET PERMISSIONS
            const permissions_1 = JSON.parse(this.dataset.permissions);

            // FETCH JUST IDs OF PERMISSIONS FROM DATA
            let assign_ids = permissions_1.map(p => p.pivot.permission_id);

            // FIRST UNCHECK ALL CHECKBOXES
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {

                checkbox.checked = false;

                // THEN CHECK ACCORDING TO IDs
                assign_ids.forEach(id => {

                    const checkbox = document.querySelector(
                        `.permission-checkbox[value="${id}"]`
                    );

                    if (checkbox) {
                        checkbox.checked = true;
                    }

                });

            });

        });

    });


    // For editing role name
    document.querySelectorAll('.edit_role_name').forEach(button => {

        button.addEventListener('click', function () {

            const roleName = this.dataset.name; // data-role-name attribute
            const roleId = this.dataset.id; // data-id attribute

            console.log(roleName);

            // Set value in input fields
            document.getElementById('edit_role_name').value = roleName;

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('roleUpdateForm');

            form.action = `/role/${roleId}`; // or the base URL + id generated using route()

        });

    });


    // For deleting role name
    document.querySelectorAll('.delete_role_name').forEach(button => {

        button.addEventListener('click', function () {

            const roleId = this.dataset.id; // data-id attribute

            // If the form action also needs to be set (for route model binding)
            const form = document.getElementById('roleDeleteForm');

            form.action = `/role/${roleId}`; // or the base URL + id generated using route()

        });

    });

});