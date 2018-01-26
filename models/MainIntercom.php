<?php

namespace backend\modules\intercom\models;

use backend\modules\mainjob\models\PersonJob;
use Yii;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use backend\modules\location\models\MainLocation;
use backend\modules\mainjob\models\PersonExt;
/**
 * This is the model class for table "main_intercom".
 *
 
 * @property integer $id
 * @property integer $location_id
 * @property integer $staff_id
 * @property string $number
 * @property string $note
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $isDeleted
 * @property MainLocation $location
 * @property Person $createdBy
 * @property Person $updatedBy
 */
class MainIntercom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_intercom';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

public $locationName; 
public $locationFloor;
public $createdByName;
public $updatedByName;
public $personName;
public $jobName;
/*add rule in [safe]
'locationName', 'createdByName', 'updatedByName',
join in searh()
$query->joinWith(['location', 'createdBy', 'updatedBy', ]);*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'number',], 'required'],
            [['location_id', 'staff_id', 'isDeleted'], 'integer'],
            [['number'], 'string', 'max' => 15],
            [['note'], 'string', 'max' => 255],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonExt::className(), 'targetAttribute' => ['staff_id' => 'user_id']],
            [['personjob'], 'exist', 'skipOnError' => true, 'targetClass' => PersonJob::className(), 'targetAttribute' => ['staff_id' => 'person_id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => MainLocation::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => PersonExt::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => PersonExt::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'สถานที่',
            'locationName' => 'สถานที่',
            'locationFloor' => 'ชั้นที่',
            'staff_id' => 'เจ้าหน้าที่',
            'number' => 'โทรศัพท์',
            'note' => 'อื่นๆ',
            'jobName' => 'งาน',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'isDeleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(MainLocation::className(), ['id' => 'location_id']);
		
			/*
			$dataProvider->sort->attributes['locationName'] = [
				'asc' => ['main_location.name' => SORT_ASC],
				'desc' => ['main_location.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'main_location.name', $this->locationName])
			->orFilterWhere(['like', 'main_location.name1', $this->locationName])
						in grid
			[
				'attribute' => 'locationName',
				'value' => 'location.name',
				'label' => $searchModel->attributeLabels()['location_id'],
				'filter' => \MainLocation::locationList,
			],
			
			in view
			[
				'label' => $model->attributeLabels()['location_id'],
				'value' => $model->location->name,
				//'format' => ['date', 'long']
			],
			*/
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(PersonExt::className(), ['user_id' => 'created_by']);
		
			/*
			$dataProvider->sort->attributes['createdByName'] = [
				'asc' => ['person.name' => SORT_ASC],
				'desc' => ['person.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'person.name', $this->createdByName])
			->orFilterWhere(['like', 'person.name1', $this->createdByName])
						in grid
			[
				'attribute' => 'createdByName',
				'value' => 'createdBy.name',
				'label' => $searchModel->attributeLabels()['created_by'],
				'filter' => \Person::createdByList,
			],
			
			in view
			[
				'label' => $model->attributeLabels()['created_by'],
				'value' => $model->createdBy->name,
				//'format' => ['date', 'long']
			],
			*/
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(PersonExt::className(), ['user_id' => 'updated_by']);
		
			/*
			$dataProvider->sort->attributes['updatedByName'] = [
				'asc' => ['person.name' => SORT_ASC],
				'desc' => ['person.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'person.name', $this->updatedByName])
			->orFilterWhere(['like', 'person.name1', $this->updatedByName])
						in grid
			[
				'attribute' => 'updatedByName',
				'value' => 'updatedBy.name',
				'label' => $searchModel->attributeLabels()['updated_by'],
				'filter' => \Person::updatedByList,
			],
			
			in view
			[
				'label' => $model->attributeLabels()['updated_by'],
				'value' => $model->updatedBy->name,
				//'format' => ['date', 'long']
			],
			*/
    }
    public function getPersonjob()
    {
        return $this->hasOne(PersonJob::className(), ['person_id' => 'staff_id']);
    }
    public function getPerson()
    {
        return $this->hasOne(PersonExt::className(), ['user_id' => 'staff_id']);
    }
    public function getMainIntercomList(){
		return ArrayHelper::map(self::find()->all(), 'id', 'title');
	}

/*
public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'อนุมัติ'),
                3 => Yii::t('app', 'ไม่อนุมัติ'),
                4 => Yii::t('app', 'คืนแล้ว'),
            ],
            'statusCondition'=>[
                1 => Yii::t('app', 'อนุมัติ'),
                0 => Yii::t('app', 'ไม่อนุมัติ'),
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case 0 :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;
            case 1 :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;
            case 2 :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            case 3 :
                $str = '<span class="label label-danger">' . $status . '</span>';
                break;
            case 4 :
                $str = '<span class="label label-succes">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }
    
    public static function getItemStatusConsider() {
        return self::itemsAlias('statusCondition');       
    }
*/
}
