<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class TaskSearch extends Task
{
    public function rules() {
        return [
            [['id'], 'integer'],
            [['title', 'start_date', 'end_date', 'status_id'], 'safe'],
        ];
    }

    public function search($params) {
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->joinWith('status');

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'status.title', $this->status_id])
            ->andFilterWhere(['like', 'end_date', $this->end_date]);

        return $dataProvider;
    }
}