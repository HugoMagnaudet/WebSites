<?php

// C est la page du controlleur - Le centre de traitement de toute les requetes 

class pages extends CI_Controller {

        public function view($page = 'about')
        {
            
          if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
      

        $this->load->View('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
        
  
        }
}


