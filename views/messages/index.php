<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mrtcltkgl\sozluk\models\User;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sozluk\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mesajlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Mesaj Oluştur', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?Php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'id',
			[
				'attribute'=>'user_id',
				'value'=>'user.username',
				//'filter'=>Html::activeDropDownList($searchModel,'user_id',ArrayHelper::map(User::find()->asArray()->all(),'id','username'),['class'=>'form-control','prompt'=>'Lütfen seçim yapınız..']),
			],
            [
				'attribute'=>'title_id',
				'value'=>'title.name'
			],
            'message:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?Php Pjax::end(); ?>	
</div>
