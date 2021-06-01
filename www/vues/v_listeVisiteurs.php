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
                        
                        //évite les doublons de l'array et sélectionne le premier élément de la liste déroulante
                        $compteur = count($unVisiteur);
                        var_dump($compteur);
                        if ($id == $compteur) {
                            ?>
                            <option label="<?php echo $id ?>" selected value="<?php echo $id ?>">
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