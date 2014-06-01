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

<fieldset class="fieldbodywg">
  <?php
    if(class_exists('app\modules\categories\widgets\CategoriesCloud')){
      echo app\modules\categories\widgets\CategoriesCloud::widget(array(
        'module'=> app\modules\workflow\models\Workflow::MODULE_BLOG,
        'linkclass'  => 'c_black middle-font'
      ));
    }
  ?>
</fieldset>

<fieldset class="fieldbody">
  <div class="social bg_mint_ddd">
    <a href="http://www.pinterest.com/SimpleButMagnif/ target="_blank">PINTEREST</a>
  </div>
  <div class="social bg_mint_dd">
    <a href="https://www.facebook.com/SimpleButMagnificent" target="_blank">FACEBOOK</a>
  </div>
  <div class="social bg_mint_d">
    INSTAGRAM
  </div>
  <div class="social bg_mint">
    TWITTER
  </div>
</fieldset>

<fieldset class="fieldbodywg">
  <a data-pin-do="embedUser" href="http://www.pinterest.com/SimpleButMagnif/" data-pin-scale-width="70" data-pin-scale-height="240" data-pin-board-width="243">Visit SimpleButMagnificent on Pinterest.</a>
</fieldset>

<fieldset class="fieldbodywg" style="align:center">
  <?php 
    echo philippfrenzel\yii2instafeed\yii2instafeed::widget([
        'clientOptions' => [
            'target' => 'instafeedtarget',
            'get' => 'user',
            'userId' => new yii\web\JsExpression('1063429752'),
            'accessToken' => '1063429752.467ede5.68ad0589ee1244c0a938b23f116180d6',
            'limit' => 4,
            'sortBy' => 'most-recent',
            'links' => false,
            'resolution' => 'thumbnail',
            'mock' => false,
            'useHttp' => false,
            'template' => '<a href="{{link}}"><img src="{{image}}" width="115px" class="instagram pull-left"/></a>'
        ]    
    ]);
  ?>
  <div id="instafeedtarget"></div>
</fieldset>

  <?php /* $this->render('blocks/block_system', [
    'model' => $model,
  ]);*/ ?>

<?php Block::end(); ?>


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
      'module'=> app\modules\workflow\models\Workflow::MODULE_BLOG,
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
      'shortname' => 'simplebutmag',
      'identifier' => 'blog_'.$model->id,
      'url' =>  \Yii::$app->urlManager->createAbsoluteUrl(['/posts/post/onlineview', 'id' => $model->id]),
    ]]);
  }
  elseif(class_exists('\app\modules\comments\widgets\PortletDesignComments')){
    echo \app\modules\comments\widgets\PortletDesignComments::widget(array(
      'module'=>\app\modules\workflow\models\Workflow::MODULE_BLOG,
      'id'=>$model->id,
    )); 
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