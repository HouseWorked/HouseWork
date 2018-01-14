<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_menu".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parents
 * @property integer $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parents', 'status'], 'integer'],
            [['title'], 'string', 'max' => 50],
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
            'parents' => 'Parents',
            'status' => 'Status',
        ];
    }
    public function getChildrens($id)
    {
        $children = $this->find()->where(['parents' => $id])->all();
        return $children;
    }
}
