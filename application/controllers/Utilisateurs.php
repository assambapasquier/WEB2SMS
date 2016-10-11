<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilisateurs
 *
 * @author pasquierase
 */
class Utilisateurs extends CI_Controller{
    
    
    //put your code here
    /*the constructor*/
    function __construct() {
        
        parent::__construct(); //obligatoire
        
        /*chargement des modèle utiles ici*/
        $this->load->model('compte/utilisateurs_model');
        
        
    }
    
    //the default function
    public function index(){
       if(!$this->is_logged()){
           $this->sign_in();
       }
       else{
           $this->accueil();
       }
       
    }
    
    public function sign_in(){
        $this->load->view('index'); 
    }
    
    public function enregistrer()
    {
      //$this->load->view('view_register');  
    }
    
    public function login(){
        $this->load->library('form_validation'); //pour la validation du formulaire
        //$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
        $this->form_validation->set_rules('login','"Login"','required');
        $this->form_validation->set_rules('password','"Password"','required');
        
        if ($this->form_validation->run() == FALSE){
           echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
        }
        else{
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            if($this->conn($login, $password)){
                //$this->load->view('accueil');
            }
            else{
                echo'<div class="alert alert-dismissable alert-danger"><small>Login et/ou Mot de passe inconrrect(s) </small></div>';
            }
        }
    }
    
    public function accueil(){
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
        $this->load->view('accueil', $data);
        /*if($this->is_logged_in()) {
            $this->load->view('compte/logged_view');
            //redirect('compte/utilisateurs/logged_in');
        } else {
            $this->sign_in();
        } */ 
    }
   
   public function deconnexion(){
        $this->session->sess_destroy();
        
        redirect('Utilisateurs/', 'refresh');
        exit;
    }
    
    protected function conn($login, $password){
        $result = $this->utilisateurs_model->get(array('login' => $login, 'passwd' => $password));
        if(is_array($result) && count($result) == 1){//connexion success
            $this->data = array(
                'tel' => $result[0]->tel,
                'nom' => $result[0]->nom,
                'prenom' => $result[0]->prenom,
                'credit' => $result[0]->credit,
                'isLoggedIn'=>TRUE
            );
            $this->session->set_userdata($this->data);
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    private function is_logged(){
        if($this->session->userdata('isLoggedIn')!==null && $this->session->userdata('isLoggedIn')){
            return TRUE;
        }
        else{
            return FALSE;
        }
        
    }
}
