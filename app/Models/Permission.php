<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";
    protected $fillable = [
        "name",
        "description",


    ];
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'permission_module');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
