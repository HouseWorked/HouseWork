<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_error_project".
 *
 * @property integer $id
 * @property string $title
 * @property integer $creator_id
 * @property integer $project_id
 * @property string $create_at
 * @property string $error_type
 *
 * @property User $creator
 * @property Project $project
 */
class ErrorProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_error_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creator_id', 'project_id'], 'integer'],
            [['create_at'], 'safe'],
            [['title', 'error_type'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
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
            'title' => 'Title',
            'creator_id' => 'Creator ID',
            'project_id' => 'Project ID',
            'create_at' => 'Create At',
            'error_type' => 'Error Type',
        ];
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
