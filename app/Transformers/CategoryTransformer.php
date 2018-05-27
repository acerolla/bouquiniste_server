<?php

namespace App\Transformers;

use App\Entities\Category;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package App\Transformers
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $availableIncludes = [
        'children'
    ];

    /**
     * @param Category $category
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'    => $category->getKey(),
            'title' => $category->getAttribute('title')
        ];
    }

    /**
     * @param Category $category
     *
     * @return Collection|\League\Fractal\Resource\NullResource
     */
    public function includeChildren(Category $category)
    {
        if (!$category->children) {
            return $this->null();
        }

        return $this->collection($category->children, new CategoryTransformer);
    }
}
