<?php

use yii\db\Migration;

/**
 * Class m180104_114443_create_table_screenErrors
 */
class m180104_114443_create_table_screenErrors extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('pr_screen_errors', [
            'id' => $this->primaryKey(),
            'src' => $this->string(255),
            'errors_id' => $this->integer(),
        ]);
        $this->addForeignKey('FK_screen_errors', 'pr_screen_errors', 'errors_id', 'pr_error_project', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropTable('pr_screen_errors');
       $this->dropForeignKey('FK_screen_errors', 'pr_screen_errors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180104_114443_create_table_screenErrors cannot be reverted.\n";

        return false;
    }
    */
}
