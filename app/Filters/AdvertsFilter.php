<?php
namespace App\Filters;

use Cerbero\QueryFilters\QueryFilters;

/**
 * Class AdvertsFilter
 * @package App\Filters
 */
class AdvertsFilter extends QueryFilters
{
    /**
     * @var array
     */
    protected $implicitFilters = [
        'search'
    ];

    /**
     * Search
     * @param $string
     */
    public function search($string)
    {
        $this->query->where(function($q) use($string) {
            $q->where('title', 'LIKE', '%' . $string . '%');
            $q->orWhere('description', 'LIKE', '%' . $string . '%');
            $q->orWhere('author', 'LIKE', '%' . $string . '%');
        });
    }
}