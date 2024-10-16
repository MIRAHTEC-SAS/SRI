<?php
include('config/app.php');

$sql = $con->query("TRUNCATE TABLE commentaires_annulation_intervention");
$sql = $con->query("TRUNCATE TABLE commentaires_rejets");
$sql = $con->query("TRUNCATE TABLE statuts_incident");
$sql = $con->query("TRUNCATE TABLE historique_statuts_intervention");
$sql = $con->query("TRUNCATE TABLE historique_statuts_incident");
$sql = $con->query("TRUNCATE TABLE relances_intervenant");
$sql = $con->query("UPDATE signalements SET statut='en attente'");
// $sql = $con->query("TRUNCATE TABLE signalements_incidents");
$sql = $con->query("TRUNCATE TABLE interventions");


$_SESSION['errorMsg'] = false;
$_SESSION['successMsg'] = true;
$_SESSION['message'] = "Clean success !!";
header("Location: signalements");
