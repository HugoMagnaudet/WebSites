<?php

class Ajout_fact extends CI_Controller {
    
    
 public function __construct() {
    parent::__construct();
    $this->load->database();
}    
   
public function index() 
    // a jouter a chaque page qui nécessite une authentification    
    { 
    if (!$this->auth_user_model->is_connected) {
            redirect('authent');
    }
        else {
            $this->ajout_fact(); 
            }
    }   

  
function ajout_fact() {
    
$this->load->helper(array('form', 'url'));

$this->load->library('form_validation');

$this->load->library('session');

$this->form_validation->set_rules('adressefact', 'adresse', 'required',
                array(
                'required'      => 'Vous devez fournir une %s.',                   
                ));

$this->form_validation->set_rules('code_postal_fact', 'code postal', 'required',
        array(
        'required'      => 'le %s est requis.',   
        ));

$this->form_validation->set_rules('ville_fact', 'ville', 'required',
        array(
        'required'      => 'Un nom de %s est requis.',   
        ));

$this->form_validation->set_rules('pays_fact', 'Pays', 'required',
        array(
        'required'      => "Merci d'indiquer le %s.",   
        ));
  
 // Affichage du formulaire ; Si le formulaire est validé redirection vers la page succes
        if ($this->form_validation->run() == FALSE)
        {   
            $this->load->model('fact_model');

            $data['title'] = 'Formulaire Ajout adresse facturation';
            $this->load->view('header',$data); 
            $data['choix_societe'] = $this->fact_model->liste_societe();
            $this->load->view('isaq/administration/form_fact', $data);
            
        }

        else
        {
            $data['title'] = 'Ajout adresse facturation';
            
            
        //==============Ajout société dans la base====================

            
       //on recupere les variables Adresse de facturation de la vue
            $adressefact = $this->input->post('adressefact');
            $adressefact1 = $this->input->post('adressefact1');
            $adressefact2 = $this->input->post('adressefact2');
            $adressefact3 = $this->input->post('adressefact3');
            $code_postal_fact = $this->input->post('code_postal');
            $ville_fact = $this->input->post('ville_fact');
            $pays_fact = $this->input->post('pays_fact');
            $mail_fact = $this->input->post('mail_fact');
            $num_tva_intra = $this->input->post('num_tva_intra');
            $cond_paiement  = $this->input->post('cond_paiement');
            $encours_max  = $this->input->post('encours_max');


        //on envoie la requete a la fonction avec les parametres
             
            $data['facturation'] = $this->fact_model->insert_facturation($adressefact, $adressefact1, $adressefact2, $adressefact3, $code_postal_fact, $ville_fact, $pays_fact, $mail_fact, $num_tva_intra, $cond_paiement, $encours_max );    
        

        // si tout c'est bien passé on affiche la vue de succes 
            
            $data['title'] = 'Adresse ajoutée';
            $data['objet'] = 'adresse de facturation';
            $this->load->view('header', $data); 
            $this->load->view('formulaires/formsuccess',$data);
        }                      

}



}