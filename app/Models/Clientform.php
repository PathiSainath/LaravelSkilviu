<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Clientform extends Model
{
    // Use correct table name from migration
    protected $table = 'clientforms';

    // Use default 'id' primary key (as created in migration)
    protected $primaryKey = 'id'; // or just remove this line completely

    public $timestamps = true;

    protected $fillable = [
        'company_name',
        'website',
        'email',
        'phone',
        'location',
        'company_logo',
        'gst_number',
        'sla_document',
        'contact_name',
        'designation',
        'contact_email',
        'contact_phone',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getCompanyLogoAttribute($value): ?string
    {
        return $value ? Storage::url($value) : null;
    }

    public function getSlaDocumentAttribute($value): ?string
    {
        return $value ? Storage::url($value) : null;
    }
}
