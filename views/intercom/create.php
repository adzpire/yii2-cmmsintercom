<?php

use yii\bootstrap\Html;


/* @var $this yii\web\View */
/* @var $model adzpire\intercom\models\MainIntercom */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Intercoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-intercom-create">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::icon('edit') . ' ' . Html::encode($this->title) ?></span>
            <?= Html::a(Html::icon('list-alt') . ' ' . Yii::t('app', 'entry'), ['index'], ['class' => 'btn btn-success panbtn']) ?>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'loclist' => $loclist,
                'personlist' => $personlist,
            ]) ?>
        </div>
    </div>

</div>
