<?php 
use \yii\helpers\Html;

use app\modules\app\helpers\HighlightHelper;
?>

<div class="row">
	<div class="col-md-12">
		<small>Found hit in:</small>
		<b><?= $data->title; ?></b>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
			<?= substr(HighlightHelper::highlightWords(strip_tags($data->content),array($searchText)),0,200).'...'; ?>	
		<?= Html::a('<i class="icon-arrow-right"></i>'.Yii::t('app','view'), $data->url,array('type'=>'button','class'=>'btn btn-default')); ?>	
	</div>
</div>
<hr>
