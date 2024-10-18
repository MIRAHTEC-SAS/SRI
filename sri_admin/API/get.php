<?php

//  ------------------------ API - GET ==> Action read -------------------------------

// GET Batiments

    if ($action == 'getBatiments') {
        $sql = $con->query("SELECT * FROM batiments ORDER BY id DESC");

        if (!$sql) {
            $result['error'] = "Impossible de lire les donnees ";
            $result['message'] = "Impossible de lire les donnees !";
        } 
        else {
            $result['error'] = false;
            $batiments = [];

            while ($row = $sql->fetch_assoc()) {
                array_push($batiments, $row);
            }

            $result['batiments'] = $batiments;
        }
    }

// GET Etages

    if ($action == 'getEtages') {
        $sql = $con->query("SELECT * FROM etages ORDER BY id DESC");

        if (!$sql) {
            $result['error'] = "Impossible de lire les donnees ";
            $result['message'] = "Impossible de lire les donnees !";
        } 
        else {
            $result['error'] = false;
            $etages = [];

            while ($row = $sql->fetch_assoc()) {
                array_push($etages, $row);
            }

            $result['etages'] = $etages;
        }
    }

    // Get Services
if ($action == 'getServices') {
    $sql = $con->query("SELECT * FROM services ORDER BY id DESC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $services = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($services, $row);
        }

        $result['services'] = $services;
    }
}

// batiments services
if ($action == 'getBatimentsServices') {
    $sql = $con->query("SELECT localisation_services.code_batiment, localisation_services.code_service, batiments.nom_batiment FROM `localisation_services` INNER JOIN batiments ON batiments.code_batiment=localisation_services.code_batiment");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $batiments_services = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($batiments_services, $row);
        }

        $result['batiments_services'] = $batiments_services;
    }
}

// GET Rôles

if ($action == 'getRoles') {
    $sql = $con->query("SELECT * FROM roles ORDER BY id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $roles = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($roles, $row);
        }

        $result['roles'] = $roles;
    }
}

// GET Gestionnaires

if ($action == 'getGestionnaires') {
    $sql = $con->query("SELECT * FROM gestionnaires ORDER BY id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $gestionnaires = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($gestionnaires, $row);
        }

        $result['gestionnaires'] = $gestionnaires;
    }
}

// GET Responsables

if ($action == 'getResponsables') {
    $sql = $con->query("SELECT * FROM responsables_dage ORDER BY id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $responsables = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($responsables, $row);
        }

        $result['responsables'] = $responsables;
    }
}

// GET Intervenants

if ($action == 'getIntervenants') {
    $sql = $con->query("SELECT * FROM intervenants_interne ORDER BY id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } 
    else {
        $result['error'] = false;
        $intervenants = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($intervenants, $row);
        }

        $result['intervenants'] = $intervenants;
    }
}


