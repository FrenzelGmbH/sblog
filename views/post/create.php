<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Block;

/**
 * @var yii\web\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="workbench">

<?php Block::begin(array('id'=>'sidebar')); ?>

  <?php 

  $sideMenu = array();
  $sideMenu[] = array('decoration'=>'sticker sticker-color-yellow','icon'=>'icon-arrow-left','label'=>Yii::t('app','Posts Overview'),'link'=>Url::to(array('/posts/post/index'))); 

  echo frenzelgmbh\sblog\widgets\PortletSidemenu::widget(array(
    'sideMenu'=>$sideMenu,
    'enableAdmin'=>false,
    'htmlOptions'=>array('class'=>'nostyler'),
  )); ?>

<?php Block::end(); ?>

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
