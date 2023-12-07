<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table = 'extracurriculars';
    protected $guarded = ['id'];

    public function mentor()
    {
        return $this->belongsTo(Teacher::class, 'mentor_id');
    }
}
