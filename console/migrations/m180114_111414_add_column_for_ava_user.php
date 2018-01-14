<?php

use yii\db\Migration;

/**
 * Class m180114_111414_add_column_for_ava_user
 */
class m180114_111414_add_column_for_ava_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->addColumn('user', 'phone', $this->integer());
		$this->addColumn('user', 'ava', $this->string(255));
		$this->addColumn('user', 'vk', $this->string(255));
		$this->addColumn('user', 'facebook', $this->string(255));
		$this->addColumn('user', 'instagram', $this->string(255));
		$this->addColumn('user', 'odnoklassniki', $this->string(255));
		$this->addColumn('user', 'skype', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'ava');
        $this->dropColumn('user', 'vk');
        $this->dropColumn('user', 'facebook');
        $this->dropColumn('user', 'instagram');
        $this->dropColumn('user', 'odnoklassniki');
        $this->dropColumn('user', 'skype');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180114_111414_add_column_for_ava_user cannot be reverted.\n";

        return false;
    }
    */
}
