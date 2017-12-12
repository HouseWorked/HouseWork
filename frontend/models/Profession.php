<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SystemUser[] $systemUsers
 * @property SystemUser[] $systemUsers0
 * @property User[] $users
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
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
    public function getSystemUsers()
    {
        return $this->hasMany(SystemUser::className(), ['teem' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUsers0()
    {
        return $this->hasMany(SystemUser::className(), ['profession' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['proff_id' => 'id']);
    }
}
