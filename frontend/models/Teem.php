<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_teem".
 *
 * @property integer $id
 * @property string $title
 * @property string $major
 */
class Teem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_teem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'major'], 'string', 'max' => 255],
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
            'major' => 'Major',
        ];
    }
}
