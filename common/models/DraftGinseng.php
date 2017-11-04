<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "draft_ginseng".
 *
 * @property integer $id
 * @property integer $ginseng_id
 * @property string $origin
 * @property integer $status
 * @property string $planted_by
 * @property string $planted_at
 * @property string $weight
 * @property string $garden_no
 * @property string $line_no
 * @property string $parent_code
 * @property string $how_to_use
 * @property string $notice
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class DraftGinseng extends \yii\db\ActiveRecord
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
        return 'draft_ginseng';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ginseng_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['planted_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['weight'], 'number'],
            [['how_to_use', 'notice'], 'string'],
            [['origin', 'planted_by'], 'string', 'max' => 250],
            [['garden_no', 'line_no'], 'string', 'max' => 5],
            [['parent_code'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ginseng_id' => 'Ginseng ID',
            'origin' => 'Origin',
            'status' => 'Status',
            'planted_by' => 'Planted By',
            'planted_at' => 'Planted At',
            'weight' => 'Weight',
            'garden_no' => 'Garden No',
            'line_no' => 'Line No',
            'parent_code' => 'Parent Code',
            'how_to_use' => 'How To Use',
            'notice' => 'Notice',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
