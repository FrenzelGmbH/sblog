<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<?php 
	echo ListView::widget(array(
		'id' => 'PortletPostsTable',
		'dataProvider'=>$dpPosts,
		'itemView' => 'iviews/_view',
		'layout' => '{items}',
		)
	);
?>
