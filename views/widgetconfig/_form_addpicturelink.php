<?php

use \Yii;

use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\widgets\ActiveForm;
use \yii\web\JsExpression;

$dmsysmodel             = new \app\modules\dms\models\Dmsys;
$dmsysmodel->uId        = \Yii::$app->session->id;
$dmsysmodel->dms_module = $model->wgt_table;
$dmsysmodel->dms_id     = $model->wgt_id;

?>

<?php
$form = ActiveForm::begin([
  'id' => 'PictureLinkAddForm'
]); ?>

  <img src="<?= Url::to(['/dms/default/getlatestthumb','id'=>$model->wgt_id,'module'=>$model->wgt_table]); ?>" style="height:125px" alt="thumb"/>
  <?= $this->render('@app/modules/dms/views/default/_upload_form', ['model'=> $dmsysmodel]); ?>

  <?= $form->field($model, 'param1_str'); ?>

  <?= Html::activeHiddenInput($model,'id',['value'=>$model->id]); ?>

  <?= Html::activeHiddenInput($model,'wgt_table',['value'=>$model->wgt_table]); ?>
  
  <?= Html::activeHiddenInput($model,'wgt_id',['value'=>$model->wgt_id]); ?>
	
  <?= Html::activeHiddenInput($model,'name',['value'=>$model->name]); ?>

	<div class="form-actions">
    <?= Html::submitButton('<i class="icon-pencil"></i> '.Yii::t('app','add'), array('class' => 'btn btn-success fg-color-white','id'=>'submit_btn')); ?>
	</div>

<?php 
ActiveForm::end();
?>