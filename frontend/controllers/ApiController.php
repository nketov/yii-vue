<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\LoginForm;

class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'login' => ['post'],
                    'logout' => ['post'],
                    'current-user-info' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        $result['token'] = \Yii::$app->request->csrfToken;
        return $result;
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $raw_data = json_decode(Yii::$app->request->getRawBody(), true);
        $model = new LoginForm();
        $model->load($raw_data, '');
        if ($model->login()) {
            return ['result' => 'success', 'user_id' => Yii::$app->user->getId()];
        } else {
            return ['result' => 'error', 'messages' => $model->getFirstErrors()];
        }
    }

    public function actionCurrentUserInfo()
    {
        $user = [];
        if (!Yii::$app->user->isGuest) {
            $user = [
                'id' => Yii::$app->user->identity->id,
                'email' => Yii::$app->user->identity->email,
                'avatar' => Yii::$app->user->identity->avatar ?? ''
            ];
        }
        return $user;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return [];
    }

}
