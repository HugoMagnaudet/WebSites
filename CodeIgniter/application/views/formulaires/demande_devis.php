<h2><?php echo $title; ?></h2>
<style>
    div {
        margin-left: 20px;
        margin-right: 40px    
    }
</style>
<?php echo validation_errors(); ?>

<?php echo form_open('devis'); ?>

<div class="form-group">
    <label for="titre_devis">Titre</label>
    <input class="form-control" type="text" name="titre_devis" value="<?php echo set_value('titre_devis'); ?>" />
</div>

</br>

<div class="form-group shadow-textarea">
  <label for="demande">Descriptif</label>
  <textarea name="contenu" class="form-control z-depth-1" id="contenu" rows="8" placeholder="Entrez votre demande..."></textarea>
</div>

</br>

<div align="center">
    <button class="btn btn-primary" type="submit" value="Submit" name= "envoie_dem_devis"> Envoyer ma demande </button>
</div>

</form>