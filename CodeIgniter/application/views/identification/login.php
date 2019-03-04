<!DOCTYPE html>

<html>
<head>
<title>Authentification</title>
<style>
    div {
        margin-left: 20px;
        margin-right: 40px    
    }
</style>
</head>
<body>
    <div class="header">
        <h3 align="center" >Identification</h3>
<?php echo validation_errors(); ?>

<?php echo form_open('authent'); ?>
    <form>

<div>
</br>   
<div class="form-group">
<label for="mail">Email</label>
</br>
<input class="form-control" type="text" name="mail" placeholder="Adresse mail" value="<?php echo set_value('mail'); ?>" />
</div>
</br>
<div class="form-group">
<label for="mdp">Mot de passe</label>
</br>
<input class="form-control" type="password" name="mdp" placeholder="Votre mot de passe" value="<?php echo set_value('mdp'); ?>" />
</div>
</br>

<div align="center">
    <button class="btn btn-primary" type="submit" value="Submit" name= "login"> Login </button>
</div>

</form>
    
</div>        

</body>
</html>
