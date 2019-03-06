<?php

class Liste_devis extends CI_Controller {

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
        $this->liste_devis(); 
        }

    }

    public function liste_devis(){
        
        $id_user=$this->session->auth_user_model['id'];
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('devis_model');
        
        $data['liste_devis']=$this->devis_model->liste_devis($id_user);
        //var_dump($this->devis_model->liste_devis($id_user));
                
        $data['title']= 'Liste de vos devis';
        $this->load->view('header', $data);
        $this->load->view('devis/liste_devis', $data);
        
        
   
    }       
}
