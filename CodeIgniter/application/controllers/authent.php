<?php

Class Authent extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }    

public function index() 
    { 
        $this->authentification(); 
    }
        
public function authentification()        
        {
    
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');

    $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email',
            array(
            'required' => 'L\'adresse mail est obligatoire' ,   
            'valid_email'=> 'Une adresse mail valide est requise',
            ));

    $this->form_validation->set_rules('user_mdp', 'Mot de passe', 'required',
            array(
            'required'      => 'Le mot de passe doit être renseigné.',   
            ));
     
// Affichage du formulaire Si le formulaire est validé redirection vers le model pour vérifier user - sinon réaffichage du formulaire...
        if ($this->form_validation->run() == FALSE)
        {
            $data['title']='Connexion';
            $this->load->view('header',$data);
            $this->load->view('identification/login');
        }
        else
        {
            $data['title'] = 'Connexion';
            $this->load->model('users_model');
            
            //on recupere la variable mail et mdp depuis la vue
            $mail = $this->input->post('mail');
            $user_mdp = $this->input->post('user_mdp');
            
            //On crypte le mdp de la vue
            $user_mdp=$this->users_model->myEncrypt($user_mdp);
            
            //on envoie la requete a la fonction avec le mail et mdp en parametre
            $data['users'] = $this->users_model->get_users($mail ,$user_mdp);

            
            $this->load->view ('header', $data);
            $this->load->view ('identification/accueil', $data);

        }                
                          
    }

}

?>
