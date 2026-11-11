<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DestinationsModel extends Model
{
    use HasFactory;
    protected $table = "destination_master";

    const ID = "id";
    const DESTINATION_NAME = "destination_name";
    const DESTINATION_IMAGE = "destination_image";
    const DESTINATION_DETAILS = "destination_details";
    const META_TITLE = "meta_title";
    const META_KEYWORD = "meta_keyword";
    const META_DESCRIPTION = "meta_description";
    const STATUS = "status";
    const POSITION = "position";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const STATUS_ALIAS = "destination_master.status";
    const ID_ALIAS = "destination_master.id";

    // Add this
    protected $casts = [
        'status' => 'integer',
        'position' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::saving(function ($model) {
            if (empty($model->slug) && !empty($model->package_name)) {
                $model->slug = Str::slug($model->package_name, '-');
            }
            if (empty($model->destination_slug) && !empty($model->destination_name)) {
                $model->destination_slug = Str::slug($model->destination_name, '-');
            }
        });
    }
}
