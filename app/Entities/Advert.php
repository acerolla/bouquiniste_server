<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cerbero\QueryFilters\FiltersRecords;

/**
 * Class Advert
 * @package App\Entities
 */
class Advert extends Model
{
    use FiltersRecords;

    /**
     * @var string
     */
    protected $table = 'adverts';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'author',
        'price',
        'phone',
        'location',
        'image',
        'status',
        'category_id',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     */
    public function scopeActive(Builder $query)
    {
        $query->where('status', 'active');
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        /** @var User $user */
        if (!$user = auth()->user()) {
            return false;
        }

        if (!$user->favorites) {
            return false;
        }

        return $user->favorites->where('id', $this->getKey())->count() > 0;
    }
}
