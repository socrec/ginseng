<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "draft_year".
 *
 * @property integer $id
 * @property integer $draft_id
 * @property integer $year
 * @property string $date_raise
 * @property string $date_sleep
 * @property string $fertilize_date
 * @property string $fertilize_brand
 * @property string $fertilize_amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class DraftYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'draft_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['draft_id', 'year', 'created_by', 'updated_by'], 'integer'],
            [['date_raise', 'date_sleep', 'fertilize_date', 'fertilize_brand', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['fertilize_amount'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'draft_id' => 'Draft ID',
            'year' => 'Year',
            'date_raise' => 'Date Raise',
            'date_sleep' => 'Date Sleep',
            'fertilize_date' => 'Fertilize Date',
            'fertilize_brand' => 'Fertilize Brand',
            'fertilize_amount' => 'Fertilize Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
