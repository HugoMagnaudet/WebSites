<?php

class Devis_model extends CI_Model {
 
        public function __construct()
        {
         parent::__construct();
         $this->load->database();
        }
        
public function liste_devis($id_user)
    {
    
        $query = $this->db->query("select * from devis where id_user=$id_user");
        return $query->result_array();
        //var_dump($query);
   
     }

public function ajout_devis($titre_devis, $contenu, $id_user){
    
    $query = $this->db->insert('devis', 
               array(
                   'titre_devis'   => $titre_devis,
                   'contenu'       => $contenu,
                   'id_user'       => $id_user 
                    )
                 );
    }
}