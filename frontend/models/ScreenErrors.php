<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pr_screen_errors".
 *
 * @property integer $id
 * @property string $src
 * @property integer $errors_id
 *
 * @property PrErrorProject $errors
 */
class ScreenErrors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr_screen_errors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'errors_id'], 'integer'],
            [['src'], 'string', 'max' => 255],
            [['errors_id'], 'exist', 'skipOnError' => true, 'targetClass' => ErrorProject::className(), 'targetAttribute' => ['errors_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Src',
            'errors_id' => 'Errors ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getErrors()
    {
        return $this->hasOne(ErrorProject::className(), ['id' => 'errors_id']);
    }
}
