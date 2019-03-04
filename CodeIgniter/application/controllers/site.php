<?php


class Site extends CI_Controller {

  public function apropos() {
    $data["title"] = "À propos d'IsarteCrea";
    $this->load->view('header', $data);
    $this->load->view('pages/pages1', $data);
    $this->load->view('/footer', $data);
  }

  public function connexion() {
    $this->load->helper("form");
    $this->load->library('form_validation');
    $data["title"] = "Identification";
    if ($this->form_validation->run()) {
      $mail = $this->input->post('mail');
      $mdp = $this->input->post('mdp');
      $this->auth_user_model->login($mail, $mdp);
      if ($this->auth_user_model->is_connected) {
        redirect('');
      } else {
        $data['login_error'] = "Échec de l'authentification";
      }
    }
    $this->load->view('header', $data);
    $this->load->view('identification/login', $data);
    $this->load->view('footer', $data);
  }



  function deconnexion() {
    $this->auth_user_model->logout();
    redirect('');
  }

  public function index() {
    $data["title"] = "Page d'accueil";
    $this->load->view('header', $data);
    $this->load->view('isaq/apropos', $data);
    $this->load->view('footer', $data);
  }
}