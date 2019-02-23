<?php

class creation_societe extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }    

public function index() 
    { 
        $this->creation_societe(); 
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
                'valid_email'   => 'Une adresse mail valide est requise',
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
            $adresse = $this->input->post('adresse');
            $adresse1 = $this->input->post('adresse1');
            $adresse2 = $this->input->post('adresse2');
            $adresse3 = $this->input->post('adresse3');
            $code_postal = $this->input->post('code_postal');
            $ville = $this->input->post('ville');
            $pays = $this->input->post('pays');
            $mail = $this->input->post('mail');


        //on envoie la requete a la fonction avec les parametres

            $data['societe'] = $this->societe_model->insert_societe($raison_sociale, $adresse, $adresse1, $adresse2, $adresse3, $code_postal, $ville, $pays, $mail );        

        // si tout c'est bien passé on affiche la vue de succes 
            
            $data['title'] = 'Société enregistrée';
            $data['objet'] = 'Société';
            $this->load->view('header', $data); 
            $this->load->view('formulaires/formsuccess',$data);
        }                      

}



}
    
        
        
        



