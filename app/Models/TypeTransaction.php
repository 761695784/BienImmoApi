<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\TypeTransactionFactory> */
    use HasFactory;
    protected $guarded = [];

    public function proprietes() {
        return $this->hasMany(Propriete::class);
    }


}
