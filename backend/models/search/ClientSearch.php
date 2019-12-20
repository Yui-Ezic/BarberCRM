<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Client;

/**
 * ClientSearch represents the model behind the search form of `common\models\Client`.
 */
class ClientSearch extends Client
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
            [['id'], 'integer'],
            [['first_name', 'last_name', 'phone_number', 'query'], 'string'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Client::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // Поиск по айди
        $query->orFilterWhere(['client.id' => $this->query]);

        // Поиск по имени клиента
        $query->orFilterWhere(['like', 'LOWER(CONCAT(client.first_name, \' \', client.last_name))', $this->query]);
        $query->orFilterWhere(['like', 'LOWER(CONCAT(client.last_name, \' \', client.first_name))', $this->query]);

        if (strlen($this->query) > 2) {
            // Поиск по номеру телефона
            $query->orFilterWhere(['like', 'client.phone_number', $this->query]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }
}
