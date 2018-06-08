<?php

namespace App\Http\Controllers;

use App\Entities\Advert;
use App\Entities\User;
use App\Filters\AdvertsFilter;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CreateAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use App\Transformers\AdvertsTransformer;
use Illuminate\Validation\UnauthorizedException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

/**
 * Class AdvertsController
 * @package App\Http\Controllers
 */
class AdvertsController extends ApiController
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
        $this->middleware('auth:api', ['only' => ['create', 'update', 'favorite', 'unfavorite']]);
    }

    /**
     * @param AdvertsFilter $filters
     *
     * @return Fractal
     */
    public function index(AdvertsFilter $filters): Fractal
    {
        $adverts = Advert::active()->filterBy($filters)->orderByDesc('id')->paginate(10);

        return $this->fractal->collection($adverts, new AdvertsTransformer)
                             ->paginateWith(new IlluminatePaginatorAdapter($adverts));
    }

    /**
     * @param $id
     *
     * @return Fractal
     */
    public function advert($id): Fractal
    {
        /** @var Advert $advert */
        $advert = Advert::findOrFail($id);

        return $this->fractal->item($advert, new AdvertsTransformer);
    }

    /**
     * @param CreateAdvertRequest $request
     *
     * @return Fractal
     */
    public function create(CreateAdvertRequest $request): Fractal
    {
        $advert = new Advert;
        $advert->setAttribute('user_id', $request->user()->getKey());
        $advert->fill($request->except(['image']));

        $advert->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = $advert->getKey() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $advert->setAttribute('image', $filename);
            $advert->save();
        }

        return $this->fractal->item($advert, new AdvertsTransformer);
    }

    /**
     * @param UpdateAdvertRequest $request
     * @param                     $id
     *
     * @return Fractal
     */
    public function update(UpdateAdvertRequest $request, $id): Fractal
    {
        /** @var Advert $advert */
        $advert = Advert::findOrFail($id);

        if (!$request->user()->isAdmin() && $advert->getAttribute('user_id') !== $request->user()->getAttribute('id')) {
            throw new UnauthorizedException;
        }

        $advert->fill($request->except(['image']));

        $advert->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = $advert->getKey() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $advert->setAttribute('image', $filename);
            $advert->save();
        }

        return $this->fractal->item($advert, new AdvertsTransformer);
    }

    /**
     * @param $id
     *
     * @return Fractal
     */
    public function favorite($id): Fractal
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Advert $advert */
        $advert = Advert::findOrFail($id);

        if ($user->favorites()->where('advert_id', $id)->count() === 0) {
            $user->favorites()->attach($advert);
        }

        return $this->fractal->item($advert, new AdvertsTransformer);
    }

    /**
     * @param $id
     *
     * @return Fractal
     */
    public function unfavorite($id): Fractal
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Advert $advert */
        $advert = Advert::findOrFail($id);

        $user->favorites()->detach($advert);

        return $this->fractal->item($advert, new AdvertsTransformer);
    }
}
