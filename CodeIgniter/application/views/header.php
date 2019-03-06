<head>
    <title><?php echo $title ?> </title>
   
    <style type="text/css">
    .inline-form input {
            display: inline-block;
            width: 100px;
        }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/css/font-awesome.min.css">
 
</head>



<body>
   
<!-- DEBUT BARRE DE NAVIGATION -->
<div class="collapse navbar-collapse" id="main_nav">
  <ul class="nav navbar-nav">
    <li><?= anchor('index', "Accueil"); ?></li>
    <li><?= anchor('site/apropos', "À propos"); ?></li>
    <li><?= anchor('contact', "Contact"); ?></li>  
    <li><?php if($this->auth_user_model->is_connected) : ?> 
        
            <li>
                <?= anchor('devis', "Demande de devis"); ?>
            </li>
                <?php endif; ?> 
    
    
<!--- MENU ADMIN === VISIBLE UNIQUEMENT EN CONNEXION ADMIN--->    
    
<?php if ($this->auth_user_model->is_connected && $this->auth_user_model->is_admin) : ?>
    
 <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Administration
  </button>
  <div class="dropdown-menu">
      <li>
        <?= anchor('creation_user', "creer un utilisateur"); ?>
      </li>
      <li>
        <?= anchor('creation_societe', "creer une société"); ?>
      </li>
      <li>
        <?= anchor('info_devis', "Rubrique Devis"); ?>
      </li>
      <li>
        <?= anchor('ajout_fact', "Adresse facturation"); ?>
      </li>
  </div> 
 </div>
    <?php endif; ?>

<!---  FIN MENU ADMIN--->


  </ul>
  <ul class="nav navbar-nav navbar-right">
    <?php if($this->auth_user_model->is_connected) : ?>
      <li><?= anchor('authent/deconnexion', "Déconnexion"); ?></li>
      <?php if ($this->auth_user_model->is_connected) : ?>
        <div class="dropdown-menu">
            <li>
                <?= anchor('devis', "Demande de devis"); ?>
            </li>     
 </div>
    <?php endif; ?>
    <?php else: ?>
      <li><?= anchor('authent/connexion', "Connexion"); ?></li>
    <?php endif; ?>
      
  </ul>

  <?php if($this->auth_user_model->is_connected) : ?>
    <p class="navbar-text navbar-right">|</p>
    <p class="navbar-text navbar-right">Bienvenue <strong><?= $this->auth_user_model->nom; ?></strong></p>
  <?php endif; ?>
</div>
     
     
<!-- FIN BARRE DE NAVIGATION -->


