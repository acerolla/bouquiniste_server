<?php

namespace App\Http\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class UserTransformer
 * @package App\Http\Transformers
 */
class UserTransformer extends TransformerAbstract
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
            'name'  => $model->getAttribute('name')
        ];
    }
}