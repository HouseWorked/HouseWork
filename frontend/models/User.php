<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord
{
    public $user_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'role_id'], 'required'],
            [['status', 'created_at', 'updated_at', 'teem_id', 'proff_id'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['teem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teem::className(), 'targetAttribute' => ['teem_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'teem_id' => 'Teem',
            'proff_id' => 'Proff',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeem()
    {
        return $this->hasOne(Teem::className(), ['id' => 'teem_id']);
    }
    public function getProf()
    {
        return $this->hasOne(Profession::className(), ['id' => 'proff_id']);
    }
}
