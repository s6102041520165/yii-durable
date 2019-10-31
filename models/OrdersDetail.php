<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_detail".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $material_id
 * @property int $amount
 * @property int $status
 *
 * @property Materials $material
 * @property Orders $orders
 */
class OrdersDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orders_id', 'material_id', 'amount'], 'required'],
            [['orders_id', 'material_id', 'amount', 'status'], 'integer'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orders_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'orders_id' => 'รหัสใบจอง',
            'material_id' => 'รหัสพัสดุ',
            'amount' => 'จำนวน',
            'status' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Materials::className(), ['id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id' => 'orders_id']);
    }
}
