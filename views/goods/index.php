<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?Modal::begin([
            'header' => '<h2>Visible columns</h2>',
            'toggleButton' => ['label' => 'Settings'],
        ]);?>

        <?$form = \yii\widgets\ActiveForm::begin(['action' => '/user-goods-columns/save'])?>

            <?foreach ($columns as $column => $visible):?>
                <div>
                    <?=Html::checkbox($column, $visible)?> <?=$column?>
                </div>
            <?endforeach;?>

            <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>

        <?\yii\widgets\ActiveForm::end()?>

        <?Modal::end();?>
    </p>

    <p>
        <?$form = \yii\widgets\ActiveForm::begin()?>

            <table class="table">
                <tr>
                    <td>
                        <?=$form->field($searchModel, 'field')->label(false)?>
                    </td>
                    <td>
                        <?=Html::submitButton('Search', ['class' => 'btn btn-success'])?>
                    </td>
                </tr>
            </table>

        <?\yii\widgets\ActiveForm::end()?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'visible' => $columns['id']
            ],
            [
                'attribute' => 'image',
                'format' => ['image', ['width' => 100]],
                'visible' => $columns["image"]
            ],
            [
                'attribute' => 'sku',
                'visible' => $columns['sku']
            ],
            [
                'attribute' => 'name',
                'visible' => $columns['name']
            ],
            [
                'attribute' => 'count',
                'visible' => $columns['count']
            ],
            [
                'attribute' => 'type',
                'visible' => $columns['type']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
