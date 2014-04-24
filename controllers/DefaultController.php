<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\app\controllers\AppController;

class DefaultController extends AppController
{
  
  /**
   * controlling the different access rights
   * @return [type] [description]
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['post'],
        ],
      ],
      'AccessControl' => [
        'class' => '\yii\filters\AccessControl',
        'rules' => [
          [
            'allow'=>true,
            'actions'=>array(
              'index'
            ),
            'roles'=>array('*'),
          ]
        ]
      ]
    ];
  }

	public function actionIndex()
	{
    $this->layout = \app\modules\app\controllers\AppController::adminlayout;
		return $this->render('index');
	}
}
