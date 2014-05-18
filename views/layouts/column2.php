<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div id="content">

  <div class="row">
    <div class="col-md-4">      
      <?= $this->blocks['sidebar']; ?>
    </div>
    <div class="col-md-8">
      <div class="cms">
        <?= $content; ?>
      </div>
    </div>
  </div>
  
</div><!-- container -->
<?php $this->endContent(); ?>
