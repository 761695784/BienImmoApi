<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriete extends Model
{
    /** @use HasFactory<\Database\Factories\ProprieteFactory> */
    use HasFactory;

     protected $guarded = [];


     public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function typepropriete() {
        return $this->belongsTo(TypePropriete::class);
    }

    public function typetransaction() {
        return $this->belongsTo(TypeTransaction::class);
    }

    public function images(){
    return $this->hasMany(Image::class);
    }
}
