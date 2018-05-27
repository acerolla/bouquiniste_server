<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Controllers\Api\ApiController;
use App\Http\Transformers\UserTransformer;
use App\Transformers\AdvertsTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends ApiController
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
        $this->middleware('auth:api')->except(['adverts']);
    }

    /**
     * @return Fractal
     */
    public function user(): Fractal
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->fractal->item($user, new UserTransformer);
    }

    /**
     * @return Fractal
     */
    public function favorites(): Fractal
    {
        /** @var User $user */
        $user = auth()->user();

        $adverts = $user->favorites()->paginate(10);

        return $this->fractal->collection($adverts, new AdvertsTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($adverts));
    }

    /**
     * @return Fractal
     */
    public function adverts($id): Fractal
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $adverts = $user->adverts()->active()->paginate(10);

        return $this->fractal->collection($adverts, new AdvertsTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($adverts));
    }

    /**
     * @param Request $request
     *
     * @return Fractal
     */
    public function update(Request $request): Fractal
    {
        /** @var User $user */
        $user = auth()->user();

        $user->fill($request->only(['name']));

        $user->save();

        return $this->fractal->item($user, new UserTransformer);
    }
}
