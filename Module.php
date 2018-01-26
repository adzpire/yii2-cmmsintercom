<?php

namespace backend\modules\intercom;

/**
 * intercom module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\intercom\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
		/*
		Yii::$app->formatter->locale = 'th_TH';
		Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
		
		 if (!isset(Yii::$app->i18n->translations['repair'])) {
            Yii::$app->i18n->translations['repair'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => 'backend\modules\intercom/intercom/messages'
            ];
        }
		*/
		parent::init();

		$this->layout = 'intercom';
		$this->params['ModuleVers'] = '1.1';
		$this->params['title'] = 'ระบบเบอร์โทรศัพท์ภายในคณะฯ';
		$this->params['modulecookies'] = 'intercomck';
        // custom initialization code goes here
    }
}
