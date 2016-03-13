<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Classify */

$this->title = 'Create Classify';
$this->params['breadcrumbs'][] = ['label' => 'Classifies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classify-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
