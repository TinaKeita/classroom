<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    public function isAdmin()
{
    return $this->role === 'admin';
}

public function isTeacher()
{
    return $this->role === 'teacher';
}

public function isStudent()
{
    return $this->role === 'student';
}
//priekš studentiem
public function classrooms()
{
    return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id');
}

public function students()
{
    return $this->belongsToMany(User::class, 'classroom_student', 'classroom_id', 'student_id');
}

protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'avatar' 
];
}
