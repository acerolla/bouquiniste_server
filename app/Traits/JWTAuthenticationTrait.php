<?php

namespace App\Traits;

use App\Entities\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Trait JWTAuthenticationTrait
 * @package App\Traits
 */
trait JWTAuthenticationTrait
{
    /**
     * @param Request $request
     */
    public function authenticate(Request $request)
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();
            $model = $payload->get('model');

            if ($model == Admin::class) {
                Auth::shouldUse('admin');
            } else {
                Auth::shouldUse('api');
            }

            if (!Auth::check()) {
                throw new UnauthorizedHttpException('jwt-auth', 'User not found');
            }
        } catch (JWTException $e) {
            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
        }
    }
}