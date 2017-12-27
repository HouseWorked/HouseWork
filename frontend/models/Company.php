<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_company".
 *
 * @property integer $id
 * @property string $title
 * @property string $firstname
 * @property integer $phone
 *
 * @property PrProject[] $prProjects
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'firstname', 'email'], 'string'],
            [['phone'], 'integer'],
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
            'firstname' => 'Firstname',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrProjects()
    {
        return $this->hasMany(PrProject::className(), ['company_id' => 'id']);
    }
}
