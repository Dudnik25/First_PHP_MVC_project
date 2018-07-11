<?php

namespace engine\core;

class View {

    public function showPage($content, $tamplate = 'tamplate_default.php', $header = 'header.php', $data = null) {
        $content .= '.php';
        include ($_SERVER['DOCUMENT_ROOT'] . base_dir . 'engine/view/'. $tamplate);
    }

    public function showContent($content, $data = null, $pagination = null, $access = null) {
        $content .= '.php';
        include ($_SERVER['DOCUMENT_ROOT'] . base_dir . 'engine/view/'. $content);
    }

}