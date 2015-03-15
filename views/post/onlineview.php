<?php

use yii\helpers\Html;
use yii\widgets\Block;
use yii\helpers\HtmlPurifier;

/**
 * @var yii\web\View $this
 * @var frenzelgmbh\sblog\models\Post $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

<div class="lookover">
  <img src="img/frontimage2.jpg" alt="Cassandra" class="img-responsive"></img>
</div>

<fieldset class="fieldbodysc bg_white">
  <?php
    if(class_exists('frenzelgmbh\sblog\widgets\PortletPostsSearch')){
      echo frenzelgmbh\sblog\widgets\PortletPostsSearch::widget(array(
        'maxResults'=> 5,
        'title' => NULL
      ));
    }
  ?>
</fieldset>

<div class="site-index">

<div class="post-box">
  <div class="post-header">
    <div class="datebox pull-left c_gray">
      <?= date("M", strtotime($model->created_at)); ?><br>
      <?= date("d", strtotime($model->created_at)); ?>
    </div>
    <h1 class="lspace subline blog-header"><a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id, 'title'=>Html::encode(strtoupper($model->title))]); ?>" class="c_black"><?= Html::encode(strtoupper($model->title)); ?></a></h1>
  </div>
  <div class="post-content">
    <?= str_replace('READMORE', '', $model->content); ?>
    <?= frenzelgmbh\sblog\widgets\WidgetBlogMapRender::widget(array(
      'module'=> 1,
      'id'    => $model->id
    )); ?>
  </div>
  <div class="post-footer">
    <?= $model->TagLinks; ?>
  </div>
</div>

<a name="commentreference"></a>

<?php
  if(class_exists('kartik\social\Disqus')){
     echo \kartik\social\Disqus::widget(['settings'=>[
      'id' => 'blog_'.$model->id,
      'shortname' => 'myyii2blog',
      'identifier' => 'blog_'.$model->id,
      'url' =>  \Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id]),
    ]]);
  }
?>

<?php
  if(class_exists('\frenzelgmbh\sblog\widgets\PortletPagination')){
    echo \frenzelgmbh\sblog\widgets\PortletPagination::widget(array(
      'model'=>$model,
    )); 
  }
?>

</div>