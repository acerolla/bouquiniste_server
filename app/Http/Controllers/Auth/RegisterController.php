<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Events\Registered;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Transformers\RegisterTransformer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Fractal\Fractal;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Api\Auth
 */
class RegisterController extends ApiController
{
    use RegistersUsers;

    /**
     * @var Fractal
     */
    private $fractal;

    /**
     * LoginController constructor.
     *
     * @param Fractal $fractal
     */
    public function __construct(Fractal $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @param UserRegisterRequest $request
     *
     * @return Fractal
     */
    public function register(UserRegisterRequest $request): Fractal
    {
        if (!$request->filled('password')) {
            $request->merge([
                'password' => str_random(10)
            ]);
        }

        $request->merge([
            'name'     => 'Bouquiniste-' . rand(10000, 99999)
        ]);

        /** @var User $user */
        $user = new User($request->all());
        $user->save();

        event(new Registered($user, $request->password));

        $this->guard()->login($user);

        return $this->fractal->item($user, new RegisterTransformer($request->password));
    }
}
