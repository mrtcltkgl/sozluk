<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sozluk\models\Titles */

$this->title = 'Başlık Oluştur';
$this->params['breadcrumbs'][] = ['label' => 'Başlıklar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
