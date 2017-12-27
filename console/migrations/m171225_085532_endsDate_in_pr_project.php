<?php

use yii\db\Migration;

/**
 * Class m171225_085532_endsDate_in_pr_project
 */
class m171225_085532_endsDate_in_pr_project extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('pr_project', 'date_end', $this->dateTime());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('pr_project', 'date_end');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171225_085532_endsDate_in_pr_project cannot be reverted.\n";

        return false;
    }
    */
}
