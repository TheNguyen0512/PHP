<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Roles::class,'role_users','user_id','role_id');
    }

    public function checkPermissionAccess($permissionCheck){
        $role = auth()->user()->roles;
        foreach ($role as $roleItem){
            $permission = $roleItem->permission;
            if ($permission ->contains('key_code', $permissionCheck)){
                return true;
            }
            return false;
        }
    }
    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

}
