<?php
class Accueil extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('connexion_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['mail'] = $this->connexion_model->get_users();
                $data['title'] = 'enregistré';
        }

//        public function view($slug = NULL)
//        {
//                $data['news_item'] = $this->connexion->get_news($slug);
//        }
}
