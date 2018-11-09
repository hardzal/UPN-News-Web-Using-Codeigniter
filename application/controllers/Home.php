<?php
defined('BASEPATH') or exit('No direct access allowed');

class Home extends CI_Controller {
    public function index() {
        $message['pertama'] = "Fokus";
        $message['kedua'] = "Displin";
        $message['ketiga'] = "Konsisten";

        $this->load->view('home', compact('message'));
    }
}

?>