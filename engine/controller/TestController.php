<?php

namespace engine\controller;

use R;
class TestController
{


    public function TestAction() {
        echo '<pre>';
        print_r($_SERVER);
    }
}