<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;




class TestController extends Controller
{


    public $layout = '';
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage and all vue.js pages
     *
     * @return string
     */
    public function actionIndex()
    {

        return "<h1>TEST!</h1>";
    }
}
