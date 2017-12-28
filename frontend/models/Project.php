<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_project".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_start
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $title_project;
    public $domains_id;
    public $project_responsible_form_fio;
    public $project_responsible_form_phone;
    public $project_responsible_form_email;
    public $project_responsible_form_company;
    public static function tableName()
    {
        return 'pr_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'safe'],
            [['title'], 'string', 'max' => 100],
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
            'date_start' => 'Date Start',
        ];
    }
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
