<?php

namespace Controllers;

class IndexController extends Controller {

    public function getHome() {

        $this->render('index');
    }

    public function NotFound() {
        $this->render('errors/404');
    }

}
