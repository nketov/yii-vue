<?php


namespace frontend\controllers;

use yii\rest\ActiveController;

class BaseRestController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];


    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formatParam' => 'json',
                'formats' => [
                    'json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];

    }
}