<?php

namespace engine\controller;


use engine\core\Controller;
use engine\model\CatalogModel;

class CatalogController extends Controller {

    private $catalogmodel;

    public function __construct() {
        parent::__construct();
        $this->catalogmodel = new CatalogModel();
    }

    public function showCatalogAction() {
        $data = $this->catalogmodel->getCatalogData($this->access, 10, 1, 10);
        $this->view->showPage('catalog', $this->template, $this->header, $data);
    }

    public function catSelect1Action() {
        $this->catalogmodel->getSelect($_POST);
        exit();
    }

    public function catSelect2Action() {
        $datas = $this->catalogmodel->getCatalog($_POST, $this->session, $this->access);
        if ($datas != false) {
            $data = $datas['data'];
            $pagination = $datas['pagination'];
            $this->view->showContent('catalog_content', $data, $pagination, $this->access);
        }

    }

}