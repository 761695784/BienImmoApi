<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    protected $guarded = [];

       public function propriete()
    {
        return $this->belongsTo(Propriete::class);
    }
}
