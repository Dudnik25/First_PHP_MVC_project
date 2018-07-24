<?php

namespace engine\controller;

use engine\core\Controller;
use engine\model\UserModel;

class UserController extends Controller {

    private $usermodel;

    public function showUserPageAction($id) {
        $this->usermodel = new UserModel($id);
        if ($this->usermodel->checkUserPage()) {
            if ($this->session == $id) {
                $data = $this->usermodel->checkUserData(2);
            } else {
                $data = $this->usermodel->checkUserData($this->access);
            }
            $this->view->showPage('userpage', $this->template, $this->header, $data);
        } else {
            header("Location: ".base_url. 'error');
        }
    }

    public function showUserSettingsAction() {
        if ($this->session != '') {
            $this->usermodel = new UserModel($_SESSION['logged_user']);
            $data = $this->usermodel->checkUserSettings();
            $this->view->showPage('usersettings', $this->template, $this->header, $data);
        } else {
            header("Location: ". base_url . 'reg');
        }
    }

    public function user_settingsAction () {
        $this->usermodel = new UserModel($this->session);
        $data = $this->usermodel->validateUserSettings($_POST);
        if ($data['errors'] == '') {
            $this->usermodel->saveUserSettings($data);
            echo 'Настройки сохранены';
        } else {
            echo $data['errors'];
        }
    }


}