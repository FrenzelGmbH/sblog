<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\SideNav;

/**
 * @var yii\web\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

	<?php 

  	$sideMenu = array();
  	$sideMenu[] = array('icon'=>'home','label'=>Yii::t('app','Home'),'url'=>Url::to(array('/site/index')));
  	$sideMenu[] = array('icon'=>'overview','label'=>Yii::t('app','New Post'),'url'=>Url::to(array('/parties/party/index')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_DEFAULT,
      'heading' => 'Options',
      'items' => $sideMenu
    ]);

  ?>

<?php yii\widgets\Block::end(); ?>

<div class="workbench">

	<h1 class="page-header"><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			'content:ntext',
			'tags:ntext',
			'status',
			'author_id',
			'time_create:datetime',
			'time_update:datetime',
		],
	]); ?>

</div>
