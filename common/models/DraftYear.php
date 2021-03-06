<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className(),
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
            ],
        ];
    }

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
            [['date_raise', 'date_sleep', 'fertilize_date', 'fertilize_brand', 'created_at', 'updated_at', 'deleted_at', 'notice'], 'safe'],
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
            'ginseng_id' => Yii::t('app', 'Ginseng ID'),
            'year' => Yii::t('app', 'Year'),
            'date_raise' => Yii::t('app', 'Date Raise'),
            'date_sleep' => Yii::t('app', 'Date Sleep'),
            'fertilize_date' => Yii::t('app', 'Fertilize Date'),
            'fertilize_brand' => Yii::t('app', 'Fertilize Brand'),
            'fertilize_amount' => Yii::t('app', 'Fertilize Amount'),
            'notice' => Yii::t('app', 'Notice'),
            'imageFiles' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
