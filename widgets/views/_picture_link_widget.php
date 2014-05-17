<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;
use yii\widgets\Pjax;

$script = <<<SKRIPT

$(document).on('submit', '#PictureLinkAddForm', function(event) {
  $.pjax.submit(event, '#WidgetPictureLinkPjax')
})

SKRIPT;

$this->registerJs($script);

$deleteJS = <<<DEL
$('.post-box').on('click','.op a.delete',function() {
    var th=$(this),
    container=th.closest('div.location-box'),
    id=container.attr('id').slice(1);
  if(confirm('Are you sure you want to remove the location #'+id+'?')) {
    $.ajax({
      url:th.attr('href'),
      data:{
        'ajax':1,
        'id':id
      },
      type:'POST'
    }).done(function(){container.slideUp()});
  }
  return false;
});

DEL;
$this->registerJs($deleteJS);
?>

<div class="panel-body">

<?php
Pjax::begin(['id'=>'WidgetPictureLinkPjax']);

  echo ListView::widget(array(
		'id' => 'PictureLinkTable',
		'dataProvider'=>$dpPictures,
		'itemView' => '@frenzelgmbh/sblog/widgets/views/iviews/_picture_link_view',
		'layout' => '{items}',
		)
	);
  echo "<p>&nbsp;</p>";

?>

<div class="navbar navbar-default">
  <?php
    echo Html::a('<span class="btn btn-success navbar-btn pull-right tipster" title="add location">'.Icon::show('plus', ['class'=>'fa'], Icon::FA).' add picture link</span>', array("/posts/widgetconfig/addpicturelink", 'id'=>$id,'module'=>$module), array('class' => 'create'));  
  ?>
</div>

<?php
Pjax::end();
?>

</div>
