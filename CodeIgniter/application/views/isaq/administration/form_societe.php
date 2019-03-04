
<html>

<head>
    <title>Formulaire d'enregistrement Société</title>
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
        <h5>Code APE</h5>
        <input class="form-group mb-2" type="text" name="code_ape" value="<?php echo set_value('code_ape'); ?>" size="50px" placeholder="Code APE" />
        
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

        <input class="form-group mb-2" type="text" name="pays" value="<?php echo set_value('pays'); ?>" size="30px" placeholder="Pays"/>
        </br>
        <h5>Adresse Mail Principale</h5>
        <input class="form-group mb-2" type="text" name="mail" value="<?php echo set_value('mail'); ?>" size="50px" placeholder="example@mail.fr" />

        <div align='center'>
        </br>
            <h4>Facturation</h4>
        </br> 
        </div>
        <input class="form-group mb-2" type="text" name="adressefact" value="<?php echo set_value('adressefact'); ?>" size="60px" placeholder="Adresse : N°, type voie, Nom rue..."/>
        
        <input class="form-group mb-2" type="text" name="adressefact1" value="<?php echo set_value('adresse1'); ?>" size="60px" placeholder="Complément adresse de facturation 1"/>
        
        <input class="form-group mb-2" type="text" name="adressefact2" value="<?php echo set_value('adresse2'); ?>" size="60px" placeholder="Complément adresse de facturation 2"/>
        
        <input class="form-group mb-2" type="text" name="adressefact3" value="<?php echo set_value('adresse3'); ?>" size="60px" placeholder="Complément adresse de facturation 3"/>
        </br> 
        <h5>Localité</h5>
        <input class="form-group mb-2" type="text" name="code_postal_fact" value="<?php echo set_value('code_postal'); ?>" size="10px" placeholder="Code Postal" />
        <input class="form-group mb-2" type="text" name="ville_fact" value="<?php echo set_value('ville'); ?>" size="40px" placeholder="Ville"/>
        </br>

        <input class="form-group mb-2" type="text" name="pays_fact" value="<?php echo set_value('pays'); ?>" size="30px" placeholder="Pays"/>
        </br>  
    
        </br>  
        <h5>N° TVA Intracommunautaire</h5>
        <input class="form-group mb-2" type="text" name="num_tva_intra" value="<?php echo set_value('num_tva_intra'); ?>" size="10px" placeholder="Num TVA intra" />
        </br>  
        <h5>Condition de paiement</h5>
        <input class="form-group mb-2" type="text" name="cond_paiement" value="<?php echo set_value('cond_paiement'); ?>" size="40px" placeholder="condition de paiement"/>
        </br>  
        <h5>Encours maximum autorisé</h5>
        <input class="form-group mb-2" type="text" name="encours_max" value="<?php echo set_value('encours_max'); ?>" size="40px" placeholder="Encours maximum"/>
        
        </br>
        </br>
            <div align="center">
                <button class="btn btn-primary" type="submit" value="Submit" name= "enregistrement"> Enregistrement</button>
            </div>
    </form>
</div>
</body>
</html>



