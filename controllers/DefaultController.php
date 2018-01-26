<?php

namespace backend\modules\intercom\controllers;

use Yii;
use backend\modules\intercom\models\MainIntercom;
use backend\modules\intercom\models\MainIntercomSearch;

use backend\modules\mainjob\models\MainJob;
use backend\modules\location\models\MainLocation;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
    public $modul;
    public function beforeAction($action){
        //$this->checkperson = Person::findOne([Yii::$app->user->id]);
        $this->modul = \Yii::$app->controller->module;
        $this->moduletitle = Yii::t('app', $this->modul->params['title']);
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        Yii::$app->view->title = Yii::t('app', 'รายการ').' - '.$this->moduletitle;

        $searchModel = new MainIntercomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $joblist = MainJob::getMainJobList();
        $loclist = MainLocation::getLocationList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'joblist' => $joblist,
            'loclist' => $loclist,
        ]);
    }

    public function actionReadme()
    {
        return $this->render('readme');
    }
    public function actionChangelog()
    {
        return $this->render('changelog');
    }
    public function actionSetvercookies()
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie([
            'name' => $this->modul->params['modulecookies'],
            'value' => $this->modul->params['ModuleVers'],
            'expire' => time() + (60*60*24*30),
        ]));
        $this->redirect(Url::previous());
    }
}
