<?php

use yii\db\Migration;

/**
 * Class m171225_125411_add_email_for_company
 */
class m171225_125411_add_email_for_company extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('pr_company', 'email', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('pr_company', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171225_125411_add_email_for_company cannot be reverted.\n";

        return false;
    }
    */
}
