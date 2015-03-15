<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\Post;

class PortletPostsStyled extends \yii\base\Widget
{
	public $title='Blog';
	
	public $limit = 3;

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
	 */
	public $titleCssClass='fg-color-black';

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-content'.
	 */
	public $contentCssClass='fg-color-black';

	public $htmlOptions=array();

	public function init() {
		parent::init();
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
		if(isset($_GET['tag'])){
			$this->title = "<div class='pull-right'>Posts Tagged with <strong>".Html::encode($_GET['tag'])."</strong></div>";
		}
	}

	public function run()
	{
		if(isset($_GET['tag'])){
			$query = Post::getAdapterForPosts($this->limit*5,$_GET['tag']);
		}
		elseif(isset($_GET['category']))
		{
			$query = Post::getAdapterForPostsCatgory($this->limit*5,$_GET['category']);
		}
		else
			$query = Post::getAdapterForPosts($this->limit*5);

		$dpPosts = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => $this->limit,
		      ),
	  	));
		//here we don't return the view, here we just echo it!
		return $this->render('@frenzelgmbh/sblog/widgets/views/_posts_styled',array('dpPosts'=>$dpPosts));
	}
}