<?php
?>
<div class="row">
    <div class="col-md-4">
        <form action="index.php?uc=validerFrais&action=selectionnerVisiteur" 
              method="post" role="form">    
            <div class="form-group">
                <label for="lstVisiteur" accesskey="n">Choisir le visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id']; 
                        $nom = $unVisiteur['nom'];                       
                        $prenom = $unVisiteur['prenom']; 
                        
                        //permet de faire apparaître la liste de nom-prenom dans l'ordre alphabétique.
                        $compteur = count($unVisiteur);
                        
                        if ($id == $compteur) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }

                    ?>    

                </select> 
            </div>
		</form>
	</div> 
  
</div>