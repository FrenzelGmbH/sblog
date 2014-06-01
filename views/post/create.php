<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Block;
use kartik\widgets\SideNav;

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
    $sideMenu[] = array('icon'=>'home','label'=>Yii::t('app','Overview'),'url'=>Url::to(array('/posts/post/index')));
    
    echo SideNav::widget([
      'type' => SideNav::TYPE_PRIMARY,
      'heading' => 'Options',
      'items' => $sideMenu
    ]);

  ?>

<?php Block::end(); ?>

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
