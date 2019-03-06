<?php
class Devis extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }

    public function index()
    {
     if (!$this->auth_user_model->is_connected) {
        redirect('authent');
        }
    else {
        $this->ajout_devis(); 
        }

    }

    public function ajout_devis(){
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        
        $this->form_validation->set_rules('titre_devis', 'Titre', 'required',
        array(
        'required'      => 'Merci d\'indiquer un titre a votre demande.',                   
        ));

        $this->form_validation->set_rules('contenu', 'Contenu', 'required',
        array(
        'required'      => 'Merci de compléter votre demande.',   
        ));

        // Affichage du formulaire ; Si le formulaire est validé redirection vers la page succes
        if ($this->form_validation->run() == FALSE)
        {  
            $data['title'] = 'Demande de devis';
            $this->load->view('header',$data); 
            $this->load->view('formulaires/demande_devis');
            $id_user=$this->session->auth_user_model['id']; 
            
            
        }

        else
        {
            $this->load->model('devis_model');
        //==============Ajout demande devis dans la base====================
        
       //on recupere les variables du devis depuis la vue
            $titre_devis = $this->input->post('titre_devis');
            $contenu = $this->input->post('contenu');
        
        
            $this->devis_model->ajout_devis($titre_devis, $contenu);

        // si tout c'est bien passé on affiche la vue de succes 
            
            $data['title'] = 'Envoi devis';
            $data['objet'] = 'votre demande de devis';
            $this->load->view('header', $data); 
            $this->load->view('formulaires/devis_succes',$data); 
        
        
        }
    }       
}
