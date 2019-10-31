<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property int $prefix_id
 * @property string $first_name
 * @property string $last_name
 * @property int $faculty_id
 * @property string $address
 * @property string $telephone
 * @property string $email
 * @property int $user_id
 *
 * @property Orders[] $orders
 * @property Takes[] $takes
 * @property TakesDetail[] $takesDetails
 * @property Faculty $faculty
 * @property Prefix $prefix
 * @property User $user
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prefix_id', 'first_name', 'last_name', 'faculty_id', 'user_id'], 'required'],
            [['prefix_id', 'faculty_id', 'user_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['telephone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 30],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
            [['prefix_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prefix::className(), 'targetAttribute' => ['prefix_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'prefix_id' => 'คำนำหน้า',
            'first_name' => 'ชื่อ',
            'last_name' => 'นามสกุล',
            'faculty_id' => 'แผนกวิชา',
            'address' => 'ที่อยู่',
            'telephone' => 'เบอร์โทร',
            'email' => 'อีเมล',
            'user_id' => 'ผู้ใช้',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasMany(Orders::className(), ['created_by' => 'id']);
    }
    
    public function getUpdator()
    {
        return $this->hasMany(Orders::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrefix()
    {
        return $this->hasOne(Prefix::className(), ['id' => 'prefix_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
