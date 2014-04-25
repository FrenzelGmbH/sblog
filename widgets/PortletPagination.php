<?php
namespace frenzelgmbh\sblog\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblogmodels\WidgetConfig;
use frenzelgmbh\appcommon\widgets\Portlet;

class PortletPagination extends Portlet
{
	/**
	 * [$post description]
	 * @var integer
	 */
	public $model = NULL;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		//here we don't return the view, here we just echo it!
		echo $this->render('@sblog/widgets/views/_post_pagination',['model'=>$this->model]);
	}

}