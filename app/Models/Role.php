<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
   use HasFactory;

   protected $fillable = [
    'name',
   ];


   public function permissions()
   {
      return $this->belongsToMany(Permission::class,
      'role_permission',   // Pivot table name
        'role_id',           // Foreign key of Role
        'permission_id'      // Foreign key of Permission
      );
   }

   public function users()
   {
    return $this->belongsToMany(User::class , 'user_role');
   }
}
