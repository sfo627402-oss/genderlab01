<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'biologist_id', 'sex_result', 'confidence_score', 'quality_check', 'comment', 'gel_image_path', 'pdf_report_path', 'status'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function biologist()
    {
        return $this->belongsTo(User::class, 'biologist_id');
    }
}
