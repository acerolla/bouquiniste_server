<?php

namespace App\Http\Controllers;

use App\Entities\Advert;
use App\Entities\Category;
use App\Http\Controllers\Api\ApiController;
use App\Transformers\AdvertsTransformer;
use App\Transformers\CategoryTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

/**
 * Class CategoriesController
 * @package App\Http\Controllers
 */
class CategoriesController extends ApiController
{
    /**
     * @var Fractal
     */
    private $fractal;

    /**
     * AdvertsController constructor.
     *
     * @param Fractal $fractal
     */
    public function __construct(Fractal $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @return Fractal
     */
    public function index(): Fractal
    {
        $adverts = Category::main()->get();

        return $this->fractal->collection($adverts, new CategoryTransformer)->parseIncludes(['children']);
    }

    /**
     * @param $id
     *
     * @return Fractal
     */
    public function adverts($id): Fractal
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);

        $categoryIds = [
            $category->getKey()
        ];

        if ($children = $category->children()->pluck('id')) {
            $children->each(function($id) use(&$categoryIds) {
                $categoryIds[] = $id;
            });
        }

        $adverts = Advert::whereIn('category_id', $categoryIds)->active()->orderByDesc('id')->paginate(10);

        return $this->fractal->collection($adverts, new AdvertsTransformer)
                             ->paginateWith(new IlluminatePaginatorAdapter($adverts));
    }
}
