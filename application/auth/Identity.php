<?php

namespace application\auth;

use application\entities\User\User;
use application\readModels\UserReadRepository;
use Yii;
use yii\web\IdentityInterface;

class Identity implements IdentityInterface
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    private static function getRepository()
    {
        return Yii::$container->get(UserReadRepository::class);
    }
}
