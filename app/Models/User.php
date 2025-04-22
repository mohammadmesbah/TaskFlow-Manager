<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function managedDepartment()
    {
        return $this->hasOne(Department::class, 'manager_id');
    }

    public function department() {
        return $this->belongsToMany(Department::class,'department_user'); // كل مستخدم ينتمي لعدة أقسام د
    }
    
    public function projects() {
        return $this->belongsToMany(Project::class, 'project_user'); // مشاريع متعددة
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
