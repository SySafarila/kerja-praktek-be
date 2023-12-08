<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function student() {
        return $this->belongsTo(Student::class);
    }
}
