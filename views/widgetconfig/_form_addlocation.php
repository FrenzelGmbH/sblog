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
  'id' => 'LocationAddForm'
]); ?>
  
  <?php

$dataExp = <<< SCRIPT
  function (term, page) {
    return {
      search: term, // search term
    };
  }
SCRIPT;

$dataResults = <<< SCRIPT
  function (data, page) {
    return {
      results: data.results
    };
  }
SCRIPT;

$url = Url::to(['/parties/party/jsonlist']);

$fInitSelection = <<< SCRIPT
  function (element, callback) {
    var id=$(element).val();
    if (id!=="") {
      $.ajax("$url&id="+id, {
        dataType: "json"
      }).done(function(data) { callback(data.results); });
    }
  }
SCRIPT;

?>

    <?= $form->field($model, 'param2_int')->widget(Select2::classname(),[
          'options' => ['placeholder' => \Yii::t('app','Select supplier ...')],
          'addon' => [
            'append' => [
              'content' => Html::a(\Yii::t('app','New'), ['/parties/party/partywindow', 'id' => $model->id, 'win'=>'party_create','mainid'=>$model->id], [
                'class' => 'btn btn-info',
                'id' => 'window_party_create'
              ]),
              'asButton' => true
            ]
          ],
          'pluginOptions'=>[
            'minimumInputLength' => 3,
            'ajax' => [
              'url' => Url::to(['/parties/party/jsonlist']),
              'dataType' => 'json',
              'data' => new JsExpression($dataExp),
              'results' => new JsExpression($dataResults),
            ],
            'initSelection' => new JsExpression($fInitSelection)
          ]
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
