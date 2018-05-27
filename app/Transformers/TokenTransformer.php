<?php

namespace App\Http\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class TokenTransformer
 * @package App\Http\Transformers
 */
class TokenTransformer extends TransformerAbstract
{
    /**
     * @param JWTSubject|Model $model
     *
     * @return array
     */
    public function transform(JWTSubject $model): array
    {
        return [
            'id'    => $model->getKey(),
            'email' => $model->getAttribute('email'),
            'name'  => $model->getAttribute('name'),
            'token' => JWTAuth::fromUser($model),
        ];
    }
}