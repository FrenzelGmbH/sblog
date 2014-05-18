<?php

namespace frenzelgmbh\sblog\controllers;

use Yii;
use yii\filters\VerbFilter;
use frenzelgmbh\appcommon\controllers\AppController;
use frenzelgmbh\sblog\models\WidgetConfig;
use yii\data\ActiveDataProvider;

use \DateTime;

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
              'addlocation',
              'removelocation',
              'addpicturelink',
              'removepicturelink'
            ),
            'roles'=>array('@'),
          ],
          [
            'allow'=>true,
            'actions'=>array(
              'index',
              'addpicturelink'
            ),
            'roles'=>array('?'),
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
      echo $this->renderAjax('@frenzelgmbh/sblog/widgets/views/_mapwidget',[
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

  /**
   * [actionRemovelocation description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function actionRemovelocation($id)
  {
    $date = new DateTime();
    $model = $this->findModel($id);
    $model->time_deleted = $date->format('U');
    return $this->redirect(['/site/index']);
  }

  /**
   * [actionAddpicturelink description]
   * @param  [type] $module [description]
   * @param  [type] $id     [description]
   * @return [type]         [description]
   */
  public function actionAddpicturelink($module=NULL,$id=NULL)
  {
    if(is_null($module))
    {
      $model=new WidgetConfig;
    }
    else
    {
      $model=new WidgetConfig::findOne($id);
    } 
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $query = WidgetConfig::findRelatedRecords('PICTURELINK', $model->wgt_table, $model->wgt_id);
      $dpPictures = new ActiveDataProvider(array(
        'query' => $query,
      ));
      echo $this->renderAjax('@frenzelgmbh/sblog/widgets/views/_picture_link_widget',[
        'dpPictures' => $dpPictures,
        'module'      => $model->wgt_table,
        'id'          => $model->wgt_id
      ]);
    } else {
      $model->wgt_id    = $id;
      $model->wgt_table = $module;
      $model->name      = 'PICTURELINK';

      $model->save();

      return $this->renderAjax('_form_addpicturelink', array(
        'model' => $model,
      ));
    }
  }

  /**
   * [actionRemovepicturelink description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function actionRemovepicturelink($id)
  {
    $date = new DateTime();
    $model = $this->findModel($id);
    $model->time_deleted = $date->format('U');
    return $this->redirect(['/site/index']);
  }

  /**
   * Finds the Post model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return WidgetConfig the loaded model
   * @throws HttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = WidgetConfig::findOne($id)) !== null) {
      return $model;
    } else {
      throw new HttpException(404, 'The requested page does not exist.');
    }
  }

}
