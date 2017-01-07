<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\intercom\models\MainIntercom */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Intercoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="main-intercom-update">

    <div class="panel panel-warning">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::icon('edit') . ' ' . Html::encode($this->title) ?></span>
            <?= Html::a(Html::icon('fire') . ' ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger panbtn',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Html::icon('pencil') . ' ' . Yii::t('app', 'createnew'), ['create'], ['class' => 'btn btn-info panbtn']) ?>
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
