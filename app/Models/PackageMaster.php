<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageMaster extends Model
{
    use HasFactory;

    protected $table = "package_master";

    const TABLE_NAME = "package_master";
    const ID = "id";
    const PACKAGE_NAME = "package_name";
    const PACKAGE_IMAGE = "package_image";
    const PACKAGE_TYPE = "package_type";
    const PACKAGE_COUNTRY = "package_country";
    const PACKAGE_PRICE = "package_price";
    const PACKAGE_OFFER_PRICE = "package_offer_price";
    const PACKAGE_DURATION_DAYS = "package_duration_days";
    const PACKAGE_DURATION_NIGHTS = "package_duration_nights";
    const PACKAGE_EXTERNAL_LINK = "package_external_link";
    const DESCRIPTION = "description";
    const PACKAGE_INCLUDED = "package_included";
    const PACKAGE_EXCLUDED = "package_excluded";
    const ITINERARY_TITLES = "itinerary_titles";
    const ITINERARY_DESCRIPTIONS = "itinerary_descriptions";
    const META_TITLE = "meta_title";
    const META_KEYWORD = "meta_keyword";
    const META_DESCRIPTION = "meta_description";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    // New constants for destinations and activities
    const DESTINATIONS = "destinations";
    const ACTIVITIES = "activities";

    const PACKAGE_TYPES = [
        "Leisure","Adventure","Pilgrimage","Religious"
    ];

    public function itinerary(){
        return $this->hasMany(PackageItinerary::class, PackageItinerary::PACKAGE_MASTER_ID, self::ID)
            ->where(PackageItinerary::STATUS, 1);
    }

    /** Accessors & Mutators **/

    public function getPackageImageAttribute($value){ return json_decode($value, true); }
    public function setPackageImageAttribute($value){ $this->attributes[self::PACKAGE_IMAGE] = json_encode($value); }

    public function getPackageIncludedAttribute($value){ return json_decode($value, true); }
    public function setPackageIncludedAttribute($value){ $this->attributes[self::PACKAGE_INCLUDED] = json_encode($value); }

    public function getPackageExcludedAttribute($value){ return json_decode($value, true); }
    public function setPackageExcludedAttribute($value){ $this->attributes[self::PACKAGE_EXCLUDED] = json_encode($value); }

    public function getItineraryTitlesAttribute($value){ return json_decode($value, true); }
    public function setItineraryTitlesAttribute($value){ $this->attributes[self::ITINERARY_TITLES] = json_encode($value); }

    public function getItineraryDescriptionsAttribute($value){ return json_decode($value, true); }
    public function setItineraryDescriptionsAttribute($value){ $this->attributes[self::ITINERARY_DESCRIPTIONS] = json_encode($value); }

    // New Accessors & Mutators for Destinations
public function getDestinationsAttribute($value)
{
    return $value ? json_decode($value, true) : [];
}    public function setDestinationsAttribute($value){ $this->attributes[self::DESTINATIONS] = json_encode($value); }

    // New Accessors & Mutators for Activities
public function getActivitiesAttribute($value)
{
    return $value ? json_decode($value, true) : [];
}    public function setActivitiesAttribute($value){ $this->attributes[self::ACTIVITIES] = json_encode($value); }

    protected static function boot()
    {
        parent::boot();
    
        static::saving(function ($model) {
            if (empty($model->slug) && !empty($model->package_name)) {
                $model->slug = Str::slug($model->package_name, '-');
            }
            if (empty($model->destination_slug) && !empty($model->package_country)) {
                $model->destination_slug = Str::slug($model->package_country, '-');
            }
        });
    }
}
