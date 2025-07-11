<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessTracker extends Model
{
    use HasFactory;

    protected $table = 'process_tracker';

    protected $primaryKey = 'tracker_id';

    protected $fillable = [
        'candidate_id',
        'screening',
        'hr_interview',
        'client_cv_review',
        'client_interview',
        'offer_letter',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'candidate_id');
    }
}
