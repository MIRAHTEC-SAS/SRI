<?php

// DELETE Ministere

if ($action == 'deleteMinistere') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM ministeres WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Ministere supprimé avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Direction generale

if ($action == 'deleteDirectionGenerale') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM directions_generales WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Direction générale supprimée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Direction

if ($action == 'deleteDirection') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM directions WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Direction supprimée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}


// DELETE Secteur

if ($action == 'deleteSecteur') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM secteurs WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Secteur supprimé avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Metier


if ($action == 'deleteCorps') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM corps WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Corps supprimé avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Banque


if ($action == 'deleteBanque') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM banques WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Banque supprimée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Agences


if ($action == 'deleteAgence') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM agences WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Agence supprimée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

// DELETE Hierarchie


if ($action == 'deleteHierarchie') {
    $id = $_POST['id'];

    $sql =  $con->query("DELETE FROM hierarchies WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Hierarchie supprimée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la suppression !!";
    }
}

?>