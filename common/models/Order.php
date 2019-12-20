<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $service_id
 * @property int|null $hairdresser_id
 * @property string|null $date
 * @property string|null $start_time time in the format H:MM (ex. 14:30)
 * @property int|null $duration
 * @property int|null $paid How much client is paid for service in UAH
 * @property string|null $client_comment
 * @property string|null $hairdresser_comment
 * @property int $status
 *
 * @property Client $client
 * @property Hairdresser $hairdresser
 * @property Service $service
 */
class Order extends \yii\db\ActiveRecord
{
    public const STATUS_NEW = 0;
    public const STATUS_CONFIRMED = 10;
    public const STATUS_DONE = 20;
    public const STATUS_CANCELED = 30;

    private $_statusNames = [
        self::STATUS_NEW => "Новый",
        self::STATUS_CONFIRMED => "Подтвержден",
        self::STATUS_CANCELED => "Отменен",
        self::STATUS_DONE => "Выполнен"
    ];

    private $_statusColors = [
        self::STATUS_NEW => "warning",
        self::STATUS_CONFIRMED => "success",
        self::STATUS_CANCELED => "danger",
        self::STATUS_DONE => "secondary"
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'service_id', 'hairdresser_id', 'duration', 'paid', 'status'], 'integer'],
            [['date'], 'safe'],
            [['client_comment', 'hairdresser_comment'], 'string'],
            [['start_time'], 'string', 'max' => 5],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            [['hairdresser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hairdresser::class, 'targetAttribute' => ['hairdresser_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('client', 'ID'),
//            'client_id' => Yii::t('client', 'Client ID'),
//            'service_id' => Yii::t('client', 'Service ID'),
//            'hairdresser_id' => Yii::t('client', 'Hairdresser ID'),
//            'date' => Yii::t('client', 'Date'),
//            'start_time' => Yii::t('client', 'Start Time'),
//            'duration' => Yii::t('client', 'Duration'),
//            'paid' => Yii::t('client', 'Paid'),
//            'client_comment' => Yii::t('client', 'Client Comment'),
//            'hairdresser_comment' => Yii::t('client', 'Hairdresser Comment'),
//            'status' => Yii::t('client', 'Status'),
//        ];
//    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'client_id' => 'Клиент',
            'service_id' => 'Услуга',
            'hairdresser_id' => 'Парикмахер',
            'date' => 'Дата',
            'start_time' => 'Время',
            'duration' => 'Длительность',
            'paid' => 'Оплаченно',
            'client_comment' => 'Комментарий клиента',
            'hairdresser_comment' => 'Комментарий парикмахера',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
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

    /**
     * @return string Bootstrap4 цвет текста (primary, success, danger, ... )
     */
    public function getStatusColor() {
        return $this->_statusColors[$this->status];
    }

    /**
     * @return string Название статуса
     */
    public function getStatusName() {
        return $this->_statusNames[$this->status];
    }

    /**
     * @return array
     */
    public function getStatusNames() {
        return $this->_statusNames;
    }

    /**
     * Возвращает айди статуса по его названию
     * @param $name string Название статуса
     * @return int|null Status id
     */
    public function getStatusByName($name) {
        foreach ($this->_statusNames as $statusId => $statusName) {
            $statusName = mb_strtolower($statusName);
            $name = mb_strtolower($name);
            if ($name == $statusName) {
                return $statusId;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getHairdresserName() {
        return $this->hairdresser->first_name . ' ' . $this->hairdresser->last_name;
    }

    /**
     * @return string
     */
    public function getServiceName() {
        return $this->service->name ? : ' ';
    }

    public function getClientName() {
        return $this->client->first_name . ' ' . $this->client->last_name;
    }
}
