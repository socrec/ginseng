<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 10/18/17
 * Time: 9:56 PM
 */

namespace common\models;

use common\constant\App;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\validators\RequiredValidator;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
 * @property string $parent_id
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
    public $imageFiles;
    public $years;
    public $year;
    public $date_raise;
    public $date_sleep;
    public $fertilize_date;
    public $fertilize_brand;
    public $fertilize_amount;

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
        return 'ginseng';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'weight', 'origin', 'planted_by', 'garden_no', 'line_no'], 'required'],
            ['code', 'unique', 'filter' => ['is_deleted' => null]],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['planted_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['weight', 'parent_id'], 'number'],
            [['how_to_use', 'notice'], 'string'],
            [['code'], 'string', 'max' => 200],
            [['origin', 'planted_by'], 'string', 'max' => 250],
            [['garden_no', 'line_no'], 'string', 'max' => 5],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * Validation for `$years`
     * @param $attribute
     */
    public function validateYears($attribute)
    {
        $requiredValidator = new RequiredValidator();

        foreach($this->$attribute as $index => $row) {
            $error = null;
            $requiredValidator->validate($row['priority'], $error);
            if (!empty($error)) {
                $key = $attribute . '[' . $index . '][priority]';
                $this->addError($key, $error);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'origin' => Yii::t('app', 'Origin'),
            'status' => Yii::t('app', 'Status'),
            'planted_by' => Yii::t('app', 'Planted By'),
            'planted_at' => Yii::t('app', 'Planted At'),
            'weight' => Yii::t('app', 'Weight (g)'),
            'garden_no' => Yii::t('app', 'Garden No'),
            'line_no' => Yii::t('app', 'Line No'),
            'parent_id' => Yii::t('app', 'Parent'),
            'how_to_use' => Yii::t('app', 'How To Use'),
            'notice' => Yii::t('app', 'Notice'),
            'imageFiles' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getYearlyDetails()
    {
        return $this->hasMany(YearlyDetail::className(), ['ginseng_id' => 'id'])->where(['is_deleted' => null]);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['object_id' => 'id'])->where(['object_type' => App::OBJECT_PANAX]);
    }

    public function getParent()
    {
        return $this->hasOne(Ginseng::className(), ['id' => 'parent_id']);
    }

    public function getStatusText()
    {
        if ($this->status == App::PANAX_STATUS_AVAILABLE) {
            return Yii::t('app/panax', 'Available');
        } elseif ($this->status == App::PANAX_STATUS_SOLD) {
            return Yii::t('app/panax', 'Sold');
        } else {
            return Yii::t('app/panax', 'Dead');
        }
    }
}