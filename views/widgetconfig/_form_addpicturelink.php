<?php

use \Yii;

use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\widgets\ActiveForm;
use \yii\web\JsExpression;

use kartik\widgets\Select2;

$script = <<<SKRIPT
$('#window_party_create').on('click',myModalWindow);
SKRIPT;

$this->registerJs($script);

?>

<?php
$form = ActiveForm::begin([
  'id' => 'PictureLinkAddForm'
]); ?>


  <?= Html::activeHiddenInput($model,'wgt_table',['value'=>$model->wgt_table]); ?>
  
  <?= Html::activeHiddenInput($model,'wgt_id',['value'=>$model->wgt_id]); ?>
	
  <?= Html::activeHiddenInput($model,'name',['value'=>$model->name]); ?>

	<div class="form-actions">
    <?= Html::submitButton('<i class="icon-pencil"></i> '.Yii::t('app','add'), array('class' => 'btn btn-success fg-color-white','id'=>'submit_btn')); ?>		
		<?php //Html::a(\Yii::t('app','add'),['/comments/default/create'],array('class' => 'btn btn-success fg-color-white','id'=>'submitCommentCreate')); ?>
	</div>

<?php 
ActiveForm::end();
?>
