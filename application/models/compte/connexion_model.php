<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connexion_model
 *
 * @author pasquierase
 */
class connexion_model extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('compte/utilisateurs_model');
    }
    
    function conn($login,$password){
        $result = $this->utilisateurs_model->get(array('login' => $login, 'passwd' => $password));
        if(is_array($result) && count($result) == 1){//connexion success
            /*$data = array(
                'tel' => $result[0]->tel,
                'nom' => $result[0]->nom,
                'prenom' => $result[0]->prenom,
                'credit' => $result[0]->credit,
                'isLoggedIn'=>TRUE
            ); */
            $this->session->set_userdata('tel', $result[0]->tel);
            $this->session->set_userdata('nom', $result[0]->nom);
            $this->session->set_userdata('prenom', $result[0]->prenom);
            $this->session->set_userdata('credit', $result[0]->credit);
            $this->session->set_userdata('isLoggedIn', TRUE);
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}
