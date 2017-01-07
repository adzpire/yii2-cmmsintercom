<?php

namespace backend\modules\intercom\controllers;

use Yii;
use backend\modules\intercom\models\MainIntercom;
use backend\modules\intercom\models\MainIntercomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `intercom` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $checkperson;
    public $moduletitle;
    public function beforeAction(){
        //$this->checkperson = Person::findOne([Yii::$app->user->id]);
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);
        return true;
    }

    public function actionIndex()
    {
        Yii::$app->view->title = Yii::t('app', 'Main Intercoms').' - '.$this->moduletitle;

        $searchModel = new MainIntercomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
