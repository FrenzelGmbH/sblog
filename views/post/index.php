<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\SideNav;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frenzelgmbh\sblog\models\PostForm $searchModel
 */

$this->title = 'Manage Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

  <?php 

    $sideMenu = array();
    $sideMenu[] = array('icon'=>'book','label'=>Yii::t('app','Blog'),'url'=>Url::to(array('/posts/post/index')));
    $sideMenu[] = array('icon'=>'plus','label'=>Yii::t('app','New Post'),'url'=>Url::to(array('/posts/post/create')));
    $sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Categories'),'url'=>Url::to(array('/categories/categories/index')));
    $sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Tags'),'url'=>Url::to(array('/tags/default/index')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_INFO,
      'heading' => 'Blog Menu',
      'items' => $sideMenu
    ]);

  ?>

<?php yii\widgets\Block::end(); ?>


<div class="workbench">

  <h1 class="page-header"><?= Html::encode($this->title) ?></h1>  

  <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      //'id',
      'title',
      [
        'attribute'=>'author_id',
        'value'=>function ($model, $index, $widget) { 
            return Html::a($model->author->username,  
                '#', 
                [
                    'title'=>'View author detail', 
                    'onclick'=>'alert("This will open the author page.\n\nDisabled for this demo!")'
                ]);
        },
        'filterWidgetOptions'=>[
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'All Authors'],
        'format'=>'raw'
      ],
      [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=> frenzelgmbh\sblog\models\Post::getStatusOptions(), 
        'filterWidgetOptions'=>[
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'All Stati'],
      ],
      //'content:html',
      [
        'attribute'=>'categories_id',
        'value'=>function ($model, $index, $widget) { 
            return Html::tag('div',$model->categories_id);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::merge(['0'=>'none'],['1'=>'Intern','2'=>'Extern','3'=>'Secret']), 
        'filterWidgetOptions'=>[
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'All Categories'],
        'format'=>'raw'
      ],
      'tags:ntext', 
      // 
      // 'time_update:datetime',
      'created_at:datetime',      
      ['class' => 'kartik\grid\ActionColumn'],
    ],
    'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Posts</h3>',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Post', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'showFooter'=>false
    ],
  ]); ?>

</div>
