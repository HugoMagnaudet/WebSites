<?php

class creation_societe extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }    

public function index() 
    { 
    if (!$this->auth_user_model->is_connected) {
            redirect('authent');
    }
        else {
            $this->creation_societe(); 
            }
    }
public function creation_societe()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('raison_sociale', 'raison sociale', 'required|min_length[3]',
                array(
                'required'      => 'Vous devez indiquer la %s.',
                'is_unique'     => 'Cette %s existe déja.'
                    ));
        $this->form_validation->set_rules('code_ape', 'Code APE', 'required|min_length[3]',
                array(
                'required'      => 'Vous devez indiquer le %s.',
                'is_unique'     => 'Ce %s existe déja.'
                    ));

        $this->form_validation->set_rules('adresse', 'adresse', 'required',
                array(
                'required'      => 'Vous devez fournir une %s.',
                    
                ));

        $this->form_validation->set_rules('code_postal', 'code postal', 'required',
                array(
                'required'      => 'le %s est requis.',   
                ));

        $this->form_validation->set_rules('ville', 'ville', 'required',
                array(
                'required'      => 'Un nom de %s est requis.',   
                ));
        
        $this->form_validation->set_rules('pays', 'Pays', 'required',
                array(
                'required'      => "Merci d'indiquer le %s.",   
                ));
        
        $this->form_validation->set_rules('mail', 'Email', 'trim|valid_email',
                array(    
                'valid_email'   => 'Entrez une adresse mail valide',
                ));
        
        
//==================================PARTIE FACTURATION=============================================        
        
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
            $data['title'] = 'Formulaire Enregistrement Societe';
            $this->load->view('header', $data);    
            $this->load->view('isaq/administration/form_societe');
        }

        else
        {
            $data['title'] = 'Enregistrement Societe';
        //==============inscription de l'utilisateur en base====================

            $this->load->model('societe_model');

        //on recupere les variables de la vue
            $raison_sociale = $this->input->post('raison_sociale');
            $code_ape = $this->input->post('code_ape');
            $adresse = $this->input->post('adresse');
            $adresse1 = $this->input->post('adresse1');
            $adresse2 = $this->input->post('adresse2');
            $adresse3 = $this->input->post('adresse3');
            $code_postal = $this->input->post('code_postal');
            $ville = $this->input->post('ville');
            $pays = $this->input->post('pays');
            $mail = $this->input->post('mail');
            
       //on recupere les variables Adresse de facturation de la vue
            $adressefact = $this->input->post('adressefact');
            $adressefact1 = $this->input->post('adressefact1');
            $adressefact2 = $this->input->post('adressefact2');
            $code_postal_fact = $this->input->post('code_postal');
            $ville_fact = $this->input->post('ville_fact');
            $pays_fact = $this->input->post('pays_fact');
            $mail_fact = $this->input->post('mail_fact');
            $num_tva_intra = $this->input->post('num_tva_intra');
            $cond_paiement  = $this->input->post('cond_paiement');
            $encours_max  = $this->input->post('encours_max');


        //on envoie les requetes aux fonctions avec les parametres
            $data['societe'] = $this->societe_model->insert_societe($raison_sociale, $adresse, $adresse1, $adresse2, $adresse3, $code_postal, $ville, $pays, $mail );        
            $data['facturation'] = $this->fact_model->insert_facturation($adressefact, $adressefact1, $adressefact2, $adressefact3, $code_postal_fact, $ville_fact, $pays_fact, $mail_fact, $num_tva_intra, $cond_paiement, $encours_max );    
        
        // si tout c'est bien passé on affiche la vue de succes     
            $data['title'] = 'Société enregistrée';
            $data['objet'] = 'Société';
            $this->load->view('header', $data); 
            $this->load->view('formulaires/formsuccess',$data);
        }                      

}



}
    
        
        
        



