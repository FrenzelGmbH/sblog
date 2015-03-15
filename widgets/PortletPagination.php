<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\WidgetConfig;

class PortletPagination extends \yii\base\Widget
{
	/**
	 * [$post description]
	 * @var integer
	 */
	public $model = NULL;

	public function init() {
		parent::init();
		\frenzelgmbh\sblog\sblogAsset::register(\Yii::$app->view);
	}

	public function run()
	{
		//here we don't return the view, here we just echo it!
		return $this->render('@frenzelgmbh/sblog/widgets/views/_post_pagination',['model'=>$this->model]);
	}

}