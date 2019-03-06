

<html>
<style>
    .liste_devis {
        margin-top: 50px;
        margin-left: 40px;
        margin-right: 60px    
    }
</style>    
<div class="liste_devis">    
<?php foreach ($liste_devis as $row){?>
<div class="">
    <?php 
    echo '<hr/>';
    echo $row['titre_devis'];
    echo'</br>' ;   
    echo $row['contenu'];
    echo '<hr/>'; ?>
</div>    
<?php

}
?>

    
     
          
</html>