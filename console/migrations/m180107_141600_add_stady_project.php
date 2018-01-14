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

        $this->createTable('pr_project_stage', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
        ]);
		$this->addColumn('pr_project', 'stage_id', $this->integer(NULL));
//		$this->addColumn('pr_project', 'stage_id');
		$this->addForeignKey('FK_for_stage_id', 'pr_project', 'stage_id', 'pr_project_stage', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('pr_project_stage');
        $this->dropColumn('pr_project', 'stage_id');
        $this->dropForeignKey('FK_for_stage', 'pr_project');
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
