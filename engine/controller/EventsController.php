<?php

namespace engine\controller;


use engine\core\Controller;
use engine\model\EventsModel;

class EventsController extends Controller {

    private $eventsmodel;

    public function __construct() {
        parent::__construct();
        $this->eventsmodel = new EventsModel();
    }

    public function showEventsAction() {
        $this->view->showPage('events', $this->template, $this->header);
    }

    public function eventsShowContentAction() {
        $data = $this->eventsmodel->makeCal($_POST['year'], $_POST['mon']);
        $pagination = $this->eventsmodel->getNext($_POST['year'], $_POST['mon']);
        $this->view->showContent('events_content', $data, $pagination);
    }

    public function eventsDateShowContentAction() {
        $this->view->showContent('events_day');
    }

}