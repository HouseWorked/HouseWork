<?php

use yii\db\Migration;

/**
 * Class m171216_082224_domains_table
 */
class m171216_082224_domains_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('pr_domains', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'project_id' => $this->integer()
        ]);
        $this->addForeignKey('FK_project_id', 'pr_domains', 'project_id', 'pr_project', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('pr_domains');
        $this->dropForeignKey('FK_project_id', 'pr_domains');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171216_082224_domains_table cannot be reverted.\n";

        return false;
    }
    */
}
