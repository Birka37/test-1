<?php

use yii\db\Migration;
use application\entities\User\User;
/**
 * Class m181108_105102_add_user_test
 */
class m181108_105102_add_user_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%users}}',[
            'username' => 'root',
            'email' => 'root@domain.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('root'),
            'created_at' => time(),
            'updated_at' => time(),
            'status' => User::STATUS_ACTIVE,
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);

       $idUser = $this->db->createCommand('SELECT id FROM users ORDER BY id DESC LIMIT 1')->queryScalar();

        if (!$role = Yii::$app->authManager->getRole('Admin')) {
            throw new \DomainException('Role Admin does not exist.');
        }
        Yii::$app->authManager->revokeAll($idUser);
        Yii::$app->authManager->assign($role, $idUser);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181108_105102_add_user_test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181108_105102_add_user_test cannot be reverted.\n";

        return false;
    }
    */
}
