<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password','profile_img'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //RELATIONSHIPS
    public function roles()
    {
        return $this->belongsToMany(Role::class , 'user_role');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function payment_histories()
    {
        return $this->hasMany(Payment_history::class);
    }

    // CUSTOM LOGIC FUNTION TO CHCEK PERMISSION
    public function hasPermission(string $permission) :bool
    {
       return $this->roles
              ->flatMap->permissions
              ->contains('name' , $permission);
    }
}
