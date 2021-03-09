<?php

namespace frontend\models;

/**
 * This is the model class for table "user_specialization".
 *
 * @property int $id
 * @property string|null $created_on
 * @property int|null $user_id
 * @property int|null $specialization_id
 *
 */
class UserSpecialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_on'], 'safe'],
            [['user_id', 'specialization_id'], 'integer'],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
            [
                ['specialization_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Specialization::className(),
                'targetAttribute' => ['specialization_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_on' => 'Created On',
            'user_id' => 'User ID',
            'specialization_id' => 'Specialization ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_specialization',
            ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(),
            ['id' => 'specialization_id'])->viaTable('user_specialization', ['id' => 'specialization_id']);
    }
}
