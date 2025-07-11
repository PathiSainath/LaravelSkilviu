<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    // Table name (optional if it's the plural of the model name)
    protected $table = 'candidates';

    // Primary key
    protected $primaryKey = 'candidate_id';

    // Mass assignable attributes
    protected $fillable = [
        'job_id',
        'candidate_name',
        'email',
        'mobile_number',
        'current_company',
        'years_experience',
        'relevant_experience',
        'current_ctc',
        'expected_ctc',
        'notice_period',
        'current_location',
        'preferred_location',
        'available_for_interview',
        'resume_path',
        'preferred_company',
        'status',
        'remarks', // ❗️ Removed duplicate
    ];

    /**
     * Get the recruitment/job this candidate is applying to.
     */
    public function recruitment(): BelongsTo
    {
        return $this->belongsTo(Recruitment::class, 'job_id', 'job_id');
    }
}
