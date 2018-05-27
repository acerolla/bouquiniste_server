<?php

namespace App\Http\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class RegisterTransformer
 * @package App\Http\Transformers
 */
class RegisterTransformer extends TransformerAbstract
{
    /**
     * @var string
     */
    protected $password;

    /**
     * RegisterTransformer constructor.
     *
     * @param $password
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

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
            'password' => $this->password
        ];
    }
}