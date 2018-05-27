<?php

namespace App\Mail;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserRegistred
 * @package App\Mail
 */
class UserRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * UserRegistered constructor.
     *
     * @param User   $user
     * @param string $password
     */
    public function __construct(User $user, string $password = '')
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function build()
    {
        return $this
            ->subject('Спасибо за регистрацию')
            ->view('mails.greeting')
            ->with('user', $this->user)
            ->with('password', $this->password)
            ->with('text', 'Используйте этот пароль для авторизации в приложении.')
            ->with('final', 'Спасибо за регистрацию!');
    }
}
