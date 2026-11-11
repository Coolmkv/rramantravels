<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ActivitiesModel extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = 'id';

    const ID = 'id';
    const ACTIVITY_NAME = 'activity_name';
    const ACTIVITY_IMAGE = 'activity_image';
    const ACTIVITY_DETAILS = 'activity_details';
    const STATUS = 'status';
    const SLUG = 'slug';


    protected $fillable = [
        'activity_name',
        'activity_image',
        'activity_details',
        'meta_keyword',
        'meta_title',
        'meta_description',
        'position',
        'status', 
         'slug',
    ];

    protected $casts = [
        'activity_image' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($activity) {
            if (empty($activity->slug) && !empty($activity->activity_name)) {
                $activity->slug = Str::slug($activity->activity_name);
            }
        });
    }
}
