<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\helpers\Json;

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
                        'actions' => ['index','tag-list'],
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

  /**
   * Will return a JSON array of the matching tags, that may have a content passed over as search
   * @param  [type] $search Text for the lookuk
   * @return [type]         [description]
   */
  public function actionTagList($search = NULL)
  {
    $query = new Query;
    if(!is_Null($search))
    {
      $mainQuery = $query->select('name AS id, name AS text')->distinct()
        ->from('{{%tag}}')
        ->where('UPPER(name) LIKE "%'.strtoupper($search).'%"')
        ->limit(10);

      $command = $mainQuery->createCommand();
      $rows = $command->queryAll();
      $clean['results'] = array_values($rows);
    }
    $clean['results'][] = ['id'=>$search,'text'=>$search];
    header('Content-type: application/json');
    echo Json::encode($clean);
    exit();
  }
}
