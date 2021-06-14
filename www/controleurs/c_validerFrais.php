<?php
/**
 * Gestion de la validation des fiches de frais
 * 
 * 
 * */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['idVisiteur'];


/* le problème vient du foreach de selection d'id
 * la liste mois ne propose que les mois pour l'id 'f4'
 * soit le dernier de la liste d'id 
 * trouver un moyen de passer outre ce problème sans utiliser le bug de duplication
 */
$lesVisiteurs = $pdo->getListeVisiteursNC($idVisiteur);
include 'vues/v_listeVisiteurs.php';
foreach ($lesVisiteurs as $unVisiteur) {
    $id = $unVisiteur['id'];
    $lesMois = $pdo->getLesMoisDisponibles($id);
}        
$lesCles = array_keys($lesMois);
$moisASelectionner = $lesCles[0];
include 'vues/v_listeMois.php';


switch ($action) {
    case 'selectionnerVisiteur': 
        //
        break;
    case 'voirFrais':
        $leVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = $leVisiteur;
        $moisASelectionner = $leMois;
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($id, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id, $leMois);
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        if($lesInfosFicheFrais == null){
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
        } else {
            include 'vues/v_listeFraisForfait.php';
            include 'vues/v_listeFraisHorsForfait.php';
            include 'vues/v_validerFrais.php';  
        }    
        break;
    case 'correction':
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
        } else {
            ajouterErreur('Les valeurs des frais doivent Ãªtre numÃ©riques');
            include 'vues/v_erreurs.php';
        }
        
        // réception de la valeur de suppression du frais hors forfait
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        //trouver le moyen d'insérer 'REFUSE' sur le libellé du frais hors forfait
        
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerFrais.php';
        break;   
    case 'validerFicheFrais':
        $etat = filter_input(INPUT_POST, 'validation', FILTER_SANITIZE_STRING);
        if ($etat == "VA"){
        $pdo->majEtatFicheFrais($id, $leMois, $etat);
        }
        //mettre à jour la date de modification de la fiche.
        
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerFrais.php';
        break;
        
}
?>