<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author pasquierase
 */
class Utilisateur extends CI_Controller{
    
    private $data = array();
    private $filtre1 = array();
    
    //put your code here
    function __construct() {  
        parent::__construct(); //obligatoire
        /*chargement des modèle utiles ici*/
        $this->load->model('plannif/astreintes_model'); 
        $this->load->model('plannif/lieu_model'); 
        $this->load->model('plannif/ligneAstrs_model'); 
        $this->load->model('plannif/lignePerms_model'); 
        $this->load->model('plannif/lignePerms_Utilisateurs_model'); 
        $this->load->model('plannif/permanences_NumeroUtiles_model'); 
        $this->load->model('plannif/numeroUtiles_model'); 
        $this->load->model('plannif/permanences_model'); 
        $this->load->model('plannif/villes_model'); 
        $this->load->model('utils/services_model'); 
        $this->load->model('utils/departements_model');
        $this->load->model('utils/directions_model'); 
        
    }
    
    //the default function
    public function index($error=''){
        //on affiche le formulaire de recherche en principe (service, ville, permanence, astreinte...)
        //$this->chargerDepartements();
        //$this->chargerDirections();
        //$this->chargerServices();
        //$this->chargerVilles();
        $this->data['error'] = $error;
        $this->load->view('utils/page_accueil', $this->data); 
    }
    
    public function index($error=''){
        //on affiche le formulaire de recherche en principe (service, ville, permanence, astreinte...)
        //$this->chargerDepartements();
        //$this->chargerDirections();
        //$this->chargerServices();
        //$this->chargerVilles();
        $this->data['error'] = $error;
        $this->load->view('utils/page_accueil', $this->data); 
    }
    
    public function recherche_a($error=''){
        $cond = array();
        $this->chargerDepartements();
        $this->chargerDirections();
        $this->chargerServices($cond);
        $this->chargerVilles();
        $this->data['error'] = $error;
        $this->load->view('utils/form_recherche', $this->data);   
    }
    
    public function filtre1(){
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        
        $this->load->library('form_validation'); //pour la validation du formulaire
        //$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
        $this->form_validation->set_rules('mc','"Mot Cle"','required|encode_php_tags');
        $this->form_validation->set_rules('ville','"Ville"','required|encode_php_tags');
        if($this->form_validation->run()){
            $mc = $this->input->post('mc');
            $ville = $this->input->post('ville');
            
            $this->deptFiltre1($mc);
            $this->villeFiltre1($ville);
            
            $this->data['f1'] = $this->filtre1;
            $this->session->set_userdata($this->data);
            redirect('utilisateur/resultat_recherche', 'refresh');
            
        }
        else{
            //echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
            $this->index($error="error");
        }
    }
    
    public function filtre2(){
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        
        $this->load->library('form_validation'); //pour la validation du formulaire
        //$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
        $this->form_validation->set_rules('service','"Service"','trim|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('departement','"Departement"','trim|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('direction','"Direction"','trim|alpha_dash|encode_php_tags');
        if($this->form_validation->run())
        {   
            $service = $this->input->post('service');
            $departement = $this->input->post('departement');
            $direction = $this->input->post('direction');
            $ville = $this->input->post('ville');
            
            if($ville=='0' || $departement=='0' || $direction=='0' || $service=='0'){
               //$this->recherche_a($error="error");
                redirect('utilisateur/recherche_a/"error"', 'refresh');
            }
            
            /*$this->data = array(
                    'dir' => $direction,
                    'dept' => $departement,
                    'ser' => $service,
                    'vil' => $ville,
                );
                $this->session->set_userdata($this->data);*/
            $this->deptFiltre2($departement);
            $this->villeFiltre2($ville);
            
            $this->data['f1'] = $this->filtre1;
            $this->session->set_userdata($this->data);
            //echo $ville;
            redirect('utilisateur/resultat_recherche', 'refresh');
            //redirect('utilisateur/plannif', 'refresh');
        }
        else
        {
            //$this->load->view('accueil_u'); 
            //$this->plannif($direction, $departement, $service, $ville);
            redirect('utilisateur/recherche_a/"error"', 'refresh');
        }
    }
    
    public function resultat_recherche(){
        $this->chargerSession();
        $this->load->view('accueil_u', $this->data);
    }
    
    public function permanence($id='', $start='', $end='', $service=''){
        if($id!=null){
            $this->chargerSession();
            $this->data['dept_id'] = $id;
            $this->session->set_userdata($this->data);
            $cond = array('Departements'=>$id);
            $this->chargerServices($cond);
            //var_dump($this->data['services']);
            $this->data['nom_dept'] = $this->getNomDept($id);

            //$this->chargerPermanences($this->data['dir'], $this->data['dept'], $this->data['ser'], $this->data['vil']);
            if($start==null || $end==null){
                //echo 'hey';
                $now = new DateTime();
                $start = date_format(new DateTime(), 'Y-m-d');
                $end = $now->add(new DateInterval('P1W'))->format('Y-m-d');
                $this->data['startdate'] = $start;
                $this->data['enddate'] = $end;

                $this->chargerPermanences(null, $id, null, $this->data['f1']['villef1'][0]['id'], $start, $end, $service);
                $this->load->view('permanences_u', $this->data);
            }
            else{
                $this->data['startdate'] = $start;
                $this->data['enddate'] = $end;
                $this->chargerPermanences(null, $id, null, $this->data['f1']['villef1'][0]['id'], $start, $end, $service);
                $this->load->view('permanences_u', $this->data);
            }
        }
        else{
            redirect('', 'refresh');
        }
        
        //var_dump($this->data['permChoisies']);
    }
    
    public function traitement_filtre_perm(){
        $this->chargerSession();
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('intervalle','"Intervalle"','encode_php_tags');
        $this->form_validation->set_rules('service','"Service"','encode_php_tags');
        if($this->form_validation->run())
        {   
            $intervalle = $this->input->post('intervalle');
            $service = $this->input->post('service');
            $date = explode('-', $intervalle);
            $start = date("Y-m-d", strtotime($date[0]));
            $end = date("Y-m-d", strtotime($date[1]));
            
            //$this->permanence($id, $start, $end);
            redirect('utilisateur/permanence/'.$this->data['dept_id'].'/'.$start.'/'.$end.'/'.$service, 'refresh');
        }
        else{
            echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
        }
    }
    
    public function astreinte($id='', $start='', $end='', $service=''){
        if($id!=null){
            $this->chargerSession();
            $this->data['dept_id'] = $id;
            $this->session->set_userdata($this->data);
            $cond = array('Departements'=>$id);
            $this->chargerServices($cond);
            //var_dump($this->data['services']);
            $this->data['nom_dept'] = $this->getNomDept($id);

            //$this->chargerPermanences($this->data['dir'], $this->data['dept'], $this->data['ser'], $this->data['vil']);
            if($start==null || $end==null){
                //echo 'hey';
                $now = new DateTime();
                $start = date_format(new DateTime(), 'Y-m-d');
                $end = $now->add(new DateInterval('P1W'))->format('Y-m-d');
                $this->data['startdate'] = $start;
                $this->data['enddate'] = $end;

                $this->chargerAstreintes(null, $id, null, $this->data['f1']['villef1'][0]['id'], $start, $end, $service);
                $this->load->view('astreintes_u', $this->data);
            }
            else{
                $this->data['startdate'] = $start;
                $this->data['enddate'] = $end;
                $this->chargerAstreintes(null, $id, null, $this->data['f1']['villef1'][0]['id'], $start, $end, $service);
                $this->load->view('astreintes_u', $this->data);
            }


            //var_dump($this->data['astrChoisies']);
        }
        else{
            redirect('', 'refresh');
        }
    }
    
    public function traitement_filtre_astr(){
        $this->chargerSession();
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('intervalle','"Intervalle"','encode_php_tags');
        $this->form_validation->set_rules('service','"Service"','encode_php_tags');
        if($this->form_validation->run())
        {   
            $intervalle = $this->input->post('intervalle');
            $service = $this->input->post('service');
            $date = explode('-', $intervalle);
            $start = date("Y-m-d", strtotime($date[0]));
            $end = date("Y-m-d", strtotime($date[1]));
            
            //$this->permanence($id, $start, $end);
            redirect('utilisateur/astreinte/'.$this->data['dept_id'].'/'.$start.'/'.$end.'/'.$service, 'refresh');
        }
        else{
            echo'<div class="alert alert-dismissable alert-danger"><small>'. validation_errors().'</small></div>';
        }
    }
    
    protected function chargerSession(){
        $this->data = array(
            'dir' => $this->session->userdata('dir'),
            'dept' => $this->session->userdata('dept'),
            'ser' => $this->session->userdata('ser'),
            'vil' => $this->session->userdata('vil'),
            'dept_id'=>$this->session->userdata('dept_id'),
            'f1'=>$this->session->userdata('f1')
        );
    }
    
    /*******************************************chargement des objets persistants***********************************/
    /**************************************************************************************************************/
    /***************************************************************************************************************/
    
    protected function chargerServices($cond){
        $services[] = array();
        if($cond == array()){
            $result = $this->services_model->getAll();
        }
        else{
            $result = $this->services_model->get($cond);
        }
        
        $taille = 0;
        foreach ($result as $row){
               $services[$taille] = array('id'=>$row->id, 'nom_service'=>$row->nom_service, 'Departements'=>$row->Departements, 'Directions'=>$row->Directions);
               $taille = $taille+1;  
        }
        $this->data['services'] = $services;
        
    }
    
    protected function chargerDepartements(){
        $departements[] = array();
        $result = $this->departements_model->getAll();
        $taille = 0;
        foreach ($result as $row){
               $departements[$taille] = array('id'=>$row->id, 'libelle'=>$row->libelle, 'Directions'=>$row->Directions);
               $taille = $taille+1;  
        }
        $this->data['departements'] = $departements;
        
    }
    
    protected function chargerDirections(){
        $directions[] = array();
        $result = $this->directions_model->getAll();
        $taille = 0;
        foreach ($result as $row){
               $directions[$taille] = array('id'=>$row->id, 'libelle'=>$row->libelle);
               $taille = $taille+1;  
        }
        $this->data['directions'] = $directions;
        
    }
    
    protected function chargerVilles(){
        $villes[] = array();
        $result = $this->villes_model->getAll();
        $taille = 0;
        foreach ($result as $row){
               $villes[$taille] = array('id'=>$row->id, 'nom_ville'=>$row->nom_ville);
               $taille = $taille+1;  
        }
        $this->data['villes'] = $villes;
        
    }
    
    protected function chargerPermanences($dir, $dept, $ser, $vil, $start, $end, $service){
        if($dir=='0'){$dir=null;}
        if($dept=='0'){$dept=null;}
        if($ser=='0'){$ser=null;}
        if($vil=='0'){$vil=null;}
        
        $permanences[] = array();
        $result[] = array();
        $result = $this->permanences_model->permanencesDept_ville($dept, $vil, $start, $end, $service);
        
        /*if($dir==null && $dept==null && $ser==null && $vil==null){//toutes les permanences dans toutes les villes
            $result = $this->permanences_model->AllLigne_perm();
        }
        elseif($dir==null && $dept!=null && $ser==null && $vil!=null){//permanences d'un departement dans la ville X
            $result = $this->permanences_model->permanencesDept_ville($dept, $vil);
        }
        else{
            $result = $this->permanences_model->permanences($dir, $dept, $ser, $vil);
        }*/
        
        $taille = 0;
        foreach ($result as $row){
            $permanences[$taille] = array('date_perm'=>$row->date_perm, 'nom'=>$row->nom, 
                'prenom'=>$row->nom, 'tel1'=>$row->tel1, 'email'=>$row->email, 'heure_deb'=>$row->heure_deb,
                'heure_fin'=>$row->heure_fin);
            $taille = $taille+1;  
        }
        $this->data['permChoisies'] = $permanences;
    }
    
    protected function chargerAstreintes($dir, $dept, $ser, $vil, $start, $end, $service){
        if($dir=='0'){$dir=null;}
        if($dept=='0'){$dept=null;}
        if($ser=='0'){$ser=null;}
        if($vil=='0'){$vil=null;}
        
        $astreintes[] = array();
        $result[] = array();
        $result = $this->ligneAstrs_model->astreintesDept_ville($dept, $vil, $start, $end, $service);
        
        /*if($dir==null && $dept==null && $ser==null && $vil==null){//toutes les permanences dans toutes les villes
            $result = $this->permanences_model->AllLigne_perm();
        }
        elseif($dir==null && $dept!=null && $ser==null && $vil!=null){//permanences d'un departement dans la ville X
            $result = $this->permanences_model->permanencesDept_ville($dept, $vil);
        }
        else{
            $result = $this->permanences_model->permanences($dir, $dept, $ser, $vil);
        }*/
        
        $taille = 0;
        foreach ($result as $row){
            $astreintes[$taille] = array('date_deb'=>$row->date_deb, 'date_fin'=>$row->date_fin, 
                'lieu'=>$row->lieu, 'nom'=>$row->nom, 'prenom'=>$row->prenom,
                'tel1'=>$row->tel1, 'email'=>$row->email, 'matricule'=>$row->matricule);
            $taille = $taille+1;  
        }
        $this->data['astrChoisies'] = $astreintes;
        
    }
    
    protected function deptFiltre1($mc){
        $deptsid[] = array();
        $result = $this->departements_model->deptid($mc);
        $taille = 0;
        foreach ($result as $row){
               $deptsid[$taille] = array('id'=>$row->id, 'libelle'=>$row->libelle, 'description'=>$row->description);
               $taille = $taille+1;  
        }
        $this->filtre1['deptf1'] = $deptsid;
    }
    
    protected function villeFiltre1($ville){
        $villesid[] = array();
        $result = $this->villes_model->villeid($ville);
        $taille = 0;
        foreach ($result as $row){
               $villesid[$taille] = array('id'=>$row->id, 'nom_ville'=>$row->nom_ville);
               $taille = $taille+1;  
        }
        $this->filtre1['villef1'] = $villesid;
        
    }
    
     protected function deptFiltre2($deptid){
        $deptsid[] = array();
        $result = $this->departements_model->get(array('id'=>$deptid));
        $taille = 0;
        foreach ($result as $row){
               $deptsid[$taille] = array('id'=>$row->id, 'libelle'=>$row->libelle, 'description'=>$row->description);
               $taille = $taille+1;  
        }
        $this->filtre1['deptf1'] = $deptsid;
    }
    
     protected function villeFiltre2($villeid){
        $villesid[] = array();
        $result = $this->villes_model->get(array('id'=>$villeid));
        $taille = 0;
        foreach ($result as $row){
               $villesid[$taille] = array('id'=>$row->id, 'nom_ville'=>$row->nom_ville);
               $taille = $taille+1;  
        }
        $this->filtre1['villef1'] = $villesid;
        
    }
    
    protected function getNomDept($id){
        $nom='';
        $result = $this->departements_model->get(array('id'=>$id));
        if(is_array($result) && count($result) == 1){
            $nom = $result[0]->libelle;
        }
        return $nom;
    }
}
