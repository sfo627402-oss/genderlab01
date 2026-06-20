<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code', 'user_id', 'species_id', 'sample_type', 'quantity', 'status', 'is_paid', 'payment_required', 'client_access_granted', 'notes', 'pre_scan_image_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
