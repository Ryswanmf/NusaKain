<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    protected $fillable = [
        'site_name',
        'hero_badge',
        'hero_title_primary',
        'hero_title_italic',
        'hero_description',
        'hero_image',
        'hero_button_primary_text',
        'hero_button_primary_url',
        'hero_button_secondary_text',
        'hero_button_secondary_url',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'contact_email',
        'contact_phone',
        'contact_address',
        'contact_instagram',
        'contact_facebook',
        'footer_slogan_1',
        'footer_slogan_2',
        'whatsapp',
        'instagram',
        'facebook',
    ];
}
