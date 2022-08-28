<?php
require_once('models/user.php');
require_once('request/RuleUser.php');
require_once('validation/ValidationUser.php');

class Authentication extends RuleUser
{
    public $msg;

    public function __construct()
    {
        $this->msg = $this->login();
    }

    public function auth($input)
    {
        $check_input_email = ValidationUser::check_empty($input['email']);
        $check_input_password = ValidationUser::check_empty($input['password']);

        if ($check_input_email) {
            $error_email = $this->msg['email.required'];
        }

        if ($check_input_password) {
            $error_password = $this->msg['password.required'];
        }

        $user = User::login($input['email'], md5($input['password']));
        if ($user) {
            return $user;
        } else {
            $error = $this->msg['unregister'];
        }
        $error = array('email' => $error_email ?? '', 'password' => $error_password ?? '', 'unregister' => $error ?? '');
        return $error;
    }
}
