<?php

class Creation_user extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }    


public function index() 
    { 
    if (!$this->auth_user_model->is_connected) {
            redirect('authent');
    }
    else{
        $this->creation_user(); 
        }
    }
public function creation_user()
        {
    $this->load->helper(array('form', 'url'));


    $this->load->library('form_validation');

    $this->form_validation->set_rules('nom', 'utilisateur', 'required|min_length[2]',
            array(
            'required'      => 'Vous devez fournir un nom %s.',
                ));

    $this->form_validation->set_rules('prenom', 'utilisateur', 'required|min_length[2]',
            array(
            'required'      => 'Vous devez fournir un prénom %s.',
                ));

    $this->form_validation->set_rules('raison_sociale', 'Raison Sociale', 'required|min_length[3]',
            array(
            'required'      => 'Vous devez fournir la %s.',
            ));                

    $this->form_validation->set_rules('mdp', 'Mot de passe', 'required|min_length[8]',
            array(
            'required'      => 'Vous devez fournir un %s.',
            'min_length' => 'Mot de passe 8 caracteres SVP'    
            ));

    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[mdp]', 
            array(
            'required' => 'Confirmez le mot de passe',   
            'matches'=> 'Les mots de passe ne correspondent pas',
            ));

    $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email',
            array(
            'required' => 'L\'adresse mail est obligatoire' ,   
            'valid_email'=> 'Une adresse mail valide est requise',
            ));


// Affichage du formulaire Si le formulaire est validé redirection vers la page succes - sinon réaffichage du formulaire...
    if ($this->form_validation->run() == FALSE)
        {
        $data['title']="Création d'un utilisateur";
        $this->load->view('header', $data);    
        $this->load->view('isaq/administration/form_user');
        }

    else
        {
        $data['title'] = 'Création Utilisateur';
    //==============inscription de l'utilisateur en base====================

        $this->load->model('users_model');

    //on recupere les variables de la vue
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $raison_sociale = $this->input->post('raison_sociale'); 
        $mail = $this->input->post('mail');
        $mdp = $this->input->post('mdp');
        $type_user= $this->input->post('gridRadios');
  

    // appel de la fonction d'encryptage du mot de passe        
        $mdp = $this->users_model->myEncrypt($mdp);

    //on envoie la requete a la fonction avec le mail et mdp en parametre
        $data['users'] = $this->users_model->insert_user($nom, $prenom, $raison_sociale, $mail ,$mdp, $type_user);        

    // si tout c'est bien passé on affiche la vue de succes  
        $data['title'] = 'Utilisateur enregistré';
        $data['objet'] = 'Utilisateur';
        $this->load->view('header', $data);   
        $this->load->view('formulaires/formsuccess');
        }                           
        }

}
    
        
        
        



