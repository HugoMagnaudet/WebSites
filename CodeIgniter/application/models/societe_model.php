<?php
class Societe_model extends CI_Model {

public function __construct()
{
    parent::__construct();
    $this->load->database();
}
  
public function insert_societe($raison_sociale, $code_ape, $adresse, $adresse1, $adresse2, $adresse3, $code_postal, $ville, $pays, $mail) 
        {
            $query = $this->db->insert('societe', 
               array(
                   'raison_sociale' => $raison_sociale,
                   'code_ape'       => $code_ape,
                   'adresse'        => $adresse,
                   'adresse1'       => $adresse1,  
                   'adresse2'       => $adresse2,  
                   'adresse3'       => $adresse3,
                   'code_postal'    => $code_postal,  
                   'ville'          => $ville,  
                   'pays'           => $pays,  
                   'mail'           => $mail,)
                     );

        }

public function insert_facturation($adressefact, $adressefact1, $adressefact2, $adressefact3, $code_postal_fact, $ville_fact, $pays_fact, $mail_fact, $num_tva_intra, $cond_paiement, $encours_max )
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
                   'mail'           => $mail_fact,
                   'num_tva_intra'   => $num_tva_intra,
                   'cond_paiement'  => $cond_paiement,
                   'encours_max'   => $encours_max,)
                     );

        }        
        
        
        
        
public function liste_scte_formulaire (
        
        );
        
}
