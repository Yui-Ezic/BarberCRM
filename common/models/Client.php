<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $phone_number
 *
 * @property Order[] $orders
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone_number'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('client', 'ID'),
//            'first_name' => Yii::t('client', 'First Name'),
//            'last_name' => Yii::t('client', 'Last Name'),
//            'phone_number' => Yii::t('client', 'Phone Number'),
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone_number' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['client_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
