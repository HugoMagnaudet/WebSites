<h2><?php echo $titre; ?></h2>

<?php foreach ($devis as $i): ?>

        <h3><?php echo $i['titre']; ?></h3>
        <div class="main">
                <?php echo $i['contenu']; ?>
        </div>
        <p><a href="<?php echo site_url('devis/'.$i['num_devis']); ?>">Voir devis</a></p>

<?php endforeach; ?>