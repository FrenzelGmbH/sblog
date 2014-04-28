<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\Post;

class PortletPosts extends \frenzelgmbh\appcommon\widgets\AdminPortlet
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
			$this->title = "Posts <small>Tagged with <i>".Html::encode($_GET['tag'])."</i></small>";
		}
	}

	protected function renderContent()
	{
		if(isset($_GET['tag'])){
			$query = Post::getAdapterForPosts($this->limit,$_GET['tag']);
		}
		else
			$query = Post::getAdapterForPosts($this->limit);

		$dpPosts = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => $this->limit,
		      ),
	  	));
		//here we don't return the view, here we just echo it!
		echo $this->render('@frenzelgmbh/sblog/widgets/views/_posts',array('dpPosts'=>$dpPosts));
	}

	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			$this->title = Yii::t('app',$this->title);
			echo "<h2 class=\"{$this->titleCssClass}\"><i class='icon-info'></i> {$this->title}</h2>\n";
		}
	}
}