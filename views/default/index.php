<?php

use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\intercom\models\MainIntercomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-intercom-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        //'id' => 'kv-grid-demo',
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'number',
            [
                'attribute' => 'locationName',
                'value' => 'location.loc_name',
                'filter' => $loclist,
            ],
            [
                'attribute' => 'locationFloor',
                'value' => 'location.loc_floor',
                'headerOptions' => [
                    'width' => '50px',
                ],
            ],
            [
                'attribute' => 'personName',
                'value' => 'person.fullname'
                // 'value' => 'personjob.person.fullname'
            ],
            [
                'attribute' => 'jobName',
                //'value' => 'person.fullname'
                 'value' => 'person.job.jobInfoList',
                'format'=>'html',
                'filter' => $joblist,
            ],

            'note',
            //'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'isDeleted',
        ],
        'pager' => [
            'firstPageLabel' => Yii::t('app', 'รายการแรกสุด'),
            'lastPageLabel' => Yii::t('app', 'รายการท้ายสุด'),
        ],
        'responsive'=>true,
        'hover'=>true,
        'pjax'=>true,
        'toolbar'=> [
            ['content'=>
                Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}',
        ],
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('phone-alt').' '.Html::encode($this->title),
            'before' => '

<div class="row">
  <div class="col-md-12 text-center">การใช้โทรศัพท์ภายใน-ภายนอก</div>
</div>
<div class="row">
  <div class="col-md-3 text-center">การรับสายแทน (วิธีใช้ชั่วคราว)</div>
  <div class="col-md-3 text-center">การโอนสาย</div>
  <div class="col-md-3 text-center">การจองสาย</div>
  <div class="col-md-3 text-center">การโทรต่างวิทยาเขต</div>
</div>
<div class="row">
    <div class="col-md-3">
        <p>1.ยกหูโทรศัพท์</p>
        <p>2.กดเลขหมายภายในของเครื่องที่เสียงเรียกกำลังดังขึ้น</p>
        <p>3. กด 8</p>
    </div>
    <div class="col-md-3">
      การจองสายภายในให้เรียกกลับอัตโนมัติ (กรณีที่โทรไปแล้วสายปลายทางไม่ว่าง) ให้กด 6 และวางหูฟังลง เมื่อเครื่องที่ถูกจองสายได้ใช้งานและวางหูฟังแล้ว เครื่องของท่านก็จะมีเสียงเรียกดังขึ้นเอง ซึ่งลักษณะของเสียงเรียกจะดังถี่กว่าปกติ และเมื่อท่านยกหูฟังขึ้น เครื่องที่ถูกจองสายจะมีเสียงเรียกดังตามขึ้นมา
    </div>
  <div class="col-md-3">การจองสายภายในให้เรียกกลับอัตโนมัติ (กรณีที่โทรไปแล้วสายปลายทางไม่ว่าง) ให้กด 6 และวางหูฟังลง เมื่อเครื่องที่ถูกจองสายได้ใช้งานและวางหูฟังแล้ว เครื่องของท่านก็จะมีเสียงเรียกดังขึ้นเอง ซึ่งลักษณะของเสียงเรียกจะดังถี่กว่าปกติ และเมื่อท่านยกหูฟังขึ้น เครื่องที่ถูกจองสายจะมีเสียงเรียกดังตามขึ้นมา
  </div>
    <div class="col-md-3">
        <p>กดสองหมายเลขแล้วตามด้วยหมายเลขปลายทาง</p>
        <p>1.วิทยาเขตปัตตานี กด 04</p>
        <p>2.วิทยาเขตหาดใหญ่ กด 03</p>
        <p>3.วิทยาเขตตรัง กด 05</p>
        <p>4.วิทยาเขตสุราษฏร์ธานี กด 06</p>
        <p>5.วิทยาเขตภูเก็ต กด07</p>
    </div>
</div>',
        ],
    ]); ?>
    <?php 	 /* adzpire grid tips
		[
				'attribute' => 'id',
				'headerOptions' => [
					'width' => '50px',
				],
			],
		[
		'attribute' => 'we_date',
		'value' => 'we_date',
			'filter' => DatePicker::widget([
					'model'=>$searchModel,
					'attribute'=>'date',
					'language' => 'th',
					'options' => ['placeholder' => Yii::t('app', 'enterdate')],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerButton' =>false,
					//'size' => 'sm',
					//'removeButton' =>false,
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd'
					]
				]),
			//'format' => 'html',
			'format' => ['date']

		],
		[
			'attribute' => 'we_creator',
			'value' => 'weCr.userPro.nameconcatened'
		],
	 */
    ?> <?php Pjax::end(); ?>
</div>

