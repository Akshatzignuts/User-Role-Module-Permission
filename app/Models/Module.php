<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = "modules";
    protected $primaryKey = 'code';

    protected $keyType = 'string';
    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active',

    ];
    public function subModules()
    {
        return $this->hasMany(Module::class, 'parent_module_code', 'code');
    }
    
}