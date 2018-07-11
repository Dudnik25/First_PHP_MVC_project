<?php

namespace engine\core;

class Controller {

    protected $view;
    protected $template = 'tamplate_default.php';
    protected $header = 'header.php';
    protected $session;
    protected $access = 0;

    public function __construct() {
        $this->view = new View();
        $this->session = Model::check_session();
        if ($this->session != '') {
            $this->access = Model::check_access();
            if ($this->access == 99) {
                $this->header = 'admin/header_admin.php';
            } else {
                $this->header = 'header_user.php';
            }
        }
    }

}