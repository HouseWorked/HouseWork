<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_domains".
 *
 * @property integer $id
 * @property string $title
 * @property integer $project_id
 *
 * @property PrProject $project
 */
class Domains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $title_project;
    public $domains_id;
    public $project_responsible_form_fio;
    public $project_responsible_form_phone;
    public $project_responsible_form_company;
    public static function tableName()
    {
        return 'pr_domains';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['project_id'], 'integer'],
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
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
