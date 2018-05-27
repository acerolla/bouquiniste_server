<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Transformers\TokenTransformer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Auth
 */
class LoginController extends ApiController
{
    use AuthenticatesUsers {
        AuthenticatesUsers::login as authenticatesUsersLogin;
    }

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
        $this->middleware('auth:api', ['only' => ['logout']]);
    }

    /**
     * @param UserLoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(UserLoginRequest $request)
    {
        return $this->authenticatesUsersLogin($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return auth()->attempt($request->only(['email', 'password']));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Fractal
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, auth()->user()) ?? redirect()->intended($this->redirectPath());
    }

    /**
     * @param Request $request
     * @param         $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, Authenticatable $user): Fractal
    {
        return $this->fractal->item($user, new TokenTransformer);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();
        return response()->success(trans('auth.user_logged_out'));
    }
}
