
<html>

<head>
    <title>Ajout adresse facturation</title>
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
            <h2>Formulaire Ajout adresse de facturation</h2>
        </br>     
        
    </div>
    <div align="center">    
<?php echo validation_errors(); ?>
    </div>    
<div>
<?php echo form_open('ajout_fact'); ?>    
    <form >
        <h5>Raison Sociale</h5>
        <select name="raison_sociale"  placeholder="Raison sociale" >
           <option value="valeur defaut">choix société</option>
           <?php   
             foreach ($choix_societe as $key){
                 $a= $key['raison_sociale'];
                 echo "<option value=$a>$a</option>";
                 }
             ?>
        </select>    
        </br>
        </br>
        <input class="form-group mb-2" type="text" name="adressefact" value="<?php echo set_value('adressefact'); ?>" size="60px" placeholder="Adresse : N°, type voie, Nom rue..."/> 
        <input class="form-group mb-2" type="text" name="adressefact1" value="<?php echo set_value('adressefact1'); ?>" size="60px" placeholder="Complément adresse de facturation 1"/>    
        <input class="form-group mb-2" type="text" name="adressefact2" value="<?php echo set_value('adressefact2'); ?>" size="60px" placeholder="Complément adresse de facturation 2"/>  
        <input class="form-group mb-2" type="text" name="adressefact3" value="<?php echo set_value('adressefact3'); ?>" size="60px" placeholder="Complément adresse de facturation 3"/>
        </br> 
        <h5>Localité</h5>
        <input class="form-group mb-2" type="text" name="code_postal_fact" value="<?php echo set_value('code_postal_fact'); ?>" size="10px" placeholder="Code Postal" />
        <input class="form-group mb-2" type="text" name="ville_fact" value="<?php echo set_value('ville_fact'); ?>" size="40px" placeholder="Ville"/>
        </br>
        <input class="form-group mb-2" type="text" name="pays_fact" value="<?php echo set_value('pays_fact'); ?>" size="30px" placeholder="Pays"/>
        </br>  
        
        </br>  
        <h5>N° TVA Intracommunautaire</h5>
        <input class="form-group mb-2" type="text" name="num_tva_intra" value="<?php echo set_value('num_tva_intra'); ?>" size="20px" placeholder="Num TVA intra" />
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



