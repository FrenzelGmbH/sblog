<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;
use yii\widgets\Pjax;

$deleteJS = <<<DEL
$('.picture-link-box').on('click','.op a.delete',function() {
    var th=$(this),
    container=th.closest('div.picture-link-box'),
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

<?php
Pjax::begin();

  echo ListView::widget(array(
    'id' => 'PictureLinkTable',
    'dataProvider'=>$dpPictures,
    'itemView' => '@frenzelgmbh/sblog/widgets/views/iviews/_picture_link_view',
    'layout' => '{items}',
    'showOnEmpty' => false,
    'emptyText' => ''
    )
  );

?>

<?php if(!Yii::$app->user->isGuest): ?>
<div class="nav navbar">
  <?php
    echo Html::a('<span class="btn btn-success navbar-btn tipster" title="add picture link">'.Icon::show('plus', ['class'=>'fa'], Icon::FA).' add picture link</span>', array("/posts/widgetconfig/addpicturelink", 'id'=>$id,'module'=>$module), array('class' => 'create'));  
  ?>
</div>
<?php endif; ?>

<?php Pjax::end(); ?>
