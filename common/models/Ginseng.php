<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 10/18/17
 * Time: 9:56 PM
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "ginseng".
 *
 * @property integer $id
 * @property string $code
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
class Ginseng extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ginseng';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['planted_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['weight'], 'number'],
            [['how_to_use', 'notice'], 'string'],
            [['code', 'parent_code'], 'string', 'max' => 200],
            [['origin', 'planted_by'], 'string', 'max' => 250],
            [['garden_no', 'line_no'], 'string', 'max' => 5],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
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