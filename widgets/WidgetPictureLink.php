<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\WidgetConfig;
use frenzelgmbh\appcommon\widgets\Portlet;

class WidgetPictureLink extends Portlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'PICTURELINK';
	const WIDGET_MODULE = 100;
	
	/**
	 * [$title description]
	 * @var string
	 */
	public $title='Picture Link Widget';
	
	/**
	 * [$module description]
	 * @var string
	 */
	public $module = self::WIDGET_MODULE;	
	
	/**
	 * [$id description]
	 * @var integer
	 */
	public $id = 1;

	/**
   * @var array the HTML attributes for the portlet container tag.
   */
  public $htmlOptions=array('class'=>'nostyler');

	public function init() {
		parent::init();
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
	}

	protected function renderContent()
	{
		$query = WidgetConfig::findRelatedRecords(self::WIDGET_NAME, $this->module, $this->id);

		$dpPictures = new ActiveDataProvider(array(
		  'query' => $query,
	  ));
		//here we don't return the view, here we just echo it!
		echo $this->render('@frenzelgmbh/sblog/widgets/views/_picture_link_widget',['dpPictures'=>$dpPictures,'module'=>$this->module,'id'=>$this->id]);
	}

}