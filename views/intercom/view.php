<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model adzpire\intercom\models\MainIntercom */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Intercoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-intercom-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['id'],
				'value' => $model->id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['location_id'],
				'value' => $model->location_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['staff_id'],
				'value' => $model->staff_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['number'],
				'value' => $model->number,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['created_at'],
				'value' => $model->created_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['created_by'],
				'value' => $model->created_by,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['updated_at'],
				'value' => $model->updated_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['updated_by'],
				'value' => $model->updated_by,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['isDeleted'],
				'value' => $model->isDeleted,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>