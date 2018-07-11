<?php

namespace engine\model;

use engine\core\Model;

class LoginUserModel extends Model {

    public function findUser($post) {
        if ($post['login'] AND $post['password']) {
            $user = $this->db->findUser($post['login']);
            if ($user['email'] == $post['login']) {
                if (password_verify($post['password'], $user['password']) == '1') {
                    $error['err'] = 'none';
                    $error['id'] = $user['id'];
                    $error['access'] = $user['access'];
                } else {
                    $error['err'] = 'Неверный пароль';
                }
            } else {
                $error['err'] = 'Пользователь не найден';
            }
        } else {
            $error['err'] = 'Введите дание';
        }
        return $error;
    }

}