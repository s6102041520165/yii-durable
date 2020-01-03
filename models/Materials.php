<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string $name
 * @property int $types_id
 * @property int $brand_id
 * @property string $details
 * @property int $units_id
 * @property double $price
 *
 * @property Brand $brand
 * @property Types $types
 * @property Units $units
 * @property OrdersDetail[] $ordersDetails
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'types_id', 'brand_id', 'units_id', 'price','stock'], 'required','message'=>'ฟิลด์นี้ต้องไม่เป็นค่าว่าง'],
            [['types_id', 'brand_id', 'units_id','stock'], 'integer','message'=>'ฟิลด์นี้ต้องเป็นตัวเลขจำนวนเต็ม'],
            [['price'], 'number','message'=>'กรุณาป้อนตัวเลขทศนิยม'],
            [['name', 'details'], 'string', 'max' => 255],
            [['name'],'unique','message'=>'พบ {value} ในระบบ กรุณาลองชื่อพัสดุอื่น'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['types_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['types_id' => 'id']],
            [['units_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['units_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name' => 'ชื่อพัสดุ',
            'types_id' => 'ประเภทพัสดุ',
            'brand_id' => 'ยี่ห้อ',
            'details' => 'รายละเอียด',
            'units_id' => 'หน่วย',
            'stock' => 'จำนวน',
            'price' => 'ราคา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne(Types::className(), ['id' => 'types_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasOne(Units::className(), ['id' => 'units_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersDetails()
    {
        return $this->hasMany(OrdersDetail::className(), ['material_id' => 'id']);
    }
}
