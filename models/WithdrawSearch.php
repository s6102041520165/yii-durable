<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Withdraw;


class WithdrawSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by','updated_by', 'material_id', 'items'], 'integer'],
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
    public function search()
    {
        $query = Withdraw::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'created_by' => \Yii::$app->user->id,
        ]);

        return $dataProvider;
    }
}
