<?php

namespace frontend\controllers;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
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
                    'registration' => ['post'],
                    'logout' => ['post'],
                    'password-request' => ['post'],
                    'password-reset' => ['post'],
                    'current-user-info' => ['post'],
                    'save-preferences' => ['post'],
                    'load-preferences' => ['post'],
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


    public function actionRegistration()
    {
        $raw_data = json_decode(Yii::$app->request->getRawBody(), true);
        $model = new SignupForm();
        $model->load($raw_data, '');
        if ($user = $model->signup()) {
            if (Yii::$app->getUser()->login($user)) {
                return ['result' => 'success', 'user_id' => Yii::$app->user->getId()];
            }
        }
        return ['result' => 'error', 'messages' => $model->getFirstErrors()];
    }




    public function actionPasswordRequest()
    {
        $model = new PasswordResetRequestForm();
        $raw_data = json_decode(Yii::$app->request->getRawBody(), true);
        $model->load($raw_data, '');
        if ($model->validate() && $model->sendEmail()) {
                return ['result' => 'success'];
            } else {
                return ['result' => 'error', 'messages' => $model->getFirstErrors()];
            }

    }

    public
    function actionPasswordReset()
    {

        $raw_data = json_decode(Yii::$app->request->getRawBody(), true);

        try {
            $model = new ResetPasswordForm($raw_data['token']);
        } catch (Exception $e) {
            return ['result' => 'error1', 'messages' => $e->getMessage()];

        }
        $model->load($raw_data, '');
        if ($model->validate() && $model->resetPassword()) {
            return ['result' => 'success'];
        } else {
            return ['result' => 'error2', 'messages' => $model->getFirstErrors()];
        }

    }


    public function actionCurrentUserInfo()
    {
        $user = [];
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity->getUserInfo();
        }
        return $user;
    }

    public
    function actionSavePreferences()
    {
        $raw_data = json_decode(Yii::$app->request->getRawBody(), true);
        unset($_COOKIE['preferences']);
        setcookie('preferences', null, -1, '/');
        setcookie("preferences", serialize($raw_data['preferences']), time() + 3600 * 24 * 100, '/');
        return [];
    }


    public  function actionLoadPreferences()
    {

    }



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return [];
    }

}
