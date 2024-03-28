<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;

    use SoftDeletes;
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
