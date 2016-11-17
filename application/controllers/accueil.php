<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accueil
 *
 * @author pasquierase
 */
class Accueil extends CI_Controller{
    
    
    ########################################################
    # Parametres d'envoi des sms
    ########################################################
    private $zagsms_user = "237675916748"; //Le Numero de telephone avec lequel vous avez crée votre compte sur ZAGSMS.net au format international.Exemple :23796141711
    private $zagsms_pwd = "testsms"; //Le mot de passe correspondant à votre compte sur ZAGSMS.net
    private $zagsms_url = "http://zagsms.net:80/lang_fr/apicmr.php?action=envoismsun&";
    private $sender;
    private $js = array();
        
    
    
    //put your code here
    /*the constructor*/
    function __construct() {
        
        parent::__construct(); //obligatoire
        // on n'accede pas par url directement
        //if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        
        /*chargement des modèle utiles ici*/
        $this->load->model('adresse/contacts_model');
        $this->load->model('adresse/contacts_model');
        $this->load->model('message/envoiMessage_model');
        $this->load->model('message/statutEnvoi_model');
        $this->load->model('message/programmations_model');
        $this->load->model('adresse/groupes_model');
        $this->load->model('compte/utilisateurs_model');
        
    }
    
    public function index(){
        //$data = array();
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
   
        $this->load->view('accueil', $data);
        //$this->load->view('accueil');
    }
    
    public function new_message($dest = ''){
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
        
        //on charge en mémoire les contacts
        $contacts[] = array();
        
        $result = $this->contacts_model->getAll();
        $taille = 0;
        foreach ($result as $row){
            //echo $row->nom;
            $contacts[$taille] = array('nom'=>$row->nom, 'numero'=>$row->numero1);
            $taille = $taille+1;   
        }
        $data['destinataires'] = $contacts;
        $data['destinataire'] = $dest;
        //$data['taille'] = $taille;
        //$data['taille'] = $taille;
        
        $this->load->view('messages', $data);
    }
    
    public function profil(){
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
        $this->load->view('profile', $data);
    }
    
    public function boite_envoi(){
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
        
        $messages[] = array();
        
        $result = $this->envoiMessage_model->getAll();
        $taille = 0;
        foreach ($result as $row){
            //echo $row->nom;
            $messages[$taille] = array('dateEnvoi'=>$row->dateEnvoi, 'objet'=>$row->objet, 'contenu' => $row->contenu, 'idStatutEnvoi' =>$row->idStatutEnvoi);
            $taille = $taille+1;   
        }
        $data['messages'] = $messages;
        //$data['taille'] = $taille;
        $this->load->view('message_consult', $data);
    }
    
    
    
    
    public function carnet_adresses(){ //ceci affichera a la fois les contacts et les groupes. ainsi nous allons charger ces deux entités
        $data = array(
                'tel' => $this->session->userdata('tel'),
                'nom' => $this->session->userdata('nom'),
                'prenom' => $this->session->userdata('prenom'),
                'credit' => $this->session->userdata('credit'),
                'isLoggedIn'=>TRUE
            );
        //chargement des contacts en mémoire
        $contacts[] = array();
        
        $result = $this->contacts_model->getAll();
        $taille = 0;
        foreach ($result as $row){
            //echo $row->nom;
            $contacts[$taille] = array('nom'=>$row->nom, 'prenom'=>$row->prenom, 'numero1'=>$row->numero1, 'numero2'=>$row->numero2, 'groupe'=>$row->idGroupe);
            $taille = $taille+1;   
        }
        $data['contacts'] = $contacts;
        $data['javs'] = $this->js;
        //$data['taille'] = $taille;
        
        //chargment des groupes
        $groupes[] = array();
        
        $result = $this->groupes_model->getAll();
        $taille = 0;
        foreach ($result as $row){
            //echo $row->nom;
            $groupes[$taille] = array('libelleGroupe'=>$row->libelleGroupe, 'description'=>$row->description);
            $taille = $taille+1;   
        }
        $data['groupes'] = $groupes;
        //$data['taille'] = $taille;
        
        $this->load->view('adresses', $data);
    }
    
    
    public function add_contact(){
        
        $this->load->library('form_validation'); //pour la validation du formulaire
        $this->form_validation->set_rules('nom','"Login"','required');
        $this->form_validation->set_rules('prenom','"Password"','required');
        $this->form_validation->set_rules('numero','"Mobile Number"','trim|required|regex_match[/^[0-9]{12}$/]');
        $this->form_validation->set_rules('ville','"Ville"','required');
        //$this->form_validation->set_rules('groupe','"Groupe"','required'); 
        if ($this->form_validation->run() == FALSE){
           echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
        }
        else{
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $numero = $this->input->post('numero');
            $ville = $this->input->post('ville');
            $groupe = $this->input->post('groupe');
            //echo'<div class="alert alert-dismissable alert-danger"><small>'. $prenom.'</small></div>';
            
            $result = $this->contacts_model->creer(array('nom' => $nom, 'prenom' => $prenom, 'numero1' => $numero, 'numero2' => null, 'numero3' => null, 'ville' => $ville, 'idGroupe' => null, 'login' =>'admin', 'passwd' => 'admin'));
            
            if($result){
                echo'<div class="alert alert-dismissable alert-success"><small>Enregistrement effectué avec succes</small></div>';
            }
            else{
                
                echo'<div class="alert alert-dismissable alert-danger"><small>Nous n\'avons pas pu enrgistrer le contact!</small></div>';
                exit;
            }
        }
    }
    
    /******************************************creation d'un groupe**************************************************/
    public function add_group(){
        $this->load->library('form_validation'); //pour la validation du formulaire
        $this->form_validation->set_rules('nom','"Login"','required');
        $this->form_validation->set_rules('description','"Password"','required');
        //$today = date("Y-m-d");
        //$hour = date("H:i:s"); 
        
        if ($this->form_validation->run() == FALSE){
           echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
        }
        else{
            $nom = $this->input->post('nom');
            $description = $this->input->post('description');
            $today = date("Y-m-d");
            
            $result = $this->groupes_model->creer(array('libelleGroupe' => $nom, 'description' => $description, 'dateCreation' => $today));
            
            if($result){
                echo'<div class="alert alert-dismissable alert-success"><small>Groupe créé avec succes</small></div>';
            }
            else{
                
                echo'<div class="alert alert-dismissable alert-danger"><small>Nous n\'avons pas pu créer le groupe!</small></div>';
                exit;
            }
        }
    }
    /******************************************FIN creation d'un groupe**************************************************/
    
    
    public function del_contact($nom = '', $prenom = '', $numero1 = ''){
       
       $result = $this->contacts_model->supprimer(array('nom'=>$nom, 'prenom'=>$prenom, 'numero1'=>$numero1));
       if($result){
                $this->carnet_adresses();
                echo'<div class="alert alert-dismissable alert-success"><small>Supression effectuée avec succes</small></div>';
            }
            else{
                $this->carnet_adresses();
                echo'<div class="alert alert-dismissable alert-danger"><small>Nous n\'avons pas pu Supprimer le contact!</small></div>';
                exit;
            }
    }
   
    
    public function selection_contacts(){
        
        $this->load->library('form_validation'); //pour la validation du formulaire
        //$this->new_message(implode(";",$this->input->post('contacts')));
        $string = implode("_",$this->input->post('contacts'));
        redirect('/feature/accueil/new_message/'.$string);
        //exit;
        //$data['destinataire'] = implode(";",$this->input->post('contacts'));
        //$this->load->view('messages', $data);
    }
    
    public function envoyer_messages(){
        $this->load->library('form_validation'); //pour la validation du formulaire
        $this->form_validation->set_rules('objet','"Objet"','required');
        $this->form_validation->set_rules('destinataire','"Destinataire"','required|regex_match[/^[0-9]{9}$/]');
        //$this->form_validation->set_rules('groupe','"Groupe"','trim|required|regex_match[/^[0-9]{[9]}$/]');
        //$this->form_validation->set_rules('csv','"Csv"','required');
        $this->form_validation->set_rules('message','"Message"','required');
        if ($this->form_validation->run() == FALSE){
           echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
           //echo $this->input->post('destinataire');
        }
        else{
            $objet = $this->input->post('objet');
            $destinataire = $this->input->post('destinataire');
            $this->sender = $this->session->userdata('tel');
            $message = $this->input->post('message');
            //$groupe = $this->input->post('groupe');
            
            $debug = true;
            $dest = explode('_', $destinataire);
            $today = date("Y-m-d");
            $hour = date("H:i:s"); 
            
            if($this->input->post('action')=='envoyer'){
                foreach ($dest as $r){
                    $response = $this->zagsmsSend($r,$message,$debug);
                    echo $this->session->userdata('tel');
                    $result = $this->envoiMessage_model->creer(array('dateEnvoi' => $today, 'heureEnvoi' => $hour, 'destinataire' => $r, 'idGroupe' => null, 'objet' => $objet, 'contenu' => $message, 'taille' => strlen($message), 'idStatutEnvoi' =>1, 'login' =>'admin', 'passwd' => 'admin'));
                }
                echo'<div class="alert alert-dismissable alert-success"><small>Message envoyé avec succes</small></div>';
            }
            else{
                $date_envoi = $this->input->post('progr_date');
                $heure_envoi = $this->input->post('progr_time');
                foreach ($dest as $r){
                    //$response = $this->zagsmsSend($r,$message,$debug);
                    $result = $this->envoiMessage_model->creer(array('dateEnvoi' => $today, 'heureEnvoi' => $hour, 'destinataire' => $r, 'idGroupe' => null, 'objet' => $objet, 'contenu' => $message, 'taille' => strlen($message), 'idStatutEnvoi' =>2, 'login' =>'admin', 'passwd' => 'admin'));
                    $result2 = $this->programmations_model->creer(array('dateEnvoi' => $date_envoi, 'heureEnvoi' => $heure_envoi, 'dateProgr'=>$today, 'idEnvoi'=>$result));
                }
                
                echo'<div class="alert alert-dismissable alert-success"><small>Message programmé avec succes</small></div>';
            }
            
        }
        
    }
    
    
    
    protected function chargerContacts(){
        $contacts[] = array();
        $result = $this->contacts_model->getAll();
        $taille = 0;
        foreach ($result as $row){
            //echo $row->nom;
            $contacts[$taille] = array('numero1'=>$row->numero1);
            $taille = $taille+1;   
        }
        return $contacts;
    } 
    
    
    
    ########################################################
    # Fonction Utilisée Pour Envoyer Votre SMS
    ########################################################
    protected function httpRequest($url){
        $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
        preg_match($pattern,$url,$args);
        $in = "";
        $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
        if (!$fp) {
           return("$errstr ($errno)");
        } else {
            $out = "GET /$args[3] HTTP/1.1\r\n";
            $out .= "Host: $args[1]:$args[2]\r\n";
            $out .= "User-agent: zagsms PHP client\r\n";
            $out .= "Accept: */*\r\n";
            $out .= "Connection: Close\r\n\r\n";

            fwrite($fp, $out);
            while (!feof($fp)) {
               $in.=fgets($fp, 128);
            }
        }
        fclose($fp);
        return($in);
    }

    protected function zagsmsSend($phone, $msg, $debug){
          
          $url = 'id='.$this->zagsms_user;
          $url.= '&pwd='.$this->zagsms_pwd;
          $url.= '&sender='.urlencode($this->sender);
          $url.= '&codest='.urlencode(237);
          $url.= '&to='.urlencode($phone);
          $url.= '&msg='.urlencode($msg);

          $urltouse =  $this->zagsms_url.$url;


          //Open the URL to send the message
          $response = $this->httpRequest($urltouse);
          if ($debug) {
               if (strpos($response, 'HTTP/1.1 200 OK') !== false){
                   echo 'reussi';
               }
               else{
                  echo 'echec d\'envoi'; 
               }
          }   
          return($response);
    }
    
}
