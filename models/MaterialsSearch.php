<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materials;

/**
 * MaterialsSearch represents the model behind the search form of `app\models\Materials`.
 */
class MaterialsSearch extends Materials
{
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id','types_id', 'brand_id','stock', 'units_id'], 'integer'],
            [['name', 'details'], 'safe'],
            [['price'], 'number'],
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
        $query = Materials::find();

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
            'id' => $this->id,
            'types_id' => $this->types_id,
            'brand_id' => $this->brand_id,
            'stock' => $this->stock,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}
