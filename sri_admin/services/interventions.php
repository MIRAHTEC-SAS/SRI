<?php
session_start();
include('../config/app.php');
/*********************************** Edition incident *************************************/

if (isset($_POST['annulerIntervention'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $statutIncident = $_POST['statutIncident'];
    $raisons = mysqli_real_escape_string($con, $_POST['raisons']);

    // echo $code_intervention.'</br>';
    // echo $raisons.'</br>';
    // echo $auteur.'</br>';
    // echo $statutIncident;die;

    // Persister la raison
    $sql = mysqli_query($con, "INSERT INTO `commentaires_annulation_intervention` (`code_intervention`, `commentaire`, `date_annulation`, `matricule_auteur`) 
    VALUES ('$code_intervention', '$raisons', '$date_saisie', '$auteur');");

    // Mettre le statut en annulé

    // Update Statut Intervention

    $sql = mysqli_query($con, "UPDATE interventions set statut='annulee' where code_intervention='$code_intervention'");

    // Update statut Incident
    // Get numero incident
    $getNumIncident = mysqli_query($con, "SELECT numero_incident FROM interventions WHERE code_intervention='$code_intervention'");
    while ($row = mysqli_fetch_array($getNumIncident)) {
        $numero_incident = $row['numero_incident'];
    }
    // Update
    $sql = mysqli_query($con, "UPDATE signalements set statut='$statutIncident' where numero_incident='$numero_incident'");

    // Maj Historique statut Intervention
    $sql = mysqli_query($con, "INSERT INTO `historique_statuts_intervention` (`code_intervention`, `statut`, `date_statut`, `auteur`) 
    VALUES ('$code_intervention', 'annulee', '$date_saisie', '$auteur')");

    // Maj Historique statut Incident
    $sql = mysqli_query($con, "INSERT INTO `historique_statuts_incident` (`numero_incident`, `statut`, `date_statut`, `auteur`) 
    VALUES ('$numero_incident', '$statutIncident', '$date_saisie', '$auteur')");

    // Notifié intervenant



    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Intervention annulée avec succès !";
    header("Location: ../interventions_annulees");

    // echo 'yes';
    // echo $numero_incident.'</br>';
    // echo $categorie.'</br>';
    // echo $description.'</br>';
    // echo $testi.'</br>';
}
/*********************************** Edition incident *************************************/

if (isset($_POST['relancerIntervenant'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $msg = mysqli_real_escape_string($con, $_POST['msg']);

    // echo $code_intervention.'</br>';
    // echo $msg.'</br>';
    // echo $auteur.'</br>';die;

    // Persister le msg
    $sql = mysqli_query($con, "INSERT INTO `relances_intervenant` (`code_intervention`, `msg`, `date_relance`, `auteur`) 
    VALUES ('$code_intervention', '$msg', '$date_saisie', '$auteur')");

    // Envoyer les notifications
    // TO DOOOOOOO

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Intervenant relancé avec succès !";
    header("Location: ../fiche_intervention?code_intervention=$code_intervention");
}
