<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Classify */

$this->title = 'Update Classify: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Classifies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="classify-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
