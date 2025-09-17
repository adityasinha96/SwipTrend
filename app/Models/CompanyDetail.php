<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDetail extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'company_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_name',
        'gst_number',
        'company_phone_number',
        'other_phone_number',
        'google_map_link',
        'email',
        'other_email',
        'office_address',
        'company_facebook_link',
        'comapnay_instagram_link',
        'company_linkedin_link',
        'company_youtube_link',
        'company_x_link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
