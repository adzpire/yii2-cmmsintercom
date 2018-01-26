<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\intercom\models\MainIntercom */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการข้อมูล'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-intercom-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
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
				'value' => $model->location->loc_name,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['staff_id'],
				'value' => $model->person->fullname,
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
				'value' => $model->createdBy->fullname,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['updated_at'],
				'value' => $model->updated_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['updated_by'],
				'value' => $model->updatedBy->fullname,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['note'],
				'value' => $model->note,
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>