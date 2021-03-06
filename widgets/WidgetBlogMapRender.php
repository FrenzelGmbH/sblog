<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\WidgetConfig;

class WidgetBlogMapRender extends \yii\base\Widget
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'MAPWIDGET';
	
	public $module = 0;	
	public $id = 0;

	public function init() {
		parent::init();
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
	}

	public function run()
	{
		$dpLocations = WidgetConfig::findRelatedModels(self::WIDGET_NAME, $this->module, $this->id);

	  	if(!is_null($dpLocations))
	  	{
			return $this->render('@frenzelgmbh/sblog/widgets/views/_mapwidget_renderer',['dpLocations'=>$dpLocations]);
		}
		else
		{
			return "";
		}
	}

}