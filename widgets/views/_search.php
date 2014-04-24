<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="wgSearch">

<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-search')
)); 
?>

   <?= $form->field($model,'searchstring',array(
      'template' => "<div class=\"input-group\">{input}<span class=\"input-group-btn\"><button type=\"submit\" class=\"btn bg_mint_dd searchbtn\">GO</button></span></div>\n"
      ))->textInput(array('placeholder'=>'Looking for something?')); 
  ?>

<?php ActiveForm::end(); ?>

<?php

if(!is_Null($hits)){
	foreach($hits as $hit) {
		echo $this->render('iviews/_search_result_portlet',array('data'=>$hit,'searchText'=>$model->searchstring));
	}
}elseif(strlen($model->searchstring)>0){
	echo "no results found!";
}
?>

</div>
