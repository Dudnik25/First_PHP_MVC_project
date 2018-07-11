<?php

namespace engine\core;

use R;

class Model {

    protected $db;

    public function __construct() {
        $this->db = new Db();
    }

    public static function check_session() {
        if(isset($_SESSION['logged_user'])) {
            return $_SESSION['logged_user'];
        } else {
            return '';
        }
    }

    public static function check_access() {
        $user = R::load('users', $_SESSION['logged_user']);
        return $user->access;
    }

    public static function check_admin_access($id) {
        $user = R::load('users', $id);
        return $user->access;
    }

    protected function clean($value = "") {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    protected function cleanArray($array = array()) {
        foreach ($array as $name => $value) {
            $this->clean($value);
        }
        return $array;
    }

    protected function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return $result;
    }

}