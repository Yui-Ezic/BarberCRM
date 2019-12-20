<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 *
 * @property Order[] $orders
 * @property ServiceToHairdresser[] $serviceToHairdressers
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('client', 'ID'),
//            'name' => Yii::t('client', 'Name'),
//            'description' => Yii::t('client', 'Description'),
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => 'Имя',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceToHairdressers()
    {
        return $this->hasMany(ServiceToHairdresser::className(), ['service_id' => 'id']);
    }
}
