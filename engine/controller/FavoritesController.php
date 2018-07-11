<?php

namespace engine\controller;


use engine\core\Controller;
use engine\model\FavoritesModel;

class FavoritesController extends Controller {

    private $favormodel;

    public function __construct() {
        parent::__construct();
        $this->favormodel = new FavoritesModel();
    }

    public function showFavoritesAction() {
        $this->view->showPage('favorites', $this->template, $this->header);
    }

    public function favorControlAction() {
        $favor = $this->favormodel->checkFavor($this->session, $_POST['id']);
    }

    public function favorPageAction() {
        $datas = $this->favormodel->showFavor($_POST['id'], $this->session);
        $data = $datas['data'];
        $pagination = $datas['pagination'];
        $this->view->showContent('favorites_content', $data, $pagination);
    }

}