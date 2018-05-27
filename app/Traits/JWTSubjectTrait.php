<?php

namespace App\Traits;

/**
 * Trait JWTSubjectTrait
 * @package App\Traits
 */
trait JWTSubjectTrait
{
    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'model' => self::class,
        ];
    }
}