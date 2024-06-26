<?php

namespace app\models\data;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\data\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\data\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'region_id', 'branch_id'], 'integer'],
            [[ 'file'], 'safe'],
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
        $query = Orders::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
            'region_id' => $this->region_id,
            'branch_id' => $this->branch_id,

        ]);

        $query->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
