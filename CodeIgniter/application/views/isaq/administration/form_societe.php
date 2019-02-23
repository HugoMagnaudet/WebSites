
<html>

<head>
    <title>Formulaire d'enregistrement Société</title>
    
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    div {
        margin-left: 20px
    }
    h2 {
        padding-top: 20px
        
    }
</style>
</head>   

<body>

    <div align='center'>
        </br>
            <h2>Formulaire Création Société</h2>
        </br>     
        
    </div>
    <div align="center">    
<?php echo validation_errors(); ?>
    </div>    
<div>
<?php echo form_open('creation_societe'); ?>
    <form >
        <h5>Raison Sociale</h5>
        <input class="form-group mb-2" type="text" name="raison_sociale" value="<?php echo set_value('raison_sociale'); ?>" size="50px" placeholder="Raison sociale" />

        <h5>Adresse</h5>
        <input class="form-group mb-2" type="text" name="adresse" value="<?php echo set_value('adresse'); ?>" size="60px" placeholder="Adresse : N°, type voie, Nom rue..."/>
        
        <input class="form-group mb-2" type="text" name="adresse1" value="<?php echo set_value('adresse1'); ?>" size="60px" placeholder="Complément adresse 1"/>
        
        <input class="form-group mb-2" type="text" name="adresse2" value="<?php echo set_value('adresse2'); ?>" size="60px" placeholder="Complément adresse 2"/>
        
        <input class="form-group mb-2" type="text" name="adresse3" value="<?php echo set_value('adresse3'); ?>" size="60px" placeholder="Complément adresse 3"/>
        </br>
        
        <h5>Localité</h5>
        <input class="form-group mb-2" type="text" name="code_postal" value="<?php echo set_value('code_postal'); ?>" size="10px" placeholder="Code Postal" />
        <input class="form-group mb-2" type="text" name="ville" value="<?php echo set_value('ville'); ?>" size="40px" placeholder="Ville"/>
        </br>
        </br>
        <input class="form-group mb-2" type="text" name="pays" value="<?php echo set_value('pays'); ?>" size="30px" placeholder="Pays"/>
        </br>
        <h5>Adresse Mail</h5>
        <input class="form-group mb-2" type="text" name="mail" value="<?php echo set_value('mail'); ?>" size="50px" placeholder="example@mail.fr" />

        </br>
        </br>
            <div align="center">
                <button class="btn btn-primary" type="submit" value="Submit" name= "enregistrement"> Enregistrement</button>
            </div>
    </form>
</div>
</body>
</html>



