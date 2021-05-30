<?php
/**
 * Gestion de la validation des fiches de frais
 * 
 * 
 * */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['idVisiteur'];


switch ($action) {
    case 'selectionnerVisiteur': 
        $lesVisiteurs = $pdo->getListeVisiteursNC($idVisiteur);
        include 'vues/v_listeVisiteurs.php';
         
         foreach ($lesVisiteurs as $unVisiteur) {
             $id = $unVisiteur['id'];
         }
        //var_dump($lesVisiteurs);
        //var_dump($lesVisiteurs[0]);
        //var_dump($id);
        
        /*faire passer un id visiteur (voir ci-dessus) et non pas le idVisiteur de la session*/
        $lesMois = $pdo->getLesMoisDisponibles($id); 
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include 'vues/v_listeMois.php';
        break;
    case 'voirFrais':
        $leVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        //$lesVisiteurs = $pdo->getListeVisiteursNC();
        //$visiteurASelectionner = $leVisiteur;
        include 'vues/v_listeVisiteurs.php';              
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $moisASelectionner = $leMois;
        include 'vues/v_listeMois.php';
        
        //récupérer les données de getLesInfosFicheFrais($idVisiteur, $mois)
        
        break;
    case 'corrigerFraisForfait':
        include 'vues/v_listeFraisForfait.php';
        break;
    case 'corrigerFraisHorsForfait':
        include 'vues/v_listeFraisHorsForfait.php';
        break;
    case 'validerFicheFrais':
        include 'vues/v_validerFrais.php';
        break;
}
//require 'vues/v_listeFraisForfait.php';
//require 'vues/v_listeFraisHorsForfait.php';
//require 'vues/v_validerFrais.php';

?>