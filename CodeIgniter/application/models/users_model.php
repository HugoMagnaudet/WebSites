<?php
class Users_model extends CI_Model {

public function __construct()
{

    $this->load->database();
}
        
public function myEncrypt($mdp)
        {
            $mdp=sha1($mdp);
            return $mdp;
        }      
        
public function insert_user($nom, $prenom, $raison_sociale, $mail, $mdp, $type_user) 
        {
            $this->db->insert('users', 
               array(
                       'nom' => $nom, 
                       'prenom' => $prenom,
                       'raison_sociale' => $raison_sociale,
                       'mdp'=>$mdp,        
                       'mail' => $mail,
                       'type_user' => $type_user,)
                     );
        }

public function get_users($mail , $mdp)
        {

            $query = $this->db->get_where('users', array('mail' => $mail,
                                                    'mdp' => $mdp, 
                                                 ));
       
            return $query->row_array();

        }
}
