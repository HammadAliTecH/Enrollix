<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
class GateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //CHECK BEFORE ALL GATES
      Gate::before(function(User $user){
        if($user->roles->contains('name','super_admin'))
            {
                return true;
            }
            return null;
      });

      //MANAGE_STUDENT
      Gate::define('manage_students' , function(User $user){
         return   $user->hasPermission('student_managment');
      });

      //MANAGE_COURSES
      Gate::define('manage_courses' , function(User $user){
         return   $user->hasPermission('course_managment');
      });

      //MANAGE_PREVILAGES
       Gate::define('privileges' , function(User $user){
         return   $user->hasPermission('privileges_managment');
      });

      //MANAGE_FINANCE
      Gate::define('manage_finnace' , function(User $user){
         return   $user->hasPermission('finance_managment');
      });

      //MANAGE_USERS
      Gate::define('manage_users' , function(User $user){
         return   $user->hasPermission('users_managment');
      });


    }
}
