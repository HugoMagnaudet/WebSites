<?php
Class Authent extends CI_Controller{
    
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
    
    $this->load->library('session');

    $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email',
            array(
            'required' => 'L\'adresse mail est obligatoire' ,   
            'valid_email'=> 'Une adresse mail valide est requise',
            ));

    $this->form_validation->set_rules('mdp', 'Mot de passe', 'required',
            array(
            'required'      => 'Le mot de passe doit être renseigné.',   
            ));
  
 // apres que les tests de validation sont passés ont peut 
 // 1- verifier si l'utilisateur et le mot de passe existe (=> fonction connexion() ci dessous
 // 2- si oui implémenter les informations de session   
    $this->connexion();      

        }
// Affichage du formulaire Si le formulaire est validé redirection vers le model pour vérifier user - sinon réaffichage du formulaire...
  
    
 public function connexion(){  
    
    $this->load->helper(array('url')); 
    $this->load->library('form_validation');
     
    if ($this->form_validation->run() == FALSE)
        {
            $data['title']='Connexion';
            $this->load->view('header',$data);
            $this->load->view('identification/login');
        }
        else
        {
            $data['title'] = 'Connexion';
            $this->load->model('auth_user_model');
            
            //on recupere la variable mail et mdp depuis la vue
            $mail = $this->input->post('mail');
            $mdp = $this->input->post('mdp');
            
            //On crypte le mdp           
            $mdp=$this->auth_user_model->myEncrypt($mdp);
            
            //on envoie la requete a la fonction login avec le mail et mdp en parametre
            //pour vérifier si l'utilisateur existe bien et avec bon mdp
            
            $this->auth_user_model->login( $mail, $mdp);
            
            // si c est ok il est redirigé dans la page d'accueil
            if($this->auth_user_model->is_connected) {
                redirect('');
            } else {
                   $this->load->view ('header', $data);
                   $this->load->view ('identification/notconnected');
                   $this->load->view ('identification/login');
            }
        }
   
 }
  
      public function deconnexion() {
        $this->auth_user_model->logout();
        redirect('');
        }
}


?>
