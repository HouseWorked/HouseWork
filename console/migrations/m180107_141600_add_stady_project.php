<?php

use yii\db\Migration;

/**
 * Class m180107_141600_add_stady_project
 */
class m180107_141600_add_stady_project extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('pr_project', [
			'id' => $this->primaryKey(),
			'title' => $this->string(255)
		]);
		$this->addColumn();
		$this->addForeignKey('FK_for_stady', 'pr_project', 'stady_id', '', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180107_141600_add_stady_project cannot be reverted.\n";

        return false;
    }
    */
}
