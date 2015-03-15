<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class DefaultController extends Controller
{
  /**
   * so we use the default admin theme
   * @var string
   */
  public $layout = "column2";
  
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
        'ruleConfig' => [
            'class' => \app\components\AccessRule::className(),
        ],
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
    return $this->render('index');
	}
}
