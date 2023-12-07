<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    protected $guarded = ['id'];


    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
