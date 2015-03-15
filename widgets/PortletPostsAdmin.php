<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\Post;

class PortletPostsAdmin extends \yii\base\Widget
{
	public $title='Blog Admin';

	/**
	 * the menu items containing label and action for the displayed action
	 * @var array
	 */
	public $menuItems = NULL;
	
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
	}

	protected function run()
	{
		if($this->menuItems==null){
			$this->menuItems = array();
			$this->menuItems[] = array('label'=>Yii::t('app','new blog entry'),'link'=>Url::to(array('/posts/post/create')),'icon'=>'icon-plus');
			$this->menuItems[] = array('label'=>Yii::t('app','overview'),'link'=>Url::to(array('/posts/post/index')),'icon'=>'icon-list-alt');
		}

		//here we don't return the view, here we just echo it!
		return $this->render('@frenzelgmbh/sblog/widgets/views/_admin',array('menuItems'=>$this->menuItems));
	}
}