<?php

namespace mrtcltkgl\sozluk\controllers;

use Yii;
use mrtcltkgl\sozluk\models\Titles;
use mrtcltkgl\sozluk\models\TitlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * TitlesController implements the CRUD actions for Titles model.
 */
class TitlesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
		
			'access'=>[
				'class'=>AccessControl::classname(),
				'rules'=>[
					[
						'actions'=>['index','view','create','update','delete'],
						'allow'=>true,
						'roles'=>['@']
					],				
				],	
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Titles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TitlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Titles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Titles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->can('createTitle')) {		
        $model = new Titles();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->user->getId() != null) {
			$model->user_id = Yii::$app->user->getId();
			if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
		}
		else{
			Yii::$app->session->setFlash('error', 'Başlık oluşturma yetkiniz yok.');
			$this->redirect(['index']);
		}
    }

    /**
     * Updates an existing Titles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if (Yii::$app->user->can('updateTitle')) {		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
		}
		else{
			Yii::$app->session->setFlash('error', 'Başlık güncelleme yetkiniz yok.');
			$this->redirect(['index']);
		}
		
    }

    /**
     * Deletes an existing Titles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if (Yii::$app->user->can('deleteTitle')) {		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
		}
		else{
			Yii::$app->session->setFlash('error', 'Başlık silme yetkiniz yok.');
			$this->redirect(['index']);
		}
		
    }

    /**
     * Finds the Titles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Titles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Titles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
