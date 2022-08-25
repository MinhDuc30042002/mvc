<?php

require_once('models/user.php');
require_once('request/RuleUser.php');

class ValidationUser extends RuleUser
{
    public $msg;

    public function __construct()
    {
        $this->msg = $this->message();
    }

    public static function hash_password($pwd)
    {
        return md5($pwd);
    }

    public static function unique_email($str)
    {
        $is_email = User::email_unique($str);
        return $is_email;
    }
    public static function is_email($str)
    {
        $is_email = User::email_unique($str);
        if ($is_email > 0) {
            return 'Error';
        } else {
            if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
                return strip_tags(trim($str));
            } else {
                return 'Format';
            }
        }
    }
    public static function is_id($id)
    {
        $is_email = User::id_unique($id);
        if ($is_email > 0) {
            return 'Error';
        } else {
            return $id;
        }
    }
    public static function validate_input($str)
    {
        if (strlen($str) == 0) {
            return $str = '';
        } else {
            return htmlspecialchars(strip_tags(trim($str)));
        }
    }
    public static function validate_password($str)
    {
        // least 8 characters, 2 numbers, least .
        $pattern = "/^(?=.*[.]{1,})(?=.*[0-9]{2}).{8,}/";
        $pattern_password = preg_match($pattern, $str);
        if (strlen($str) == 0) {
            return $str = '';
        }

        if ($pattern_password > 0) {
            return htmlspecialchars(strip_tags(trim($str)));
        } else {
            return 'Error';
        }
    }
    public static function check_empty($str)
    {
        return strlen($str) == 0 ? TRUE : FALSE;
    }
    public function check_input_id($input_id)
    {
        $key = 'used';

        if (ValidationUser::check_empty($input_id)) {
            $key = 'required';
        } else if (ValidationUser::is_id($input_id) == 'Error') {
            $key = 'unique';
        }

        return $this->msg['id.' . $key];
    }
    public function check_input_name($input_name)
    {
        $key = 'used';

        if (ValidationUser::check_empty($input_name)) {
            $key = 'required';
        }

        return $this->msg["name." . $key];
    }
    public function check_input_email($input_email)
    {
        $key = 'used';

        if (ValidationUser::check_empty($input_email)) {
            $key = 'required';
        } else if (ValidationUser::is_email($input_email) == 'Error') {
            $key = 'unique';
        } else if (ValidationUser::is_email($input_email) == 'Format') {
            $key = 'pattern';
        }

        return $this->msg["email." . $key];
    }
    public function check_input_password($input_password)
    {
        $key = 'used';

        if (ValidationUser::check_empty($input_password)) {
            $key = 'required';
        } else if (ValidationUser::validate_password($input_password) == 'Error') {
            $key = 'pattern';
        }
        return $this->msg["password." . $key];
    }
    public function value_id($value_id, $user_id): array
    {
        $input_id = '';

        // Check id
        if ($value_id == $user_id) {
            $input_id = $value_id;
        } else {
            $check_id = $this->check_input_id($value_id);
            if ($check_id == $this->msg['id.used']) {
                $input_id = $value_id;
            }
        }
        $array = array(
            'id' => $input_id,
            'error_id' => $check_id ?? ''
        );

        return $array;
    }
    public function value_name($value_name, $user_name): array
    {
        $input_name = '';

        // Check name
        if ($value_name == $user_name) {
            $input_name = $value_name;
        } else {
            $check_name = $this->check_input_name($value_name);
            if ($check_name == $this->msg['name.used']) {
                $input_name = $value_name;
            }
        }
        $array = array(
            'name' => $input_name,
            'error_name' => $check_name ?? ''
        );

        return $array;
    }
    public function value_email($value_email, $user_email): array
    {
        $input_email = '';

        // Check email
        if ($value_email == $user_email) {
            $input_email = $value_email;
        } else {
            $check_email = $this->check_input_email($value_email);
            if ($check_email == $this->msg['email.used']) {
                $input_email = $value_email;
            }
        }
        $array = array(
            'email' => $input_email,
            'error_email' => $check_email ?? ''
        );
        return $array;
    }
    public function value_password($value_password, $user_password): array
    {
        $input_password = '';

        // Check password
        if ($value_password == $user_password) {
            $input_password = $value_password;
        } else {
            $check_password = $this->check_input_password($value_password);
            if ($check_password == $this->msg['password.used']) {
                $input_password = md5($value_password);
            }
        }
        $array = array(
            'password' => $input_password,
            'error_password' => $check_password ?? ''
        );
        return $array;
    }

    public function update_user($user, $data)
    {
        $value_and_error_id = $this->value_id($data['id'], $user->id);
        $value_and_error_name = $this->value_name($data['name'], $user->name);
        $value_and_error_email = $this->value_email($data['email'], $user->email);
        $value_and_error_password = $this->value_password($data['pass'], $user->password);

        $errors = array(
            'id' =>  $value_and_error_id['error_id'],
            'name' =>  $value_and_error_name['error_name'],
            'email' =>  $value_and_error_email['error_email'],
            'pass' =>  $value_and_error_password['error_password'],
        );

        if ($value_and_error_id['id'] != '' && $value_and_error_name['name'] != '' && $value_and_error_email['email'] != '' && $value_and_error_password['password'] != '') {
            $new_user = new User($value_and_error_id['id'], $value_and_error_name['name'], $value_and_error_email['email'], $value_and_error_password['password']);
        }

        $arr = array(
            'errors' => $errors,
            'update_user' => $new_user ?? []
        );

        return $arr;
    }

    public function edit($user, $data)
    {
        $name = $this->value_name($data['name'], $user->name);
        $email = $this->value_email($data['email'], $user->email);
        $password = $this->value_password($data['pass'], $user->password);

        $errors = array(
            'name' =>  $name['error_name'],
            'email' =>  $email['error_email'],
            'pass' =>  $password['error_password'],
        );
        $us = array(
            'name' =>  $name['name'],
            'email' =>  $email['email'],
            'pass' =>  $password['password'],
        );

        $arr = array(
            'errors' => $errors,
            'update_user' => $us ?? []
        );

        return $arr;
    }

    public function store_user($data = array())
    {
        $id = $this->check_input_id($data['id']);
        $name = $this->check_input_name($data['name']);
        $email = $this->check_input_email($data['email']);
        $password = $this->check_input_password($data['pass']);

        $id_value = $id == $this->msg['id.used'] ? $data['id'] : '';
        $name_value = $name == $this->msg['name.used'] ? $data['name'] : '';
        $email_value = $email == $this->msg['email.used'] ? $data['email'] : '';
        $password_value = $password == $this->msg['password.used'] ? $data['pass'] : '';

        if ($id_value != '' && $name_value != '' && $email_value != '' && $password_value != '') {
            $user = new User($id_value, $name_value, $email_value, $password_value);
        }

        $errors = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
        );

        $store_user = array(
            'errors' => $errors,
            'user' => $user ?? []
        );
        return $store_user;
    }
}
