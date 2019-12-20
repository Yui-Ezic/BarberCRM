<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hairdresser".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $description
 * @property string|null $photo
 * @property int|null $status
 *
 * @property HairdresserSchedule[] $hairdresserSchedules
 * @property Order[] $orders
 * @property ServiceToHairdresser[] $serviceToHairdressers
 */
class Hairdresser extends \yii\db\ActiveRecord
{
    public const STATUS_WORKS = 0;
    public const STATUS_FIRED = 10;

    private $_statusNames = [
        self::STATUS_WORKS => "Работает",
        self::STATUS_FIRED => "Уволен",
    ];

    private $_statusColors = [
        self::STATUS_WORKS => "success",
        self::STATUS_FIRED => "danger",
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hairdresser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['first_name', 'last_name', 'photo'], 'string', 'max' => 255],
        ];
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
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('client', 'ID'),
//            'first_name' => Yii::t('client', 'First Name'),
//            'last_name' => Yii::t('client', 'Last Name'),
//            'description' => Yii::t('client', 'Description'),
//            'photo' => Yii::t('client', 'Photo'),
//            'status' => Yii::t('client', 'Status'),
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'description' => 'Описание',
            'photo' => 'Фото',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHairdresserSchedules()
    {
        return $this->hasMany(HairdresserSchedule::className(), ['hairdresser_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['hairdresser_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceToHairdressers()
    {
        return $this->hasMany(ServiceToHairdresser::className(), ['hairdresser_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Увольняет парикмахера
     * @return bool
     */
    public function fire() {
        $this->status = self::STATUS_FIRED;
        return $this->save();
    }

    /**
     * Нанимает парикмахера
     * @return bool
     */
    public function hire() {
        $this->status = self::STATUS_WORKS;
        return $this->save();
    }

    public function getNearestSchedule() {
        $schedules = HairdresserSchedule::find()
            ->where(['hairdresser_id' => $this->id])
            ->andWhere(['between', 'date', date('Y-m-d'), date('Y-m-d', strtotime("+1 week"))])
            ->all();

        return $schedules;
    }
}
