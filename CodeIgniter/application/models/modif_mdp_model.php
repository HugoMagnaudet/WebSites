<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modif_mdp_model extends CI_Model {

    public $_mail;
    public $_mdpnew;   
    public $_id;

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }


//fonction d'encryptage du mot de passe    
public function myEncrypt($mdp)
        {
            $mdp=sha1($mdp);
            return $mdp;
        }  

public function get_users($mail , $mdp)
        {
        $query=$this->db
                    ->select('mail, mdp')
                    ->from('users')
                    ->where('mail', $mail)
                    ->where('mdp', $mdp)
                    ->get()
                    ->first_row();
        return $query;
        }        
        
public function update_user_mdp($mail, $mdp, $mdpnew) 
        {            
            $this->db->query("UPDATE users SET mdp='$mdpnew' where mail='$mail' and mdp='$mdp' ");      
        }         
    
}