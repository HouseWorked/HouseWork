<?php

use yii\db\Migration;

/**
 * Class m171217_122203_role
 */
class m171217_122203_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role_id', $this->text()->null());
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role_id');
    }
}
