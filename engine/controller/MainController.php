<?php

namespace engine\controller;

use engine\core\Controller;

class MainController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function showIndexAction() {
        if ($this->session != '') {
            header("Location: ". base_url . 'id' . $this->session);
        } else {
            $this->view->showPage('main', $this->template, $this->header);
        }
    }

    public function errorPageAction() {
        $this->view->showPage('404', $this->template, $this->header);
    }

}