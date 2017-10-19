<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yearly_sick".
 *
 * @property integer $id
 * @property integer $year_id
 * @property string $title
 * @property string $medicine
 * @property string $result
 * @property string $desc
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class YearlySick extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yearly_sick';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_id', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title', 'medicine', 'result'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Year ID',
            'title' => 'Title',
            'medicine' => 'Medicine',
            'result' => 'Result',
            'desc' => 'Desc',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
