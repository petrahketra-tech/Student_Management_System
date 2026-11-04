<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code', 'title', 'description', 'lecturer_id'];

    // a course belongs to one lecturer (a user)
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    // a course has many registrations
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

    // many-to-many: a course has many students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_registrations')->withTimestamps();
    }
}
