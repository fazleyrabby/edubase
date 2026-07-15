<?php

namespace App\Modules\Admission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmissionCircular extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'institute_id', 'admission_session_id', 'title',
        'admission_status',
        'application_start_date', 'application_end_date',
        'admission_test_required', 'admission_test_date',
        'interview_required', 'online_application_available', 'application_url',
        'documents_required', 'eligibility_criteria', 'contact_info',
        'is_published', 'published_at',
        'source_url', 'scraper_run_id',
    ];

    protected function casts(): array
    {
        return [
            'application_start_date' => 'date',
            'application_end_date' => 'date',
            'admission_test_date' => 'date',
            'admission_test_required' => 'boolean',
            'interview_required' => 'boolean',
            'online_application_available' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }
}
