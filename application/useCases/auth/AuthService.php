<?php

namespace application\useCases\auth;

use application\entities\User\User;
use application\forms\auth\LoginForm;
use application\repositories\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form)
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        return $user;
    }
}
