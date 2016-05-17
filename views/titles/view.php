<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sozluk\models\Titles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Başlıklar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Güncelle', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Sil', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Silmekten emin misin?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tag_id',
            'user_id',
            'name',
        ],
    ]) ?>

</div>
