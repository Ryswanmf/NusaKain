<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image',
        'bio',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'order' => 'integer',
    ];
}
