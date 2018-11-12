<?php
defined('BASEPATH') or exit('No direct access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_home');
    }

    public function index(){
        $this->load->view('view_home');
    }

    public function sum(){
        $a = $this->input->post('a');
        $b = $this->input->post('b');

        $hasil = $this->model_home->tambah($a,$b);

        echo $hasil;

    }



    // public function index() {
    //     $message["pelatihan"]  = "CodeIgniter";
    //     return $this->load->view('view_home', compact('message'));
    // }
}

?>