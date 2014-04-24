<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Block;
use kartik\widgets\SideNav;

/**
 * @var yii\web\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 */

$this->title = 'Update Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workbench">

<?php Block::begin(array('id'=>'sidebar')); ?>

  <?php 

    $sideMenu = array();
    $sideMenu[] = array('icon'=>'home','label'=>Yii::t('app','Home'),'url'=>Url::to(array('/site/index')));
    $sideMenu[] = array('icon'=>'arrow-left','label'=>Yii::t('app','Post Overview'),'url'=>Url::to(array('/posts/post/index')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_DEFAULT,
      'heading' => 'Options',
      'items' => $sideMenu
    ]);

  ?>

  <?php
    if(class_exists('frenzelgmbh\sblogwidgets\WidgetBlogMap')){
      echo frenzelgmbh\sblogwidgets\WidgetBlogMap::widget([
        'module'=> app\modules\workflow\models\Workflow::MODULE_BLOG,
        'id' => $model->id,
      ]);
    }
  ?>

<?php Block::end(); ?>

	<h1 class="page-header"><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
