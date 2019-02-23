<style>

    h2 {
        padding-top: 20px
        
    }
</style>
<body>
    <div align='center'>
        </br>
        </br>
        </br>
            <h2>Formulaire d'enregistrement d'un utilisateur</h2>
        </br>
    
    </div>
<?php echo validation_errors(); ?>

<?php echo form_open('creation_user'); ?>
  
<form>
 <div class="form-row">
   <div class="col-md-4 mb-3">
        <label for="inputNomUser">Nom Utilisateur</label>
        <input class="form-control" type="text" name="nom" value="<?php echo set_value('nom'); ?>" size="60px" placeholder="Nom "/>
   </div>
   <div class="col-md-4 mb-3">
        <label for="inputPrenomUser">Prénom Utilisateur</label>
        <input class="form-control" type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" size="60px" placeholder="Prénom "/>
   </div>
  </div>
  <div class="form-group">  
   <div class="col-md-4 mb-3">
       <label for="inputRaisonSociale">Nom société</label>
       <input class="form-control" type="text" name="raison_sociale" value="<?php echo set_value('raison_sociale'); ?>" size="60px" placeholder="Raison Sociale" />
    </div>    
    
    <div class="col-md-4 col-md-6"> 
        <label for="inputMotdePasse">Mot de passe</label>
        <input class="form-control" type="password" name="user_mdp" value="<?php echo set_value('user_mdp'); ?>" size="60px" placeholder="Mot de passe"/>
    </div>
     
    <div class="col-md-4 col-md-6"> 
        <label for="inputConfMotdePasse">Confirmation mot de passe</label>
        <input class="form-control" type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="60px" placeholder="Confirmation du mot de passe"/>
    </div>    

    <div class="col-md-4 col-md-6"> 
        <label for="inputEmail">Adresse Mail</label>
        <input class="form-control" type="email" name="mail" value="<?php echo set_value('mail'); ?>" size="60px" placeholder="Adresse mail valide"/>
    </div>
  </div>   
     

    <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Rôle</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
          <label class="form-check-label" for="gridRadios1">
            Client
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
          <label class="form-check-label" for="gridRadios2">
            fournisseur
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
          <label class="form-check-label" for="gridRadios3">
            Administrateur
          </label>
        </div>
      </div>
    </div>
  </fieldset>


    </br>
    </br>
        <div align="center">
            <button class="btn btn-primary" type="submit" value="Submit" name= "enregistrement"> Enregistrement</button>
        </div>
    
</form>

 
    
    
    
    
</body>
</html>



