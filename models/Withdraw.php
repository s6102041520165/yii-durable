<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "withdraw".
 *
 * @property int $id
 * @property int $material_id
 * @property int $created_by
 * @property int $items
 */
class Withdraw extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'withdraw';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'items'], 'required'],
            [['material_id', 'created_by','updated_by', 'items'], 'integer'],
        ];
    }
    
    public function behaviors() {
        return [
            BlameableBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'material_id' => 'พัสดุ',
            'created_by' => 'สร้างโดย',
            'updated_by' => 'แก้ไขโดย',
            'items' => 'จำนวน',
        ];
    }
    
    public function getMaterials()
    {
        return $this->hasOne(Materials::className(), ['id' => 'material_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
