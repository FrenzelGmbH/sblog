<?php

use yii\helpers\Html;

?>

<?php foreach($menuItems AS $menuEntry): ?>

<a href="<?= $menuEntry['link']; ?>" class="btn btn-primary btn-lg"><i class="<?= $menuEntry['icon']; ?>"></i> <?= $menuEntry['label']; ?></a>

<?php endforeach; ?>
