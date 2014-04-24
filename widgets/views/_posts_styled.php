<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<?php 
	echo ListView::widget(array(
		'id' => 'PortletPostsTable',
		'dataProvider'=>$dpPosts,
		'itemView' => 'iviews/_view_styled',
		'layout' => '{items}<div class="pull-right">{pager}</div>',
		)
	);
?>
