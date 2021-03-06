<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of the CRUD Class
 *
 * @author pasquierase
 */
class MY_Model extends CI_Model{
    //put your code here
    protected $table = ''; //le nom des tables (dynamiquement générés)
    
    /**
    * Créer un nouvel enregistrement avec les valeurs passées en paramètre et retourne son id
    **/
    public function creer($values) {
            //echo 'je suis laaaaaaa';
            if($this->db->set($values)->insert($this->table)) return $this->db->insert_id();
            return null;
    }


    /**
    * Met à jour les enregistrements en fonction des condiditions passées en paramètres
    **/
    public function maj($where, $value) {
            return $this->db->where($where)->update($this->table, $value);
    }



    /**
    * Supprime les enregistrements en fonction des condiditions passées en paramètres
    **/
    public function supprimer($where) {
            return $this->db->where($where)->delete($this->table);
    }
    
    /**
    * Recherche les enregistrements correspondants aux condiditions passées en paramètres.
    **/
    public function get($where = array()) {
        $req = $this->db->get_where($this->table, $where);
        return $req->result();
    }
    
    /**
    * select * from WHERE.....
    **/
    public function getAll() {
        
        $req = $this->db->get($this->table);  // Produces: SELECT * FROM mytable (without where)
        return $req->result();
    }
    
    /**
     * count 
     */
    
    public function count($where = array()){
        //si le paramettre est null (count()) alors la totalité sera retournée
        return (int) $this->db->where($where)->count_all_results($this->table);
    }
    
    public function boite_envoi($login, $passwd){
        $this->db->select('idEnvoi, dateEnvoi, heureEnvoi, destinataire, objet, contenu, taille, libelleStatut');
        $this->db->from('EnvoiMessage');
        $this->db->join('StatutEnvoi', 'StatutEnvoi.idStatutEnvoi = EnvoiMessage.idStatutEnvoi');
        $this->db->where(array('EnvoiMessage.login ='=>$login));
        $this->db->where(array('EnvoiMessage.passwd ='=>$passwd));

        $req = $this->db->get();
        return $req->result();
    }
    
    public function contact_group($login, $passwd){
        $this->db->select('idContact, nom, prenom, numero1, ville, libelleGroupe');
        $this->db->from('Contacts');
        $this->db->join('Groupes', 'Groupes.idGroupe = Contacts.idGroupe');
        $this->db->where(array('Contacts.login ='=>$login));
        $this->db->where(array('Contacts.passwd ='=>$passwd));

        $req = $this->db->get();
        return $req->result();
    }
}
