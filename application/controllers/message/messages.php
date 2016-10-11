<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of messages
 *
 * @author pasquierase
 */
class Messages extends MY_Controller{
    //put your code here
    //user: 675916748 password:testsms
    private $zagsms_user = "237675916748"; //Le Numero de telephone avec lequel vous avez crée votre compte sur ZAGSMS.net au format international.Exemple :23796141711
    private $zagsms_pwd = "testsms"; //Le mot de passe correspondant à votre compte sur ZAGSMS.net
    private $zagsms_url = "http://zagsms.net:80/lang_fr/apicmr.php?action=envoismsun&";
    
    private $sender;

    
    /*the constructor*/
    function __construct() {
        
        parent::__construct(); //obligatoire
        
        /*chargement des modèle utiles ici*/
        $this->load->model('message/envoiMessage_model');
        $this->load->model('message/statutEnvoi_model');
        $this->load->model('adresse/contacts_model');
        $this->load->model('adresse/groupes_model');
        $this->load->model('compte/utilisateurs_model');
    }
    
    //the default function
    public function index(){
        //nothing for the moment
        //echo 'gestion des messages ici';
        
    }
    
    protected function envoyer($message, $sender, $receiver){
        $this->sender = $sender;
        $receiver = $receiver;
        $debug = true;
        $dest = explode('_', $receiver);
        foreach ($dest as $r){
            $response = $this->zagsmsSend($r,$message,$debug);
        }
        redirect('feature/accueil/boite_envoi');
        
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
               echo "Reponse: <br><pre>".
               str_replace(array("<",">"),array("&lt;","&gt;"),$response).
               "</pre><br>"; }

          return($response);
    }
    
}
