<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    public $query;

    /**
     * {@inheritdoc}
     */
    public function afterValidate()
    {
        parent::afterValidate();
        $this->query = mb_strtolower($this->query);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'service_id', 'hairdresser_id', 'duration', 'paid', 'status'], 'integer'],
            [['date', 'start_time', 'client_comment', 'hairdresser_comment', 'query'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    private function validatesAsInt($number)
{
    $number = filter_var($number, FILTER_VALIDATE_INT);
    return ($number !== FALSE);
}

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                    'date' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if ($this->validatesAsInt($this->query)) {
            $query->orFilterWhere(['order.id' => $this->query]);
            $query->orFilterWhere(['order.paid' => $this->query]);
        } else if (is_string($this->query)) {
            $query->joinWith('client');
            $query->joinWith('hairdresser');

            // Поиск по имени клиента
            $query->orFilterWhere(['like', 'LOWER(CONCAT(client.first_name, \' \', client.last_name))', $this->query]);
            $query->orFilterWhere(['like', 'LOWER(CONCAT(client.last_name, \' \', client.first_name))', $this->query]);

            // Поиск по имени парикмахера
            $query->orFilterWhere(['like', 'LOWER(CONCAT(hairdresser.first_name, \' \', hairdresser.last_name))', $this->query]);
            $query->orFilterWhere(['like', 'LOWER(CONCAT(hairdresser.last_name, \' \', hairdresser.first_name))', $this->query]);

            // Поиск по дате
            $query->orFilterWhere(['like','order.date', $this->query]);

            // Поиск по статусу
            $query->orFilterWhere(['order.status' => $this->getStatusByName($this->query)]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order.id' => $this->id,
            'order.client_id' => $this->client_id,
            'order.service_id' => $this->service_id,
            'order.hairdresser_id' => $this->hairdresser_id,
            'order.date' => $this->date,
            'order.duration' => $this->duration,
            'order.paid' => $this->paid,
            'order.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'order.start_time', $this->start_time])
            ->andFilterWhere(['like', 'order.client_comment', $this->client_comment])
            ->andFilterWhere(['like', 'order.hairdresser_comment', $this->hairdresser_comment]);

        //var_dump($query->createCommand()->getRawSql());die;
        return $dataProvider;
    }
}
