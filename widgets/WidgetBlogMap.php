<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\WidgetConfig;
use frenzelgmbh\appcommon\widgets\AdminPortlet;

class WidgetBlogMap extends AdminPortlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'MAPWIDGET';
	
	/**
	 * [$title description]
	 * @var string
	 */
	public $title='Map Widget';
	
	/**
	 * [$module description]
	 * @var string
	 */
	public $module = 0;	
	
	/**
	 * [$id description]
	 * @var integer
	 */
	public $id = 0;

	public function init() {
		parent::init();
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
	}

	/**
	 * Renders the widget
	 * @return [type] [description]
	 */
	protected function renderContent()
	{
		$query = WidgetConfig::findRelatedRecords(self::WIDGET_NAME, $this->module, $this->id);

		$dpLocations = new ActiveDataProvider(array(
		  'query' => $query,
	  ));
		//here we don't return the view, here we just echo it!
		echo $this->render('@frenzelgmbh/sblog/widgets/views/_mapwidget',['dpLocations'=>$dpLocations,'module'=>$this->module,'id'=>$this->id]);
	}

}