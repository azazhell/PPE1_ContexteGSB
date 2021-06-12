<?php
/**
 * Gestion de la validation des fiches de frais
 * 
 * 
 * */


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['idVisiteur'];

$lesVisiteurs = $pdo->getListeVisiteursNC($idVisiteur);

foreach ($lesVisiteurs as $unVisiteur) {
    $id = $unVisiteur['id']; 
    $lesMois = $pdo->getLesMoisDisponibles($id);
    var_dump($lesMois);
    
    include 'vues/v_listeVisiteurs.php';
    
}
/*
 * lors du foreach, 
 * duplication lié au placement de l'include "include 'vues/v_listeVisiteurs.php';"
 * cependant la duplication fait fonctionner la liste déroulante des mois ...
 * grâce à la duplication justement
 */

switch ($action) {
    case 'selectionnerVisiteur':      

        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];

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
        
        
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerFrais.php';
        break;   
    case 'validerFicheFrais':

        break;
}        


?>