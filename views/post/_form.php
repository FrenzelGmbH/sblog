<?php

use yii\helpers\Json;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;

use philippfrenzel\yiiwymeditor\yiiwymeditor;

use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\ActiveForm;


/**
 * @var yii\base\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="post-form">

  <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(array('maxlength' => 128)); ?>

    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => \Yii::t('app','Publish Date')],
            'pluginOptions' => [
              'autoclose' => true,
              'format'=> 'yyyy-mm-dd',
              'todayHighlight' => true,
              'numberOfMonths' => 2
            ]
        ]);?>
      </div>
      <div class="col-md-6">
        <?= $form->field($model,'status')->dropDownList($model::getStatusOptions()); ?>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
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

$createSearchChoice = <<< SCRIPT
function(term, data) {
    if ($(data).filter(function() {
      return this.text.localeCompare(term) === 0;
    }).length === 0) {
      return {
        id: term,
        text: term
      };
    }
 }
SCRIPT;

$tagValues = explode(',', $model->tags);
$initTagList = [];
foreach($tagValues AS $tmptag){
  $initTagList[] = ['id'=>$tmptag, 'text'=>$tmptag];
}

$jsonTags = Json::encode($initTagList);

$tagInitSelection = <<< SCRIPT
function (element, callback) {
  var obj= $jsonTags;
  callback(obj);
}
SCRIPT;

$tagurl = Url::to(['/posts/default/tag-list']);

?>

    <?= $form->field($model, 'tags')->widget(Select2::classname(),[
          'options' => ['placeholder' => \Yii::t('app','add tags ...')],
          'addon' => [
            'prepend'=>[
              'content' => '<i class="fa fa-globe"></i>'
            ]
          ],
          'pluginOptions'=>[
            'tags' => true,
            'tokenSeparators' => [","],
            'multiple' => true,
            'allowClear' => true,
            'createSearchChoice' => new JsExpression($createSearchChoice),
            'initSelection' => new JsExpression($tagInitSelection),
            'ajax' => [
              'url' => $tagurl,
              'dataType' => 'json',
              'data' => new JsExpression($dataExp),
              'results' => new JsExpression($dataResults),
            ]
          ]
    ]); ?>
      </div>
      <div class="col-md-6">
        <?php 
        echo $form->field($model, 'categories_id')->widget(Select2::classname(), [
          'data' => ['1'=>'Intern','2'=>'Extern','3'=>'Secret'],
          'options' => ['placeholder' => 'Select a categorie ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
        ]);
        ?> 
      </div>
    </div>
    
    <?php

$pinterest = <<< SCRIPT
{instanceReady: function() {
  this.dataProcessor.htmlFilter.addRules({
      elements: {
          img: function( el ) {
              if ( !el.attributes.class )
                el.attributes.class = 'img-responsive';
              if(el.attributes.alt == 'pinterest') {
                var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<div class="pinterest-image">'+el.getOuterHtml()+'</div>' );
                el.replaceWith(fragment);
              }
          }
      }
  });          
}}
SCRIPT;

  ?>

    <?= yiiwymeditor::widget(array(
      'model'=>$model,
      'attribute'=>'content',
      'clientOptions'=>array(
        'on' => new JsExpression($pinterest),
        'toolbar' => 'basic',
        'height' => '350px',
        'filebrowserBrowseUrl' => Url::to(array('/pages/page/filemanager')),
        'filebrowserImageBrowseUrl' => Url::to(array('/pages/page/filemanager','mode'=>'image')),
      ),
      'inputOptions'=>array(
        'size'=>'3',
      )
    ));?>    

    <div class="form-group navbar navbar-default">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-info navbar-btn tipster','title'=>'update this record')); ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
