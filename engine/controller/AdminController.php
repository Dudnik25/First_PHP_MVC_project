<?php

namespace engine\controller;

use engine\core\Controller;
use engine\model\AdminModel;
use engine\model\UserModel;

class AdminController extends Controller {

    private $adminmodel;

    public function __construct() {
        parent::__construct();
        $this->adminmodel = new AdminModel();
    }

    public function loginPageShowAction() {
        if (isset($_SESSION['logged_admin']) && $_SESSION['logged_admin'] == true) {
            $this->view->showPage('admin\admin_page', 'admin\tamplate_admin.php', 'admin\header_admin.php');
        } else {
            header("Location: ".base_url. 'error');
        }
    }

    public function getAdminPageContentAction() {
        if (isset($_POST['id'])&& isset($_SESSION['logged_admin']) && $_SESSION['logged_admin'] == true) {
            $datas = $this->adminmodel->getAdminPageContent($_POST['id'], $this->session);
            if ($datas != false) {
                $data = $datas['data'];
                $pagination = $datas['pagination'];
                $this->view->showContent('admin\admin_page_content', $data, $pagination);
            }
        }
    }

    public function userPageShowAction($id) {
        if (isset($_SESSION['logged_admin']) && $_SESSION['logged_admin'] == true) {
            $usermodel = new UserModel($id);
            if ($usermodel->checkUserPage()) {
                $data = $usermodel->checkUserData(2);
                $this->view->showPage('userpage', $this->template, 'admin\header_admin.php', $data);
            } else {
                header("Location: " . base_url . 'error');
            }
        } else {
            header("Location: " . base_url);
        }
    }

}