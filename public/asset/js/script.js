document.addEventListener('DOMContentLoaded' , function(){


    // for setting of permissions to roles
    document.querySelectorAll('.assign-permissions').forEach(button => {

    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('role_id').value = id;
        //GET PERMISSIONS
       const permissions_1 = JSON.parse(this.dataset.permissions);
       //FETCH JUST ID's OF PERMISSIONS FROM DATA
       let assign_ids = permissions_1.map(p => p.pivot.permission_id);
       //FIRST UNCHECKED ALL CHECK BOXES
       document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
       checkbox.checked = false;

       //THEN CHECK ACCORDING TO ID's
       assign_ids.forEach(id => {
      const checkbox = document.querySelector(`.permission-checkbox[value="${id}"]`);
       if (checkbox) {
       checkbox.checked = true;
       }
});
});
    });

});

//for editing role name
document.querySelectorAll('.edit_role_name').forEach(button => {
    button.addEventListener('click', function () {
        const roleName = this.dataset.name;   // data-role-name attribute se
        const roleId = this.dataset.id;            // data-id attribute se
         console.log(roleName);
        // Input fields mein value set karo
        document.getElementById('edit_role_name').value = roleName;
        // Agar form action bhi set karni ho (route model binding ke liye)
        const form = document.getElementById('roleUpdateForm');
        form.action = `/role/${roleId}`; // ya route() se banaya hua base URL + id
    });
});


//for deleting role name
document.querySelectorAll('.delete_role_name').forEach(button => {
    button.addEventListener('click', function () {
        const roleId = this.dataset.id;            // data-id attribute se
        // Agar form action bhi set karni ho (route model binding ke liye)
        const form = document.getElementById('roleDeleteForm');
        form.action = `/role/${roleId}`; // ya route() se banaya hua base URL + id
    });
});

});