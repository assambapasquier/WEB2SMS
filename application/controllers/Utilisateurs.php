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
    
    ########################################################
    # Parametres d'envoi des sms
    ########################################################
    private $zagsms_user = "237675916748"; //Le Numero de telephone avec lequel vous avez crée votre compte sur ZAGSMS.net au format international.Exemple :23796141711
    private $zagsms_pwd = "testsms"; //Le mot de passe correspondant à votre compte sur ZAGSMS.net
    private $zagsms_url = "http://zagsms.net:80/lang_fr/apicmr.php?action=envoismsun&";
    private $sender;
    private $js = array();
    
    private $data = array();
    //put your code here
    /*the constructor*/
    function __construct() {
        parent::__construct(); //obligatoire
        /*chargement des modèle utiles ici*/
        $this->load->model('administrateur_model');
        $this->load->model('approvisionnements_model');
        $this->load->model('archivages_model');
        $this->load->model('contacts_model');
        $this->load->model('documentInscriptions_model');
        $this->load->model('envoiMessage_model');
        $this->load->model('forfaitMessages_model');
        $this->load->model('groupes_model');
        $this->load->model('programmations_model');
        $this->load->model('signatures_model');
        $this->load->model('statutEnvoi_model');
        $this->load->model('typeDocInscrs_model');
        $this->load->model('utilisateurs_model');
   
    }
    
    //the default function
    public function index($error=''){
       
       if(!$this->is_logged()){
           $this->data['error'] = $error;
           //echo 'error';
           $this->load->view('index', $this->data); 
       }
       else{
           $this->accueil();
       }
       
    }
    
    public function accueil(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            $this->chargerSession();
            //$this->chargerContext();
            $this->load->view('accueil', $this->data);
        }
    }
    
    public function boite_envoi(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            $this->chargerSession();
            $this->chargerNombreEnvoi($this->data['login'], $this->data['passwd']);
            $this->chargerNombreRecharge($this->data['login'], $this->data['passwd']);
            $this->chargerBoiteEnvoi($this->data['login'], $this->data['passwd']);
            $this->load->view('message_consult', $this->data);
        }
        
    }
    
    public function nouveau_message(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            $this->chargerSession();
            
            $this->data['contacts_envoi'] = $this->input->post('contacts');
            $this->data['groupes_envoi'] = $this->input->post('groupes');
            //$this->data['objet'] = $this->input->post('objet');
            //echo $this->input->post('objet');
            //var_dump($this->data['contacts_envoi']);
            
            $this->chargerContacts($this->data['login'], $this->data['passwd']);
            $this->chargerGroupes($this->data['login'], $this->data['passwd']);
            $this->chargerSignatures($this->data['login'], $this->data['passwd']);
            $this->load->view('messages', $this->data);
        }
        
    }
    
    public function envoyer_messages(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{

            $this->load->library('form_validation'); //pour la validation du formulaire
            $this->form_validation->set_rules('objet','"Objet"','required');
            //$this->form_validation->set_rules('destinataire','"Destinataire"','required|regex_match[/^[0-9]{9}$/]');
            $this->form_validation->set_rules('groupe','"Groupe"','trim');
            //$this->form_validation->set_rules('csv','"Csv"','required');
            $this->form_validation->set_rules('message','"Message"','required');
            $this->form_validation->set_rules('signature','"Signature"','required');
            
            if ($this->form_validation->run() == FALSE){
               echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
               //echo $this->input->post('destinataire');
            }
            else{
                $objet = $this->input->post('objet');
                $destinataire = $this->input->post('destinataire');
                $this->sender = $this->session->userdata('tel');
                $message = $this->input->post('message');
                $signature = $this->input->post('signature');
                $groupe = $this->input->post('groupe');

                $debug = true;
                $dest = explode(';', $destinataire);
                $today = date("Y-m-d");
                $hour = date("H:i:s"); 

                if($this->input->post('action')=='envoyer'){
                    if($groupe == null){//send to contacts
                        $succes = true;
                        $regex = true;
                        $mauvais_num = null;
                        foreach ($dest as $r){
                            if(preg_match("/^[0-9]{9}$/", $r)){
                                if(!$this->zagsmsSend((int)$r,$message,$debug)) $succes = false;
                                //echo $this->session->userdata('tel');
                                $result = $this->envoiMessage_model->creer(array('dateEnvoi' => $today, 'heureEnvoi' => $hour, 'destinataire' => $r, 'idGroupe' => null, 'objet' => $objet, 'contenu' => $message, 'taille' => strlen($message), 'idStatutEnvoi' =>1, 'login' =>'admin', 'passwd' => 'admin'));
                            }
                            else{
                                $succes = false;
                                $regex = false;
                                $mauvais_num = $r;
                            }

                        }
                        if($succes){
                            $this->chargerSession();
                            $this->chargerNombreEnvoi($this->data['login'], $this->data['passwd']);
                            $this->chargerNombreRecharge($this->data['login'], $this->data['passwd']);
                            $this->chargerBoiteEnvoi($this->data['login'], $this->data['passwd']);
           
                            $this->data["message_sent"] = "OK";
                            $this->load->view('message_consult', $this->data);
                            
                        }
                        else{
                            $this->chargerSession();
            
                            $this->chargerContacts($this->data['login'], $this->data['passwd']);
                            $this->chargerGroupes($this->data['login'], $this->data['passwd']);
                            $this->chargerSignatures($this->data['login'], $this->data['passwd']);
                            
                            $this->data["message_sent"] = "KO";
                            $this->load->view('messages', $this->data);
                        }
                    }
                    else{//send to a group
                        $g = explode(';', $groupe);
                        foreach ($g as $x){
                            $contacts[] = array();
                            $contacts = $this->chargerContactsGroupes($x);
                            $succes = true;
                            $regex = true;
                            $mauvais_num = null;
                            foreach ($contacts as $r){
                                foreach ($r as $v){
                                    if(preg_match("/^[0-9]{9}$/", $v)){
                                        if(!$this->zagsmsSend((int)$v,$message,$debug)) $succes = false;
                                        //echo $this->session->userdata('tel');
                                        $result = $this->envoiMessage_model->creer(array('dateEnvoi' => $today, 'heureEnvoi' => $hour, 'destinataire' => $v, 'idGroupe' => null, 'objet' => $objet, 'contenu' => $message, 'taille' => strlen($message), 'idStatutEnvoi' =>1, 'login' =>'admin', 'passwd' => 'admin'));
                                    }
                                    else{
                                        $succes = false;
                                        $regex = false;
                                        $mauvais_num = $v;
                                    }
                                }
                                
                            }
                        }
                        
                        if($succes){
                            $this->data["message_sent"] = "OK";
                            $this->load->view('message_consult', $this->data);
                            
                        }
                        else{
                            $this->data["message_sent"] = "KO";
                            $this->load->view('messages', $this->data);
                        }
                    }
 
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
    }
    
    public function carnet_adresse(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            
        }
    }
    
    public function boite_envoie(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
           
        }
    }
    
    public function archives(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            
        }
    }
    
    public function profile(){
        if(!$this->is_logged()){
            redirect('', 'refresh');
        }
        else{
            
        }
    }
    /**************************************authentification***************************************************************/
    
    public function connexion(){
        $this->load->library('form_validation'); //pour la validation du formulaire
        //$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
        $this->form_validation->set_rules('login','"Login"','required');
        $this->form_validation->set_rules('password','"Password"','required');
        
        if($this->form_validation->run())
        {
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $result = $this->utilisateurs_model->get(array('login' => $login, 'passwd' => $password));
            if(is_array($result) && count($result) == 1){
                $this->data = array(
                    'login' => $result[0]->login,
                    'passwd' => $result[0]->passwd,
                    'nom' => $result[0]->nom,
                    'prenom' => $result[0]->prenom,
                    'tel' => $result[0]->tel,
                    'credit' => $result[0]->credit,
                    'numeroDoc' => $result[0]->numeroDoc,
                    'isLoggedIn'=>TRUE
                );
                $this->session->set_userdata($this->data);
                redirect('Utilisateurs/accueil', 'refresh');
            }
            else{
                $this->index($error="login");
                //echo 'eeror';
            }
        }
        else{
            $this->index($error="login");
            
            //echo'<div class="alert alert-dismissable alert-danger"><small>Login et/ou Mot de passe inconrrect(s) </small></div>';
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
    

    public function deconnexion(){
        $this->data['isLoggedIn'] = FALSE;
        $this->session->sess_destroy();
        
        redirect('Utilisateurs/', 'refresh');
        exit;
    }
    /******************************************************************************************************************/
    
    /****************************chargement des objets****************************************************************/
    
    protected function chargerSession(){
        $this->data = array(
            'login' => $this->session->userdata('login'),
            'passwd' => $this->session->userdata('passwd'),
            'nom' => $this->session->userdata('nom'),
            'prenom' => $this->session->userdata('prenom'),
            'tel' => $this->session->userdata('tel'),
            'credit' => $this->session->userdata('credit'),
            'numeroDoc' => $this->session->userdata('numeroDoc'),
            'isLoggedIn'=>TRUE
        );
    }
    
    public function chargerContacts($login, $passwd){
        $cont[] = array();
        //$result2 = $this->lignePerms_model->get(array('Permanences'=>$idperm));
        $result2 = $this->contacts_model->get(array('login'=>$login, 'passwd'=>$passwd));
        $taille = 0;
        //var_dump($result2);
        foreach ($result2 as $row2){
               $cont[$taille] = array('idContact'=>$row2->idContact, 'nom'=>$row2->nom, 'prenom'=>$row2->prenom, 'numero1'=>$row2->numero1,'idGroupe'=>$row2->idGroupe);
               //$lps[$taille] = array('id'=>$row2->id, 'date_perm'=>$row2->date_perm);
               $taille = $taille+1;  
        }
        $this->data['contacts'] = $cont;
    }
    
    public function chargerContactsGroupes($groupe){
        $cont[] = array();
        //$result2 = $this->lignePerms_model->get(array('Permanences'=>$idperm));
        $result2 = $this->contacts_model->get(array('idGroupe'=>$groupe));
        $taille = 0;
        //var_dump($result2);
        foreach ($result2 as $row2){
               $cont[$taille] = array('numero1'=>$row2->numero1);
               //$lps[$taille] = array('id'=>$row2->id, 'date_perm'=>$row2->date_perm);
               $taille = $taille+1;  
        }
        return $cont;
    }
    
    public function chargerGroupes($login, $passwd){
        $grp[] = array();
        //$result2 = $this->lignePerms_model->get(array('Permanences'=>$idperm));
        $result2 = $this->groupes_model->get(array('login'=>$login, 'passwd'=>$passwd));
        $taille = 0;
        //var_dump($result2);
        foreach ($result2 as $row2){
               $grp[$taille] = array('idGroupe'=>$row2->idGroupe, 'libelleGroupe'=>$row2->libelleGroupe, 'description'=>$row2->description);
               //$lps[$taille] = array('id'=>$row2->id, 'date_perm'=>$row2->date_perm);
               $taille = $taille+1;  
        }
        $this->data['groupes'] = $grp;
    }
    
    public function chargerSignatures($login, $passwd){
        $sign[] = array();
        //$result2 = $this->lignePerms_model->get(array('Permanences'=>$idperm));
        $result2 = $this->signatures_model->get(array('login'=>$login, 'passwd'=>$passwd));
        $taille = 0;
        //var_dump($result2);
        foreach ($result2 as $row2){
               $sign[$taille] = array('id'=>$row2->id, 'libelle'=>$row2->libelle);
               //$lps[$taille] = array('id'=>$row2->id, 'date_perm'=>$row2->date_perm);
               $taille = $taille+1;  
        }
        $this->data['signatures'] = $sign;
    }
    
    public function chargerBoiteEnvoi($login, $passwd){
        $be[] = array();
        //$result2 = $this->lignePerms_model->get(array('Permanences'=>$idperm));
        $result2 = $this->envoiMessage_model->boite_envoi($login, $passwd);
        
        //var_dump($result2);
        foreach ($result2 as $row2){
               $be[$taille] = array('idEnvoi'=>$row2->idEnvoi, 'dateEnvoi'=>$row2->dateEnvoi, 'heureEnvoi'=>$row2->heureEnvoi,
                   'destinataire'=>$row2->destinataire, 'Contacts'=>$row2->Contacts, 'idGrp'=>$row2->idGrp,
                   'objet'=>$row2->objet, 'contenu'=>$row2->contenu, 'taille'=>$row2->taille,
                   'libelleStatut'=>$row2->libelleStatut, 'idContact'=>$row2->idContact, 'nomContact'=>$row2->nomContact,
                   'numero1'=>$row2->numero1, 'idGroupe'=>$row2->idGroupe, 'libelleGroupe'=>$row2->libelleGroupe);
               //$lps[$taille] = array('id'=>$row2->id, 'date_perm'=>$row2->date_perm);
               $taille = $taille+1;  
        }
        $this->data['boite_envoi'] = $be;
    }
    
    public function chargerNombreEnvoi($login, $passwd){
        $result2 = $this->envoiMessage_model->count(array('login'=>$login, 'passwd'=>$passwd, 'idStatutEnvoi'=>1));
        if($result2){
            $this->data['nbre_envoi'] = $result2;
        }
        else{
            $this->data['nbre_envoi'] = 0;
        }
    }
    
    public function chargerNombreRecharge($login, $passwd){
        $result2 = $this->approvisionnements_model->count(array('login'=>$login, 'passwd'=>$passwd));
        if($result2){
            $this->data['nbre_approv'] = $result2;
        }
        else{
            $this->data['nbre_approv'] = 0;
        }
    }
    
    /******************************************************************************************************************/
    
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
                   return true;
               }
               else{
                  return false; 
               }
          }   
          else{
              return false;
          }
          //return($response);
    }
}
