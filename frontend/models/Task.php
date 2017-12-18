<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_task".
 *
 * @property integer $id
 * @property string $title_task
 * @property string $start
 * @property string $ends
 * @property string $description
 * @property string $type
 * @property integer $delete
 * @property integer $status
 * @property integer $user_id
 * @property integer $creator_id
 * @property string $creat_at
 * @property integer $project_id
 *
 * @property Comment[] $prComments
 * @property User $creator
 * @property User $user
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'ends', 'creat_at'], 'safe'],
            [['description'], 'string'],
            [['delete', 'status', 'user_id', 'creator_id', 'project_id'], 'integer'],
            [['title_task', 'type'], 'string', 'max' => 50],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_task' => 'Title Task',
            'start' => 'Start',
            'ends' => 'Ends',
            'description' => 'Description',
            'type' => 'Type',
            'delete' => 'Delete',
            'status' => 'Status',
            'user_id' => 'User ID',
            'creator_id' => 'Creator ID',
            'creat_at' => 'Creat At',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrComments()
    {
        return $this->hasMany(Comment::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
