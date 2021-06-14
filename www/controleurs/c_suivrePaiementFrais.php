<?php
/**
 * Gestion du suivie de paiement des fiches de frais
 *
 *
 * */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = $_SESSION['idVisiteur'];


switch ($action) {
    case 'selectionnerFiche':
        //
        break;
    case 'afficherDetailFiche':
        //
        break;
    case 'changementEtat':
        //
        break;
}
?>
<h2>Suivre le paiement des fiches de frais</h2>


