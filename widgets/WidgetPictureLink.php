<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\WidgetConfig;
use frenzelgmbh\appcommon\widgets\AdminPortlet;

class WidgetPictureLink extends AdminPortlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'PICTURELINK';
	
	public $title='Picture Link Widget';
	
	public $module = 'GLOBAL';	
	public $id = 1;

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