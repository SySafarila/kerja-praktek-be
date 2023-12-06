<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\gallery;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';
    protected $guarded = ['id'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
