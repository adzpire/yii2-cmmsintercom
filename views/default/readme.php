<?php
use yii\helpers\Markdown;

$body = Yii::$app->controller->renderPartial('@backend/modules/intercom/docs/guide/basic-usage.md');
echo Markdown::process($body, 'extra');