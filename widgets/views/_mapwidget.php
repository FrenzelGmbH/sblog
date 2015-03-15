<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$script = <<<SKRIPT

$(document).on('submit', '#LocationAddForm', function(event) {
  $.pjax.submit(event, '#WidgetLocationPjax')
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
Pjax::begin(['id'=>'WidgetLocationPjax']);

  echo ListView::widget(array(
    'id' => 'LocationsTable',
    'dataProvider'=>$dpLocations,
    'itemView' => '@frenzelgmbh/sblog/widgets/views/iviews/_location_view',
    'layout' => '{items}',
    )
  );
  echo "<p>&nbsp;</p>";

?>

<div class="navbar navbar-default">
  <?php
    echo Html::a(
      '<span class="btn btn-success navbar-btn pull-right tipster" title="add location"> <i class="fa fa-plus"></i> add location</span>', 
      ["/posts/widgetconfig/addlocation", 'id'=>$id,'module'=>$module],
      ['class' => 'create']
    );  
  ?>
</div>

<?php
Pjax::end();
?>

</div>
