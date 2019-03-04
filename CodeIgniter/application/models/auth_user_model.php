<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_user_model extends CI_Model {

    public $_mail;
    public $_id;

    public function __construct() {
        parent::__construct();
        $this->load_from_session();
        $this->load->database();
    }

    public function __get( $key) {
        $method_name = 'get_property_' . $key;
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        } else {
            return parent::__get( $key);
        }
    }

// Fonction appellée lors de la deconnexion    
    protected function clear_data() {
        $this->_id = NULL;
        $this->_mail = NULL;
    }

    protected function clear_session() {
        $this->session->auth_user_model = NULL;
    }
//==========================================
    
    
    protected function get_property_id() {
        return $this->_id;
    }

    protected function get_property_is_connected() {
        return $this->_id !== NULL;
    }

    protected function get_property_mail() {
        return $this->_mail; 
    }
    
    protected function get_property_nom() {
    return $this->_nom; 
    }
    
    protected function get_property_is_admin() {
    return $this->_type_user=='A'; 
    }

    protected function load_from_session() {
        if ($this->session->auth_user_model) {
            $this->_id = $this->session->auth_user_model['id'];
            $this->_mail = $this->session->auth_user_model['mail'];
            $this->_nom = $this->session->auth_user_model['nom'];
            $this->_type_user = $this->session->auth_user_model['type_user'];
            
        } else {
            $this->clear_data();
        }
    }

//fonction d'encryptage du mot de passe    
public function myEncrypt($mdp)
        {
            $mdp=sha1($mdp);
            return $mdp;
        }  

        
// La requete de recherche de l'utilisateur dans la base        
public function get_users($mail , $mdp)
        {
        return $this->db
                    ->select('id, mail, mdp, nom, type_user')
                    ->from('users')
                    ->where('mail', $mail)
                    ->where('mdp', $mdp)
                    ->get()
                    ->first_row();

        }    
    
    
//=================Fonction de recherche user====================== 
//
//on recherche l'utilisateur et on sauvegarde les infos de session
  
    public function login( $mail, $mdp) {
        $query = $this->get_users($mail, $mdp);
        
        if ( $query !== NULL) {
            $this->_id = $query->id;
            $this->_mail = $query->mail;
            $this->_nom = $query->nom;
            $this->_type_user = $query->type_user;
            
            $this->save_session();
        } 
        else {
            $this->logout();
        }
    }


// on enregistre dans la session les infos qui nous interessent    
    protected function save_session() {
        $this->session->auth_user_model = [
            'id' => $this->_id,
            'mail' => $this->_mail,
            'nom'  => $this->_nom,
            'type_user'  => $this->_type_user,
        ];
    }
    
    public function logout() {
        $this->clear_data();
        $this->clear_session();
    }    
    
}