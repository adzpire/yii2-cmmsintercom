<?php

namespace backend\modules\intercom\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\intercom\models\MainIntercom;

/**
 * MainIntercomSearch represents the model behind the search form about `backend\modules\intercom\models\MainIntercom`.
 */
class MainIntercomSearch extends MainIntercom
{
    /**
     * @inheritdoc
     */
	  
	 /* adzpire gridview relation sort-filter
		public $weu;
		public $wecr;
	 
		add rule
		[['weu', 'wecr'], 'safe'],

		in function search()  //weU = wasterecycle_user userPro = user_profile
		$query->joinWith(['weU', 'weCr.userPro']); // weCr.userPro - 2layer relation
		$dataProvider->sort->attributes['weu'] = [
			'asc' => ['wasterecycle_user.wu_name' => SORT_ASC],
			'desc' => ['wasterecycle_user.wu_name' => SORT_DESC],
		];
		$dataProvider->sort->attributes['wecr'] = [
			'asc' => ['user_profile.firstname' => SORT_ASC],
			'desc' => ['user_profile.firstname' => SORT_DESC],
		];
		//add grid filter condition ->orFilterWhere for search wu_name or wu_lastname
		->andFilterWhere(['like', 'wasterecycle_user.wu_name', $this->weu])
		->orFilterWhere(['like', 'wasterecycle_user.wu_lastname', $this->weu])
		->andFilterWhere(['like', 'user_profile.firstname', $this->wecr])
		->orFilterWhere(['like', 'user_profile.lastname', $this->wecr]);
        
	 */
    public function rules()
    {
        return [
            [['id','locationFloor'], 'integer'],
            [['number', 'locationName', 'personName'], 'safe'],
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
        $query = MainIntercom::find();
        $query->joinWith(['location', 'person']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['locationName'] = [
            'asc' => ['main_location.loc_name' => SORT_ASC],
            'desc' => ['main_location.loc_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['locationFloor'] = [
            'asc' => ['main_location.loc_floor' => SORT_ASC],
            'desc' => ['main_location.loc_floor' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['personName'] = [
            'asc' => ['person.fullname' => SORT_ASC],
            'desc' => ['person.fullname' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'location_id' => $this->location_id,
            'main_location.loc_floor' => $this->locationFloor,
            'staff_id' => $this->staff_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'isDeleted' => $this->isDeleted,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'main_location.loc_name', $this->locationName])
            ->andFilterWhere(['like', 'person.firstname_th', $this->personName])
            ->orFilterWhere(['like', 'person.lastname_th', $this->locationName]);

        return $dataProvider;
    }
}
