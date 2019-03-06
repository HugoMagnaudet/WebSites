<?php

class Fact_model extends CI_Model {

public function __construct()
{
    parent::__construct();
    $this->load->database();
}

//ajouter la clause where pour rattacher adresse fact a la bonne société

public function insert_facturation($adressefact, $adressefact1, $adressefact2, $adressefact3, $code_postal_fact, $ville_fact, $pays_fact, $num_tva_intra, $cond_paiement, $encours_max )
        {
            $query = $this->db->insert('adresse_facturation', 
               array(
                   'adresse'        => $adressefact,
                   'adresse1'       => $adressefact1,  
                   'adresse2'       => $adressefact2,  
                   'adresse3'       => $adressefact3,
                   'code_postal'    => $code_postal_fact,  
                   'ville'          => $ville_fact,  
                   'pays'           => $pays_fact,  
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
