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
        foreach ($lesVisiteurs as $unVisiteur) {
            $id = $unVisiteur['id'];
            $lesMois = $pdo->getLesMoisDisponibles($id);
            //$lesCles = array_keys($lesMois);
        //var_dump($lesCles);
            //$moisASelectionner = $lesCles[0];
        //var_dump($moisASelectionner);
        }
        include 'vues/v_listeVisiteurs.php';
        include 'vues/v_listeMois.php';
        break;
    case 'voirFrais':
        $leVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($id);
        $moisASelectionner = $leMois;
        include 'vues/v_listeVisiteurs.php';
        include 'vues/v_listeMois.php';
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        include 'vues/v_validerFrais.php';
        
        //récupérer les données de getLesInfosFicheFrais($idVisiteur, $mois)
        
        break;
    case 'correction':
        include 'vues/v_listeFraisForfait.php';
        include 'vues/v_listeFraisHorsForfait.php';
        break;
    case 'validerFicheFrais':
        include 'vues/v_validerFrais.php';
        break;
}

?>