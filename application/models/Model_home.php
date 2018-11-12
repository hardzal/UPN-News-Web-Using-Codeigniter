<?php

    class Model_home extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function tambah($a,$b){
            return $a+$b;
        }
    }

?>