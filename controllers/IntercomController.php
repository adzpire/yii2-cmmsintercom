<?php

namespace backend\modules\intercom\controllers;

use backend\modules\location\models\MainLocation;
use backend\modules\mainjob\models\PersonJob;
use Yii;
use backend\modules\intercom\models\MainIntercom;
use backend\modules\intercom\models\MainIntercomSearch;

use backend\modules\person\models\Person;
use backend\components\AdzpireComponent;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * IntercomController implements the CRUD actions for MainIntercom model.
 */
class IntercomController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['create', 'update', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['IntStaff', 'root'],
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    }

    public $checkperson;
    public $moduletitle;
    public function beforeAction($action){
        $this->checkperson = Person::findOne([Yii::$app->user->id]);
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);
        return parent::beforeAction($action);
    }
	 
    /**
     * Lists all MainIntercom models.
     * @return mixed
     */
    public function actionIndex()
    {
		 
		 Yii::$app->view->title = Yii::t('app', 'รายการข้อมูล').' - '.$this->moduletitle;
		 
        $searchModel = new MainIntercomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MainIntercom model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		 $model = $this->findModel($id);
		 
		 Yii::$app->view->title = Yii::t('app', 'ดูรายละเอียด').' : '.$model->id.' - '.$this->moduletitle;
		 
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new MainIntercom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		 Yii::$app->view->title = Yii::t('app', 'สร้างใหม่').' - '.$this->moduletitle;
		 
        $model = new MainIntercom();

		/* if enable ajax validate
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}*/
		
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
                AdzpireComponent::succalert('addflsh', 'เพิ่มรายการใหม่เรียบร้อย');
			    return $this->redirect('index');
			}else{
                AdzpireComponent::dangalert('addflsh', 'เพิ่มรายการไม่ได้');
			}
            print_r($model->getErrors());exit;
        }
        $loclist = MainLocation::getLocationList();
        $personlist = Person::getPersonList(true,true,false,true);
            return $this->render('create', [
                'model' => $model,
                'loclist' => $loclist,
                'personlist' => $personlist,
            ]);
        

    }

    /**
     * Updates an existing MainIntercom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		 $model = $this->findModel($id);
		 
		 Yii::$app->view->title = Yii::t('app', 'ปรับปรุงรายการ {modelClass}: ', [
    'modelClass' => 'Main Intercom',
]) . $model->id.' - '.$this->moduletitle;
		 
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
                AdzpireComponent::succalert('edtflsh', 'ปรับปรุงรายการเรียบร้อย');
			return $this->redirect(['view', 'id' => $model->id]);	
			}else{
                AdzpireComponent::dangalert('edtflsh', 'ปรับปรุงรายการไม่ได้');
			}
            print_r($model->getErrors());exit;
        }

        $loclist = MainLocation::getLocationList();
        $personlist = Person::getPersonList(true,true,false,true);

            return $this->render('update', [
                'model' => $model,
                'loclist' => $loclist,
                'personlist' => $personlist,
            ]);
        

    }

    /**
     * Deletes an existing MainIntercom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		
        AdzpireComponent::succalert('edtflsh', 'ลบรายการเรียบร้อย');

        return $this->redirect(['index']);
    }

    /**
     * Finds the MainIntercom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MainIntercom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainIntercom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ต้องการ.');
        }
    }
    public function actionJobinfo($id)
    {
        $model = PersonJob::find()
            ->where(['person_id' => $id])
            ->one();
        if ($model !== null) {
            echo $model->JobInfoList;
        }else{
            echo '-';
        }
    }
}
