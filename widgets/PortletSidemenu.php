<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\modules\workflow\models\Workflow;

class PortletSidemenu extends \yii\base\Widget
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
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
	}

	publiv function run()
	{
		return $this->render('@frenzelgmbh/sblog/widgets/views/_sidemenu',array('sideMenu'=>$this->sideMenu));
	}
}