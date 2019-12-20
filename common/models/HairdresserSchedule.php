<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hairdresser_schedule".
 *
 * @property int $id
 * @property int|null $hairdresser_id
 * @property string|null $date
 * @property string|null $from_time time in the format H:MM (ex. 8:30)
 * @property string|null $to_time time in the format H:MM (ex. 19:30)
 *
 * @property Hairdresser $hairdresser
 */
class HairdresserSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hairdresser_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hairdresser_id'], 'integer'],
            [['date'], 'safe'],
            [['from_time', 'to_time'], 'string', 'max' => 5],
            [['hairdresser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hairdresser::className(), 'targetAttribute' => ['hairdresser_id' => 'id']],
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
//            'date' => Yii::t('client', 'Date'),
//            'from_time' => Yii::t('client', 'From Time'),
//            'to_time' => Yii::t('client', 'To Time'),
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'hairdresser_id' => 'Парикмахер',
            'date' => 'Дата',
            'from_time' => 'Время начала',
            'to_time' => 'Время конца',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHairdresser()
    {
        return $this->hasOne(Hairdresser::className(), ['id' => 'hairdresser_id']);
    }

    public function getHairdresserName() {
        return $this->hairdresser->getName();
    }
}
