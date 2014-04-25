<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use frenzelgmbh\appcommon\controllers\AppController;
use frenzelgmbh\sblog\models\WidgetConfig;
use yii\data\ActiveDataProvider;

class WidgetconfigController extends AppController
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
              'index',
              'addlocation'
            ),
            'roles'=>array('@'),
          ],
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

  /**
   * will create a new commment
   * @param  integer $id     [description]
   * @param  integer $module [description]
   * @return [type]         [description]
   */
  public function actionAddlocation($module=NULL,$id=NULL)
  {
    $model=new WidgetConfig;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $query = WidgetConfig::findRelatedRecords('MAPWIDGET', $model->wgt_table, $model->wgt_id);
      $dpLocations = new ActiveDataProvider(array(
        'query' => $query,
      ));
      echo $this->renderAjax('@sblog/widgets/views/_mapwidget',[
        'dpLocations' => $dpLocations,
        'module'      => $model->wgt_table,
        'id'          => $model->wgt_id
      ]);
    } else {
      $model->wgt_id    = $id;
      $model->wgt_table = $module;
      $model->name      = 'MAPWIDGET';

      return $this->renderAjax('_form_addlocation', array(
        'model' => $model,
      ));
    }
  }

}
