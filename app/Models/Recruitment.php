<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'recruitment';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'client_name',
        'job_title',
        'min_experience',
        'max_experience',
        'preferred_company',
        'type_of_industry',
        'notice_period',
        'benefit',
        'budget',
        'package',
        'qualification',
        'skills_required',
        'job_location',
        'timings',
        'no_of_positions',
        'working_days',
        'diversity_preference',
        'hiring_type',
        'work_mode',
        'interview_process',
        'key_responsibilities',
        'job_description',
        'jd_document_path'
    ];

    /**
     * Get the client that owns the recruitment.
     */
    public function client()
    {
        return $this->belongsTo(Clientform::class, 'client_id');
    }

    /**
     * Get the user who created the recruitment entry.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
