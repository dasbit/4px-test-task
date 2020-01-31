<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Section extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name' , 'description'];

    /**
     * Users of this section
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Registers media collection
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('logo')
            ->singleFile();
    }

    /**
     * Media convertions defining
     *
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->performOnCollections('logo');
    }

    /**
     * Description with limited symbol count
     *
     * @return string
     */
    public function getDescrAttribute()
    {
        return Str::limit($this->description, 30);
    }
}
