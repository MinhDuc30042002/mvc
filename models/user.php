<?php

class User
{

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id, $name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function all()
    {
        $list = [];
        $db = DB::getInstance();

        $query = 'SELECT * FROM users';
        $req = $db->query($query);

        foreach ($req->fetchAll() as $item) {
            $list[] = new User($item['id'], $item['name'], $item['email'],  $item['password']);
        }

        return $list;
    }

    public static function findOrFail($id)
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM users WHERE id = $id";
        $req = $db->prepare($query);
        $req->execute();

        $item = $req->fetch();
        if (isset($item['id'])) {
            return new User($item['id'], $item['name'], $item['email'],  $item['password']);
        }
        return null;
    }

    public static function update($id, $data)
    {
        $query = "UPDATE users SET id = $data->id, email = '$data->email', name = '$data->name', password = md5('$data->password') WHERE id = $id";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();

        return $req;
    }

    public static function delete($id)
    {
        $query = "DELETE FROM users WHERE id = $id";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();

        return $req;
    }

    public static function email_unique($email)
    {
        $email = addslashes($email);
        $query = "SELECT COUNT(*) FROM users WHERE email = '$email'";
        $db = DB::getInstance();
        $req = $db->query($query)->fetchColumn();
        return $req;
    }

    public static function id_unique($id)
    {
        $query = "SELECT COUNT(*) FROM users WHERE id = '$id'";
        $db = DB::getInstance();
        $req = $db->query($query)->fetchColumn();
        return $req;
    }

    public static function store($data)
    {
        $query = "INSERT INTO users (id, name, email, password) VALUES ('$data->id', '$data->name', '$data->email', md5('$data->password') )";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();
        return $req;
    }

    public static function get_user()
    {
        $find_user = Request::firstOrFail();
        $user = User::findOrFail($find_user);
        return $user;
    }

    public static function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $db = DB::getInstance();
        $req = $db->query($query);

        $item = $req->fetch();
        if (isset($item['id'])) {
            return new User($item['id'], $item['name'], $item['email'],  $item['password']);
        }
        return null;
    }

    public static function edit($old_email, $name, $email, $password)
    {
        $query = "UPDATE users SET email = '$email', name = '$name', password = '$password' WHERE email = '$old_email'";
        $db = DB::getInstance();
        $req = $db->prepare($query)->execute();

        return $req;
    }

    
}
