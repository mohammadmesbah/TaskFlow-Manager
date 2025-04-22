<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'manager_id'
    ];
    // Department manager (one-to-one)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function users() {
        return $this->belongsToMany(User::class, 'department_user'); // جميع موظفي القسم
    }
    
    public function projects() {
        return $this->hasMany(Project::class); // مشاريع القسم
    }
}
