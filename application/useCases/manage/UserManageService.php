<?php

namespace application\useCases\manage;

use application\entities\User\User;
use application\forms\manage\User\UserCreateForm;
use application\forms\manage\User\UserEditForm;
use application\repositories\UserRepository;
use application\services\RoleManager;
use application\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function create(UserCreateForm $form)
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form)
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function assignRole($id, $role)
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id)
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }
}
