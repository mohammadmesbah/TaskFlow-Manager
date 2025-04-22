<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'department_id'
    ];
    public function tasks() {
        return $this->hasMany(Task::class);
    }
    public function department() {
        return $this->belongsTo(Department::class); // المشروع ينتمي لقسم واحد
    }
    
    public function users() {
        return $this->belongsToMany(User::class, 'project_user'); // فريق العمل
    }
}
