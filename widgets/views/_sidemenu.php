<div class="list-group">

<?php foreach($sideMenu AS $menuEntry): ?>
	
	<div class="list-group-item <?= $menuEntry['decoration']; ?>">
    <a href="<?= $menuEntry['link']; ?>"><i class="<?= $menuEntry['icon']; ?>"></i> <?= $menuEntry['label']; ?></a>
  </div>

<?php endforeach; ?>

</div>