<?php

use yii\db\Migration;

/**
 * Class m171218_055408_project_teem
 */
class m171218_055408_project_teem extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('pr_project_teem', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
        $this->addForeignKey('FK_for_project_id', 'pr_project_teem', 'project_id', 'pr_project', 'id');
        $this->addForeignKey('FK_for_user_id', 'pr_project_teem', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('pr_project_teem');
        $this->dropForeignKey('FK_for_project_id', 'pr_project_teem');
        $this->dropForeignKey('FK_for_user_id', 'pr_project_teem');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171218_055408_project_teem cannot be reverted.\n";

        return false;
    }
    */
}
