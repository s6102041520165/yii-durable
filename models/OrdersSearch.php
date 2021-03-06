<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;
use Yii;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by','updated_by', 'term', 'created_at', 'updated_at'], 'integer'],
            [['year_of_study'], 'safe'],
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
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        //var_dump(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0]);die();
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0]=='teacher'){
            $query->andFilterWhere([
                'created_by' => Yii::$app->user->id,
            ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'created_by' => $this->created_by,
                'term' => $this->term,
            ]);
            
            $query->andFilterWhere(['like', 'year_of_study', $this->year_of_study]);
        }

        return $dataProvider;
    }
}
