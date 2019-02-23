<?php
class Users_model extends CI_Model {

public function __construct()
{

    $this->load->database();
}
        
public function myEncrypt($user_mdp)
        {
            $user_mdp=sha1($user_mdp);
            return $user_mdp;
        }      
        
public function insert_user($nom, $prenom, $raison_sociale, $mail, $user_mdp) 
        {
            $query = $this->db->insert('users', 
               array(
                       'nom' => $nom, 
                       'prenom' => $prenom,
                       'raison_sociale' => $raison_sociale,
                       'user_mdp'=>$user_mdp,        
                       'mail' => $mail,)
                     );
        }

public function get_users($mail , $user_mdp)
        {

            $query = $this->db->get_where('users', array('mail' => $mail,
                                                    'user_mdp' => $user_mdp,));
       
            return $query->row_array();

        }
}
