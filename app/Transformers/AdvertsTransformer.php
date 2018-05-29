<?php

namespace App\Transformers;

use App\Entities\Advert;
use App\Http\Transformers\UserTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

/**
 * Class AdvertsTransformer
 * @package App\Transformers
 */
class AdvertsTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'category',
        'user'
    ];

    /**
     * @param Advert $advert
     *
     * @return array
     */
    public function transform(Advert $advert)
    {
        return [
            'id'          => $advert->getKey(),
            'title'       => $advert->getAttribute('title'),
            'description' => $advert->getAttribute('description'),
            'author'      => $advert->getAttribute('author'),
            'price'       => $advert->getAttribute('price'),
            'phone'       => $advert->getAttribute('phone'),
            'location'    => $advert->getAttribute('location'),
            'category_id' => $advert->getAttribute('category_id'),
            'user_id'     => $advert->getAttribute('user_id'),
            'is_favorite' => $advert->isFavorite(),
            'image'       => $advert->getAttribute('image') ? '/uploads/' . $advert->getAttribute('image') : null,
            'status'      => $advert->getAttribute('status')
        ];
    }

    /**
     * @param Advert $advert
     *
     * @return \League\Fractal\Resource\NullResource|Primitive
     */
    public function includeCategory(Advert $advert)
    {
        if (!$advert->category) {
            return $this->null();
        }

        return $this->primitive($advert->category, new CategoryTransformer);
    }

    /**
     * @param Advert $advert
     *
     * @return \League\Fractal\Resource\NullResource|Primitive
     */
    public function includeUser(Advert $advert)
    {
        if (!$advert->user) {
            return $this->null();
        }

        return $this->primitive($advert->user, new UserTransformer);
    }
}
