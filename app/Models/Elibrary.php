<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elibrary extends Model
{
    use HasFactory;

    protected $table = 'elibrary';
    protected $guarded = ['id'];

}
