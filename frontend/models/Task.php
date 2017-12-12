<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_task".
 *
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $ends
 * @property string $description
 * @property string $type
 * @property integer $delete
 * @property integer $status
 * @property integer $user_id
 * @property integer $creator_id
 * @property string $creat_at
 *
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $selectRepeat;
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
            [['delete', 'status', 'user_id', 'creator_id'], 'integer'],
            [['title_task'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 20],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_task' => 'Title',
            'start' => 'Start',
            'ends' => 'Ends',
            'description' => 'Description',
            'type' => 'Type',
            'delete' => 'Delete',
            'status' => 'Status',
            'user_id' => 'User ID',
            'creator_id' => 'Creator ID',
            'creat_at' => 'Creat At',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getTeem()
    {
        return $this->hasOne(Teem::className(), ['id' => 'teem_id']);
    }
}
