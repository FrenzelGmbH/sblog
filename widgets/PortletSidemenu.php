<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\modules\workflow\models\Workflow;

class PortletSidemenu extends \frenzelgmbh\appcommon\widgets\AdminPortlet
{
	public $title='Menu';
	
	public $module = 0;
	public $id = 0;

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
	 */
	public $titleCssClass='panel-title';

	/**
	 * the menu items rendered within the sidemenu
	 * @var array
	 */
	public $sideMenu = array();

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		//here we don't return the view, here we just echo it!
		echo $this->render('@frenzelgmbh/sblog/widgets/views/_sidemenu',array('sideMenu'=>$this->sideMenu));
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
			echo "<div class='panel-heading'><h3 class=\"{$this->titleCssClass}\"><i class='icon-arrow-right'></i> {$this->title}</h3>\n</div>\n";
		}
	}
}