<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author pasquierase
 */
class MY_Controller extends CI_Controller  {
    public $tel = null;
    public $nom = null;
    public $prenom = null;
    public $credit = null;
    public $isLoggedIn = false;
    
    function __construct() {
        parent::__construct();
        
        $this->tel = $this->session->userdata('tel');
        $this->nom = $this->session->userdata('nom');
        $this->prenom = $this->session->userdata('prenom');
        $this->credit = $this->session->userdata('credit');
        $this->isLoggedIn = $this->session->userdata('isLoggedIn');
        
    }
}
