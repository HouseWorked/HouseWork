<?php

use yii\db\Migration;

/**
 * Class m171222_164631_error_log
 */
class m171222_164631_error_log extends Migration
{
    public function safeUp()
    {
        $this->createTable('pr_error_project', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'creator_id' => $this->integer(),
            'project_id' => $this->integer(),
            'create_at' => $this->dateTime(),
            'error_type' => $this->string()
        ]);
        $this->addForeignKey('FK_errors_creator', 'pr_error_project', 'creator_id', 'user', 'id');
        $this->addForeignKey('FK_errors_project', 'pr_error_project', 'project_id', 'pr_project', 'id');
    }

    public function safeDown()
    {
       $this->dropTable('pr_error_project');
       $this->dropForeignKey('FK_errors_creator', 'pr_error_project');
    }
}
