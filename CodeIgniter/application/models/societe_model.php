<?php
class Societe_model extends CI_Model {

public function __construct()
{
    $this->load->database();
}
  
public function insert_societe($raison_sociale, $adresse, $adresse1, $adresse2, $adresse3, $code_postal, $ville, $pays, $mail) 
        {
            $query = $this->db->insert('societe', 
               array(
                   'raison_sociale' => $raison_sociale, 
                   'adresse'        => $adresse,
                   'adresse1'       => $adresse1,  
                   'adresse2'       => $adresse2,  
                   'adresse2'       => $adresse3,
                   'code_postal'    => $code_postal,  
                   'ville'          => $ville,  
                   'pays'           => $pays,  
                   'mail'           => $mail,)
                     );

        }
        
}