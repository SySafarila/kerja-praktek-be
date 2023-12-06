<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $guarded = ['id'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class, 'mentor_id');
    }
}
