<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = ['id', 'name', 'display_name'];
    public function permission(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
}
