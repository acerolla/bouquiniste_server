<?php

namespace App\Events;

use App\Entities\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class Registered
 * @package App\Events
 */
class Registered
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * Registered constructor.
     *
     * @param User   $user
     * @param string $password
     */
    public function __construct(User $user, string $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }
}
