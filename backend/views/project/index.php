<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';

?>
<div class="box">
    <div class="box-body">

        <p>
            <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'id' => 'project-table',
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'layout' => "{items}{summary}{pager}",

            'pager' => [
                'hideOnSinglePage' => true,
                'prevPageLabel' => 'Педыдущая',
                'nextPageLabel' => 'Следующая',

            ],
            'tableOptions' => ['class' => 'table table-striped table-hover table-responsive '],
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//
//                'id',
                ['attribute' => 'image',
                    'filter' => false,
                    'format' => 'html',
                    'contentOptions' => ['style' => 'min-width:75px;max-width:80px; text-align:center;padding:10px'],
                    'value' => function ($data) {
                        return '<img src="/images/projects/'. $data->image. '?rnd=' . time().'" alt="" style="height:75px;width: 75px">';                         ;

                    },
                ],
                'short_name',
                'title',
//                'description:ntext',
//                'link',
                //'image',
                //'color',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'contentOptions' => ['style' => 'width:35px;text-align:center'],

                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>
