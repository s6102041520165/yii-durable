<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $teachers_id
 * @property string $term
 * @property string $year_of_study
 * @property int $created_at
 * @property int $amount_item
 *
 * @property Teachers $teachers
 * @property OrdersDetail[] $ordersDetails
 */
class Orders extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['term', 'year_of_study'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'amount_item'], 'integer'],
            [['term'], 'integer'],
            [['year_of_study'], 'string', 'max' => 4],
            [['created_by'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Teachers::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Teachers::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'รหัส',
            'term' => 'เทอม',
            'year_of_study' => 'ปีการศึกษา',
            'created_at' => 'เพิ่มเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'เพิ่มโดย',
            'updated_by' => 'แก้ไขโดย',
            'amount_item' => 'จำนวน',
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }


    public function getCreator() {
        return $this->hasOne(Teachers::className(), ['id' => 'created_by']);
    }
    
    public function getUpdator() {
        return $this->hasOne(Teachers::className(), ['id' => 'updated_by']);
    }

    public function getOrdersDetails() {
        return $this->hasMany(OrdersDetail::className(), ['orders_id' => 'id']);
    }

}
