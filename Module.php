<?php

namespace adzpire\intercom;

/**
 * intercom module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'adzpire\intercom\controllers';

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
                'basePath' => 'adzpire\intercom/intercom/messages'
            ];
        }
		*/
		parent::init();

		$this->layout = 'intercom';
		$this->params['ModuleVers'] = '1.0.0';
		$this->params['title'] = 'intercom';
        // custom initialization code goes here
    }
}
