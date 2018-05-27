<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Category
 * @package App\Entities
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**
     * @param Builder $query
     */
    public function scopeMain(Builder $query)
    {
        $query->where('parent_id', 0);
    }
}
