<?php

class Modifmdp extends CI_Controller {
    
    
 public function __construct() {
    parent::__construct();

}    
   
public function index() 
    { 
        $this->modification(); 
    }   

  
function modification() {
    
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

$this->form_validation->set_rules('mdpnew', 'Password Confirmation', 'required', 
        array(
        'required' => 'Entrez le nouveau mot de passe',   
        ));

$this->form_validation->set_rules('mdpconf', 'Password Confirmation', 'required|matches[mdpnew]', 
        array(
        'required' => 'Confirmez le nouveau mot de passe',   
        'matches'=> 'Les mots de passe ne correspondent pas',
        ));
  
 // apres que les tests de validation sont passés ont peut 
 // 1- verifier si l'utilisateur existe (=> fonction connexion() ci dessous
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
            $this->load->view('identification/modifmdp');
        }
        else
        {
            $data['title'] = 'Modifier votre mot de passe';
            $this->load->model('modif_mdp_model');
            
            //on recupere toutes les variables  depuis la vue
            $mail = $this->input->post('mail');
            $mdp = $this->input->post('mdp');
            $mdpnew = $this->input->post('mdpnew');
            $mdpconf = $this->input->post('mdpconf');
            
            //On crypte le mdp pour la vérification ET pour le nouveau mot de passe
            $this->load->model('auth_user_model');
            $mdp=$this->auth_user_model->myEncrypt($mdp);
            $mdpnew=$this->auth_user_model->myEncrypt($mdpnew);
            
         
        //on envoie la requete a la fonction avec le mail mdp et nouveau mdp en parametre
            $query=$this->modif_mdp_model->get_users($mail, $mdp); 

            if ( $query !== NULL) {
                $this->modif_mdp_model->update_user_mdp($mail, $mdp, $mdpnew);
                $data['title']='Connexion';
                $this->load->view('header',$data);
                redirect('');
            }
            else {
               $this->load->view ('header', $data);
               $this->load->view ('identification/mdp_not_changed');

                }

            }
        }

 }
  


?>