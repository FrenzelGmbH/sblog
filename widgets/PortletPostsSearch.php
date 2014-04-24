<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;

use frenzelgmbh\sblogmodels\Post;
use frenzelgmbh\sblogmodels\PostSearch;

class PortletPostsSearch extends \app\modules\app\widgets\AdminPortlet
{
	public $title='Post Search';

	public $contentCssClass='noStyler';
	public $htmlOptions=array('class'=>'noStyler');
	
	public $maxResults = 5;

	public $enableAdmin = false;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new PostSearch;
		if ($model->load(Yii::$app->request->post()))
		{
			if($model->searchstring!=='')
				$hits = Post::searchByString($model->searchstring)->all();
		}
		echo $this->render('@sblog/widgets/views/_search',array('model'=>$model,'hits'=>$hits));
	}
}