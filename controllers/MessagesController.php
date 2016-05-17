<?php

namespace mrtcltkgl\sozluk\controllers;

use Yii;
use mrtcltkgl\sozluk\models\Messages;
use mrtcltkgl\sozluk\models\MessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
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
						'roles'=>['@'],
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
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Messages model.
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
     * Creates a new Messages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->can('createMessage')) {
        $model = new Messages();

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
			Yii::$app->session->setFlash('error', 'Mesaj oluşturma yetkiniz yok');
			$this->redirect(['index']);
		}
		
    }

    /**
     * Updates an existing Messages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$model = $this->findModel($id);
		
		if (Yii::$app->user->can('updateMessage', ['messages' => $model])) {
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
		}
		else{
			Yii::$app->session->setFlash('error', 'Mesaj günceleme yetkiniz yok.');
			$this->redirect(['index']);
		}
    }

    /**
     * Deletes an existing Messages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		if (Yii::$app->user->can('deleteMessage', ['messages' => $model])) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
		}
		else{
			Yii::$app->session->setFlash('error', 'Mesaj silme yetkiniz yok.');
			$this->redirect(['index']);
		}
		
    }

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
