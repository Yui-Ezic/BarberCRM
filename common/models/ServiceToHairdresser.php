<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_to_hairdresser".
 *
 * @property int $id
 * @property int|null $hairdresser_id
 * @property int|null $service_id
 * @property int|null $duration Duration in minutes
 * @property int|null $price Price in UAH
 *
 * @property Hairdresser $hairdresser
 * @property Service $service
 */
class ServiceToHairdresser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_to_hairdresser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hairdresser_id', 'service_id', 'duration', 'price'], 'integer'],
            [['hairdresser_id', 'service_id', 'duration', 'price'], 'required'],
            [['hairdresser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hairdresser::className(), 'targetAttribute' => ['hairdresser_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('client', 'ID'),
//            'hairdresser_id' => Yii::t('client', 'Hairdresser ID'),
//            'service_id' => Yii::t('client', 'Service ID'),
//            'duration' => Yii::t('client', 'Duration'),
//            'price' => Yii::t('client', 'Price'),
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'hairdresser_id' => 'Парикмахер',
            'service_id' => 'Услуга',
            'duration' => 'Длительность',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHairdresser()
    {
        return $this->hasOne(Hairdresser::className(), ['id' => 'hairdresser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
