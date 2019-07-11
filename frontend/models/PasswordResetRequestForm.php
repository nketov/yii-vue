<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Url;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Пользователя с таким почтовым ящиком не существует'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        $url = Url::home(true);


        $html ='<h3>Здравствуйте!</h3>'
            . ' Вы отправили запрос на восстановление пароля для  почтового ящика : <b>' . $this->email . "</b><br>"
            . ' Для того чтобы задать новый пароль, перейдите по ссылке ниже ' ."<br>"
            . $url.'password-reset/'.$user->password_reset_token ;

//
//           return  Yii::$app->mailer->compose()
//        ->setTo($this->email)
//        ->setFrom(['mail@opora.dn.ua' => 'Opora'])
//        ->setSubject('Восстановление пароля opora.dn.ua')
//        ->setHtmlBody($html)
//        ->send();

        return mail($this->email, 'Восстановление пароля yii-vue ', $html) ;

    }
}
