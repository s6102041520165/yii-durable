<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teachers_id', 'term', 'year_of_study', 'created_at'], 'required'],
            [['teachers_id', 'created_at', 'amount_item'], 'integer'],
            [['term'], 'string', 'max' => 1],
            [['year_of_study'], 'string', 'max' => 4],
            [['teachers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teachers_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teachers_id' => 'Teachers ID',
            'term' => 'Term',
            'year_of_study' => 'Year Of Study',
            'created_at' => 'Created At',
            'amount_item' => 'Amount Item',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teachers_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersDetails()
    {
        return $this->hasMany(OrdersDetail::className(), ['orders_id' => 'id']);
    }
}
