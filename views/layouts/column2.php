<?php $this->beginContent(\Yii::$app->controller->module->layoutPath . '/' . \Yii::$app->controller->module->layout . '.php'); ?>
<div class="row">
   <div class="col-md-3">
<?php if(!\Yii::$app->user->isGuest): ?>
<div class="well">
  <div class="row">
    <div class="col-md-3">
      <span class="fa-stack fa-lg" style="color:<?=\Yii::$app->user->identity->oeconfig->color; ?>">
        <i class="fa fa-square-o fa-stack-2x"></i>
          <i class="fa fa-user fa-stack-1x"></i>
      </span>
    </div>
    <div class="col-md-9">
  <address>
    Benutzer: <strong><?= \Yii::$app->user->identity->username; ?></strong><br>
    OE: <strong><?= \Yii::$app->user->identity->Boe; ?></strong>    
  </address>        
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <abbr title="EMail">UM:</abbr> 
    </div>
    <div class="col-md-10">
      <?= \Yii::$app->user->identity->email; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <abbr title="EMail">LDM:</abbr> 
    </div>
    <div class="col-md-10">
      <?= \Yii::$app->user->identity->OEMail; ?>
    </div>
  </div>
</div>  
<?php endif; ?>
    <div class="pg-sidebar">
      <?php       
        if(isset($this->blocks['sidebar']))
        {   
          echo $this->blocks['sidebar'];
        } 
      ?>
    </div>      
  </div>
  <div class="col-md-9">
    <?= $content; ?>
  </div>
</div>
<?php $this->endContent(); ?>
