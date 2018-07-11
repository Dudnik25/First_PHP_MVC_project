<?php

namespace engine\core;

use R;

class Db {

    private $user;

    public function findUser($login) {
        $this->user = R::findOne('users', 'email=?', array($login));
        if (isset($this->user)) {
            $user = array(
                'email' => $this->user->email,
                'password' => $this->user->password,
                'id' => $this->user->id,
                'access' => $this->user->access
            );
            return $user;
        } else {
            //echo 'Пользователь с таким email не найден!';
        }
    }

    public function loadUser($id) {
        $this->user = R::load('users', $id);
        return $this->user;
    }

    public function loadOne($table, $id) {
        $result = R::load($table, $id);
        return $result;
    }

    public function findAll($value) {
        $result = R::findAll($value);
        return $result;
    }

    public function find($table, $sql, $params) {
        $result = R::findAll($table, $sql. ' = ?', array($params));
        return $result;
    }

    public function saveUserSettings($data) {

    }

}