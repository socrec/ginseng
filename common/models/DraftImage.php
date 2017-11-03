<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "draft_image".
 *
 * @property string $path
 * @property string $object_type
 * @property integer $object_id
 */
class DraftImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'draft_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id'], 'integer'],
            [['path'], 'string', 'max' => 300],
            [['object_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'path' => 'Path',
            'object_type' => 'Object Type',
            'object_id' => 'Object ID',
        ];
    }
}
