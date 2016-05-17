<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sozluk\models\Tags */

$this->title = 'Etiket Oluştur';
$this->params['breadcrumbs'][] = ['label' => 'Etiketler', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
