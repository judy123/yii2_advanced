<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClassifySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Classifies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classify-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Classify', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'pid',
            'orderid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
