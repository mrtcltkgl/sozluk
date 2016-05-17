<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mrtcltkglsozluk\models\Titles;

/* @var $this yii\web\View */
/* @var $model backend\modules\sozluk\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>




	<?= $form->field($model, 'title_id')->dropDownList(
		ArrayHelper::map(Titles::find()->all(),'id','name'),
		['prompt'=>'Bir başlık seçiniz...']
	) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Oluştur' : 'Güncelle', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
