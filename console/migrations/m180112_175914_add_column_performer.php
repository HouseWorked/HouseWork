<?php

use yii\db\Migration;

/**
 * Class m180112_175914_add_column_performer
 */
class m180112_175914_add_column_performer extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('pr_project', 'performer_id', $this->integer(NULL));
        $this->addForeignKey('FK_foreignKey_for_project', 'pr_project', 'performer_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('pr_project', 'performer_id');
       $this->dropForeignKey('FK_foreignKey_for_project', 'pr_table');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180112_175914_add_column_performer cannot be reverted.\n";

        return false;
    }
    */
}
