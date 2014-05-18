<?php

use yii\helpers\Html;

?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title><?= Html::encode($this->title); ?></title>
  <link rel="icon" href="/img/favicon.png" type="image/png">
   <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    
    <?= $content; ?>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
