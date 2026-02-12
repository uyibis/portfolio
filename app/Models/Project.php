<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'link',
        'description',
        'stacks',
        'views',
        'featured_image',
        'images',
        'publish',
    ];

    protected $casts = [
        'publish' => 'boolean',
        'stacks' => 'array',
        'images' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('publish', true);
    }
}
