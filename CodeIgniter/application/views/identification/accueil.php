

<head>


<style>
    .alert .alert-success fade in {
        padding-top: 20px
    }
    
    
</style>
</head>

<body>
<!---===========Utilisateur non connecté=================--->
<div class="error">
    <?php 
        if ($users['nom']== NULL) { 
        echo ' utilisateur ou mot de passe incorrect';}
        ?>
        </br>
        <a href=""> retour</a>
</div>
<!---===========Utilisateur est connecté=================--->  
<div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Succès</strong>  
            <?php echo $users['nom']." est connecté";?> 
</div>



</body>
</html>