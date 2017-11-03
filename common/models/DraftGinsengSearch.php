<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DraftGinseng;

/**
 * DraftGinsengSearch represents the model behind the search form about `common\models\DraftGinseng`.
 */
class DraftGinsengSearch extends DraftGinseng
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ginseng_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['origin', 'planted_by', 'planted_at', 'garden_no', 'line_no', 'parent_code', 'how_to_use', 'notice', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = DraftGinseng::find();

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
            'ginseng_id' => $this->ginseng_id,
            'status' => $this->status,
            'planted_at' => $this->planted_at,
            'weight' => $this->weight,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'planted_by', $this->planted_by])
            ->andFilterWhere(['like', 'garden_no', $this->garden_no])
            ->andFilterWhere(['like', 'line_no', $this->line_no])
            ->andFilterWhere(['like', 'parent_code', $this->parent_code])
            ->andFilterWhere(['like', 'how_to_use', $this->how_to_use])
            ->andFilterWhere(['like', 'notice', $this->notice]);

        return $dataProvider;
    }
}
