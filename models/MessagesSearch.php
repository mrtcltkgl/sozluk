<?php

namespace mrtcltkgl\sozluk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sozluk\models\Messages;

/**
 * MessagesSearch represents the model behind the search form about `backend\modules\sozluk\models\Messages`.
 */
class MessagesSearch extends Messages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['message','user_id', 'title_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Messages::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		

		
		$dataProvider->sort->attributes['author'] = [
			'asc' => ['user.id' => SORT_ASC],
			'desc' => ['user.id' => SORT_DESC],
		];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		$query->joinWith('title');
		$query->joinWith('user');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query	->andFilterWhere(['like', 'message', $this->message])
				->andFilterWhere(['like', 'user.username', $this->user_id])
				->andFilterWhere(['like', 'titles.name', $this->title_id]);
        return $dataProvider;
    }
}
