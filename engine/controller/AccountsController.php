<?php

namespace engine\controller;

use engine\core\Controller;
use engine\model\LoginUserModel;
use engine\model\RegisterUserModel;

class AccountsController extends Controller
{

    private $regmodel;
    private $loginmodel;

    public function __construct() {
        parent::__construct();
        $this->regmodel = new RegisterUserModel();
        $this->loginmodel = new LoginUserModel();
    }

    public function showRegAction() {
        $params = $this->regmodel->findRegParams();
        $this->view->showPage('reg', $this->template, $this->header, $params);
    }

    public function user_registerAction() {
        $data = $this->regmodel->validationRegister($_POST);
        if ($data['errors'] == '') {
            $this->regmodel->saveUser($data);
            echo 'Вы зарегестрированы';
        } else {
            echo $data['errors'];
        }
    }

    public function user_logginAction() {
        $user = $this->loginmodel->findUser($_POST);
        if ($user['err'] == 'none') {
            if ($user['access'] == 99) {
                $_SESSION['logged_admin'] = true;
            }
            $_SESSION['logged_user'] = $user['id'];
            echo 'redirect===' . base_url . 'id' . $user['id'];
        } else {
            echo $user['err'];
        }
    }

    public function logoutAction() {
        unset( $_SESSION['logged_user']);
        if (isset($_SESSION['logged_admin'])) {
            unset($_SESSION['logged_admin']);
        }
        session_destroy();
        header("Location: " .base_url);
        exit;
    }

}