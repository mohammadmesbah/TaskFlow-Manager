<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'project_id',
      
    ];

    protected $casts = [
        'due_date' => 'datetime'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
   
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
