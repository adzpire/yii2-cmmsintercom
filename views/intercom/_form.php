<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
*/
/* @var $this yii\web\View */
/* @var $model backend\modules\intercom\models\MainIntercom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-intercom-form">

    <?php $form = ActiveForm::begin([
			'layout' => 'horizontal', 
			'id' => 'main-intercom-form',
			'fieldConfig' => [
				  'horizontalCssClasses' => [
						'label' => 'col-md-3',
						'wrapper' => 'col-sm-9',
				  ],
			 ],
			//'validateOnChange' => true,
            //'enableAjaxValidation' => true,
			//	'enctype' => 'multipart/form-data'
			]); ?>
    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
	<?php
	echo $form->field($model, 'location_id')->widget(Select2::classname(), [
		'data' => $loclist,
		'options' => ['placeholder' => 'ระบุสถานที่'],
		'pluginOptions' => [
			'allowClear' => true,
		],
	]);
	?>
	<?php
	echo $form->field($model, 'staff_id')->widget(Select2::classname(), [
		'data' => $personlist,
		'options' => ['placeholder' => 'เลือกบุคลากร หากไม่มีให้ว่างไว้'],
		'pluginOptions' => [
			'allowClear' => true,
		],
		'pluginEvents' => [
			"select2:select" => 'function() {
				var str = $(this).val();
				//console.log(str);
				$.ajax({
                    url: "'.Url::to(['/intercom/intercom/jobinfo']).'?id="+str,
                    success: function(data){
                        $("._jobinfo").html(data);
                    }
                });
			}',
//			"select" => 'function() {
//
//			var str = $(this).val();
//			var res = str.split(" - ");
//			//console.log(res[0]);
//			$("form").submit();
//			var somestr = "'.Url::to(['/borrow-material/default/chooseform']).'?booking_at="+res[0]+"&return_at="+res[1];
//
//		   $("._gtf").attr("href", somestr);
//		   $(".btn-clear-item").click();
//		}',
		],
	]);
	?>
	<div class="form-group">
		<label class="control-label col-md-3">ภาระงาน</label>
		<div class="col-md-9 _jobinfo">
			<?php
			echo ($model->isNewRecord) ? '-' : $model->personjob->jobInfoList;
			?>
		</div>
	</div>

<?php 		/* adzpire form tips
		$form->field($model, 'wu_tel', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]);
		//file field
				echo $form->field($model, 'file',[
		'addon' => [
       
'append' => !empty($model->wt_image) ? [
			'content'=> Html::a( Html::icon('download').' '.Yii::t('app', 'download'), Url::to('@backend/web/'.$model->wt_image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
    ]])->widget(FileInput::classname(), [
			//'options' => ['accept' => 'image/*'],
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'initialCaption'=> $model->isNewRecord ? '' : $model->wt_image,
				'showUpload' => false
			]
]);
		*/
 ?>     <div class="form-group text-center">
        <?= Html::submitButton( Html::icon('floppy-disk').' '.Yii::t('app', 'บันทึก'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php /*if(!$model->isNewRecord){ echo Html::resetButton( Html::icon('refresh').' '.Yii::t('app', 'Reset') , ['class' => 'btn btn-warning']); */
		  echo Html::a( Html::icon('ban-circle').' '.Yii::t('app', 'ยกเลิก'), Yii::$app->request->referrer, ['class' => 'btn btn-warning']);
		?>
		 
	</div>

    <?php ActiveForm::end(); ?>

</div>
