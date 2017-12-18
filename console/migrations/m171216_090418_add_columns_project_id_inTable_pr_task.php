<?php

use yii\db\Migration;

/**
 * Class m171216_090418_add_columns_project_id_inTable_pr_task
 */
class m171216_090418_add_columns_project_id_inTable_pr_task extends Migration
{
    public function up()
    {
        $this->addColumn('pr_task', 'project_id', $this->integer(11)->null());
        $this->addForeignKey('FK_project_id_task', 'pr_task', 'project_id', 'pr_project', 'id');
    }

    public function down()
    {
        $this->dropColumn('pr_task', 'project_id');
        $this->dropForeignKey('FK_project_id_task', 'pr_task');
    }

}
