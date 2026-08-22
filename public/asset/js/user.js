document.addEventListener('DOMContentLoaded' , function(){

    // for setting of roles to users
    document.querySelectorAll('.assign-roles').forEach(button => {

    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('role_id').value = id;
        //GET PERMISSIONS
       const roles_1 = JSON.parse(this.dataset.roles);
       //FETCH JUST ID's OF PERMISSIONS FROM DATA
       let assign_ids = roles_1.map(p => p.pivot.role_id);
       //FIRST UNCHECKED ALL CHECK BOXES
       document.querySelectorAll('.role-checkbox').forEach(checkbox => {
       checkbox.checked = false;

       //THEN CHECK ACCORDING TO ID's
       assign_ids.forEach(id => {
      const checkbox = document.querySelector(`.role-checkbox[value="${id}"]`);
       if (checkbox) {
       checkbox.checked = true;
       }
});
});
    });

});



// ----------------------------------------------------------------
// set model for update user 
document.querySelectorAll('.edit_user').forEach(button => {
    button.addEventListener('click', function () {
        const userData = this.dataset.user_data;   // data-role-name attribute se
        const userId = this.dataset.id;            // data-id attribute se
         console.log(userId);
           
         const  user_filter_data = JSON.parse(userData);

        // Input fields mein value set karo
        document.getElementById('user_image').src = 'uploads/users/' + user_filter_data.profile_img;
        document.getElementById('user_name').value = user_filter_data.name;
         document.getElementById('user_email').value = user_filter_data.email;
        // Agar form action bhi set karni ho (route model binding ke liye)
        const form = document.getElementById('userUpdateForm');
        form.action = `/user/${userId}`; // ya route() se banaya hua base URL + id
    });
});
// ----------------------------------------------------------------------
// DELETING USER 
//for deleting role name
document.querySelectorAll('.delete_user').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.dataset.id;            // data-id attribute se
        // Agar form action bhi set karni ho (route model binding ke liye)
        const form = document.getElementById('userDeleteForm');
        form.action = `/user/${userId}`; // ya route() se banaya hua base URL + id
    });
});

// ----------------------------------------------------------------
// set model for see user indiviual
document.querySelectorAll('.see_user').forEach(button => {
    button.addEventListener('click', function () {
        const userData = this.dataset.user_data;   // data-role-name attribute se
        const userId = this.dataset.id;            // data-id attribute se
        
           
         const  user_filter_data = JSON.parse(userData);
          console.log(user_filter_data);

        // Input fields mein value set karo
        document.getElementById('set_user_image').src = 'uploads/users/' + user_filter_data.profile_img;
        document.getElementById('set_user_name').innerText = user_filter_data.name;
         document.getElementById('set_user_email').innerText = user_filter_data.email;
        document.getElementById('set_user_date').innerText = user_filter_data.created_at;
        var inner_tags = '' ;
        user_filter_data.roles.forEach(function(each_role){
           inner_tags +=`<span class="badge text-bg-success">${each_role.name}</span>`;
        });
        document.getElementById('set_roles').innerHTML = inner_tags;
        // Agar form action bhi set karni ho (route model binding ke liye)
        const form = document.getElementById('userUpdateForm');
        form.action = `/user/${userId}`; // ya route() se banaya hua base URL + id
    });
});


});