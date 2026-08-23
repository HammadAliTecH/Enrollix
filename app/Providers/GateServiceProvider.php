<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

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
        // CHECK BEFORE ALL GATES
        Gate::before(function (User $user) {

            if ($user->roles->contains('name', 'super_admin')) {
                return true;
            }

            return null;
        });

        // MANAGE_STUDENT
        Gate::define('manage_students', function (User $user) {

            if ($user->hasPermission('student_managment')) {
                return Response::allow();
            }

            return Response::deny(
                'You do not have permission to manage students.'
            );
        });

        // MANAGE_COURSES
        Gate::define('manage_courses', function (User $user) {

            if ($user->hasPermission('course_managment')) {
                return Response::allow();
            }

            return Response::deny(
                'You do not have permission to manage courses.'
            );
        });

        // MANAGE_PRIVILEGES
        Gate::define('privileges', function (User $user) {

            if ($user->hasPermission('privileges_managment')) {
                return Response::allow();
            }

            return Response::deny(
                'You do not have permission to manage privileges.'
            );
        });

        // MANAGE_FINANCE
        Gate::define('manage_finnace', function (User $user) {

            if ($user->hasPermission('finance_managment')) {
                return Response::allow();
            }

            return Response::deny(
                'You do not have permission to manage finance.'
            );
        });

        // MANAGE_USERS
        Gate::define('manage_users', function (User $user) {

            if ($user->hasPermission('users_managment')) {
                return Response::allow();
            }

            return Response::deny(
                'You do not have permission to manage users.'
            );
        });
    }
}