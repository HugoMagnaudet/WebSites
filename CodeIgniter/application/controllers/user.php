<?php
 
class User extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    $this->sessionUser();
  }
 
  private function sessionUser() {
 
    if (!$this->session->userdata('id_user')) {
      redirect('');
    }
  }
  
  public function logout() {
    $this->session->sess_destroy();
    redirect('/');
  }
} 
?>