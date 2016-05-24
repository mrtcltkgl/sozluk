<?php

namespace frontend\controllers;

use yii\db\Query;
use yii\data\ActiveDataProvider;
use backend\modules\sozluk\models\Messages;

class MessagesController extends \yii\web\Controller
{

    public function actionMessageDisplay()
    {

        	 $query=new Query();
			 $provider = new ActiveDataProvider([
			 'query'=>Messages::find(),
			 'pagination' =>[
			 'pagesize' =>3,
			 ],
			]);
			return $this->render('message-display',['provider'=>$provider,
		]);
		
    }

}
