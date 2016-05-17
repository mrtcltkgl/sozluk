<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mrtcltkgl\sozluk\models\Tags;

/* @var $this yii\web\View */
/* @var $model backend\modules\sozluk\models\Titles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="titles-form">

    <?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'tag_id')->dropDownList(
		ArrayHelper::map(Tags::find()->all(),'id','name'),
		['prompt'=>'Bir etiket seçiniz...']
	) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Oluştur' : 'Güncelle', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
