<?php

namespace App\Controllers;
use Core\Controller;

class FaqController extends Controller {
    public function index() {
        $this->view('faq/index');
    }
}