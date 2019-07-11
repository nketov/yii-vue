<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $phone;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким почтовым ящиком уже зарегистрирован.'],
            ['phone', 'string', 'min' => 12, 'message' => 'Неверный номер'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }


    public function attributeLabels()
    {
        return [

            'email' => 'E-mail',
            'password' => 'Пароль',
            'phone' => 'Телефон'
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->setPassword($this->password);
        $user->generateAuthKey();
         if ($user->save()){
             return $user;
         } else {
             return false;
         }
    }



    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
