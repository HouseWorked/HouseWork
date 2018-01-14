<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_project_stage".
 *
 * @property integer $id
 * @property string $title
 *
 * @property PrProject[] $prProjects
 */
class ProjectStage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_project_stage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrProjects()
    {
        return $this->hasMany(PrProject::className(), ['stage_id' => 'id']);
    }
}
