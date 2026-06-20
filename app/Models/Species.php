<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'family', 'description', 'primer_set', 'is_local'];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
}
