<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HairdresserSchedule;

/**
 * HairdresserScheduleSearch represents the model behind the search form of `common\models\HairdresserSchedule`.
 */
class HairdresserScheduleSearch extends HairdresserSchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hairdresser_id'], 'integer'],
            [['date', 'from_time', 'to_time'], 'safe'],
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
        $query = HairdresserSchedule::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hairdresser_id' => $this->hairdresser_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'from_time', $this->from_time])
            ->andFilterWhere(['like', 'to_time', $this->to_time]);

        return $dataProvider;
    }
}
