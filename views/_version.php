<?php
/**
 * Created by PhpStorm.
 * User: cmmsNetAdmin
 * Date: 8/1/2559
 * Time: 20:10
 */
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\Button;

$test = Url::remember(Url::current());
//echo $test;
?>
<?php
Alert::begin([
    'options' => [
        'class' => 'alert-custom',
    ],
]);
?>
<strong><?php echo Html::icon('info-sign'); ?> -: มีการอัพเดตระบบ :- </strong>
<?php echo Button::widget([
    'label' => 'แสดงรายละเอียด',
    'options' => [
        'class' => 'btn-xs btn-primary',
        'data-toggle' => 'collapse',
        'data-target' => '#demo',
    ],
]);
echo Html::a('ปิดการแจ้งเตือน 30 วัน', ['/tc/default/setvercookies'],
    [
        'class' => 'btn btn-xs btn-danger',
    ]);
?>
<!--<a id="blink" data-original-title="ปิดการแจ้งเตือน 30 วัน" data-toggle="tooltip" href="--><?php //echo Url::toRoute('/tc/default/setvercookies'); //echo Yii::$app()->baseUrl.'/cmmslib/default/setvercookies' ?><!--" class="alert-link text-danger glyphicon glyphicon-off"></a>-->
<div id="demo" class="collapse">
    <h4>version <?php echo Yii::$app->controller->module->params['ModuleVers']; ?></h4>
    <ul>
        <li>แก้ไขชื่อระบบ</li>
    </ul>
</div>

<?php Alert::end(); ?>