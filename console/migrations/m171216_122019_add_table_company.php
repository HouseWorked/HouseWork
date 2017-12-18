<?php

use yii\db\Migration;

/**
 * Class m171216_122019_add_table_company
 */
class m171216_122019_add_table_company extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('pr_company', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'firstname' => $this->text(),
            'phone' => $this->integer(),
        ]);
        $this->addColumn('pr_project', 'company_id', $this->integer(11)->null());
        $this->addForeignKey('FK_company_id', 'pr_project', 'company_id', 'pr_company', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('pr_company');
        $this->dropColumn('pr_project', 'company_id');
        $this->dropForeignKey('FK_company_id', 'pr_project');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171216_122019_add_table_company cannot be reverted.\n";

        return false;
    }
    */
}
