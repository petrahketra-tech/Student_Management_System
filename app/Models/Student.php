<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'student_number', 'name', 'email', 'phone', 'program'];

    // a student belongs to one user (their login account)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // a student has many registrations
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

    // many-to-many: a student can register for many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_registrations')->withTimestamps();
    }
}
