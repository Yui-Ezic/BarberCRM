<?php

use yii\db\Migration;

/**
 * Class m191219_104256_create_admin_user
 */
class m191219_104256_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new \common\models\User();

        $user->username = "admin";
        $user->email = "admin@admin.com";
        $user->setPassword("admin");
        $user->generateAuthKey();
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191219_104256_create_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191219_104256_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
