<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ginseng;

/**
 * GinsengSearch represents the model behind the search form about `common\models\Ginseng`.
 */
class GinsengSearch extends Ginseng
{
    public $age;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'garden_no', 'line_no', 'age'], 'integer'],
            [['code', 'origin', 'planted_by', 'planted_at', 'parent_id', 'how_to_use', 'notice', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['weight'], 'number'],
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
        $query = Ginseng::find();

        // add conditions that should always apply here
        $query->where(['is_deleted' => null]);

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
            'status' => $this->status,
            'planted_at' => $this->planted_at,
            'weight' => $this->weight,
            'garden_no' => $this->garden_no,
            'line_no' => $this->line_no,
            '(YEAR(CURDATE()) - YEAR(planted_at)) + planted_age' => $this->age,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'planted_by', $this->planted_by])
            ->andFilterWhere(['like', 'parent_id', $this->parent_id])
            ->andFilterWhere(['like', 'how_to_use', $this->how_to_use])
            ->andFilterWhere(['like', 'notice', $this->notice]);

        return $dataProvider;
    }
}
