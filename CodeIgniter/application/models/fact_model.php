<?php

class Fact_model extends CI_Model {

public function __construct()
{
    parent::__construct();
    $this->load->database();
}

//ajouter la clause where pour rattacher adresse fact a la bonne société

public function insert_facturation($adressefact, $adressefact1, $adressefact2, $adressefact3, $code_postal_fact, $ville_fact, $pays_fact, $mail_fact, $num_tva_intra, $cond_paiement, $encours_max )
        {
            $query = $this->db->insert('adresse_facturation', 
               array(
                   'adressefact'        => $adressefact,
                   'adressefact1'       => $adressefact1,  
                   'adressefact2'       => $adressefact2,  
                   'adressefact3'       => $adressefact3,
                   'code_postal_fact'    => $code_postal_fact,  
                   'ville_fact'          => $ville_fact,  
                   'pays_fact'           => $pays_fact,  
                   'mail_fact'           => $mail_fact,
                   'num_tva_intra'  => $num_tva_intra,
                   'cond_paiement'  => $cond_paiement,
                   'encours_max'    => $encours_max,)
                     );

        }        
            
public function liste_societe(){
        $query = $this->db->query('select raison_sociale from societe');
	return $query->result_array();

    }
        
}
