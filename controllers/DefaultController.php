<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\AccessRule;

/**
 * @copyright Frenzel GmbH 2015
 * @author Philipp Frenzel <philipp@frenzel.net>
 * Default Route for the blog module
 */
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
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

  public function actionIndex()
  {
    return $this->render('index');
  }
}
