<?php

use \Yii;

use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\widgets\ActiveForm;
use \yii\web\JsExpression;

?>

<?php
$form = ActiveForm::begin([
  'id' => 'PictureLinkAddForm'
]); ?>

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
