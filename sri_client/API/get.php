<?php

//  ------------------------ API - GET ==> Action read -------------------------------

// GET Services

if ($action == 'getServices') {
    $sql = $con->query("SELECT DISTINCT localisation_services.code_service, services.libelle as nom_service FROM `localisation_services` INNER join services on services.code_service=localisation_services.code_service ORDER BY services.libelle ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $services = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($services, $row);
        }

        $result['services'] = $services;
    }
}

// GET Batiments Services

if ($action == 'getBatimentsServices') {
    $sql = $con->query("SELECT localisation_services.code_service, batiments.adresse, batiments.code_batiment, batiments.nom_batiment FROM `localisation_services` inner join batiments on batiments.code_batiment=localisation_services.code_batiment");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $batiments_services = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($batiments_services, $row);
        }

        $result['batiments_services'] = $batiments_services;
    }
}

// GET Batiments

if ($action == 'getBatiments') {
    $sql = $con->query("SELECT * FROM batiments order by id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $batiments = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($batiments, $row);
        }

        $result['batiments'] = $batiments;
    }
}

// GET Types Localisation

if ($action == 'typesLocalisation') {
    $sql = $con->query("SELECT * FROM `types_localisation` order by id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $typesLocalisation = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($typesLocalisation, $row);
        }

        $result['typesLocalisation'] = $typesLocalisation;
    }
}

// GET Types Incidents

if ($action == 'typesIncident') {
    $sql = $con->query("SELECT * FROM `type_incidents` order by id ASC");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $typesIncident = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($typesIncident, $row);
        }

        $result['typesIncident'] = $typesIncident;
    }
}


// GET Etages

if ($action == 'getEtages') {
    $sql = $con->query("SELECT localisation_services_etage.code_service, localisation_services_etage.code_batiment, etages.code_etage, etages.nom_etage FROM `localisation_services_etage` INNER JOIN etages ON etages.code_etage=localisation_services_etage.code_etage");

    if (!$sql) {
        $result['error'] = "Impossible de lire les donnees ";
        $result['message'] = "Impossible de lire les donnees !";
    } else {
        $result['error'] = false;
        $etages = [];

        while ($row = $sql->fetch_assoc()) {
            array_push($etages, $row);
        }

        $result['etages'] = $etages;
    }
}

// SELECT localisation_services_etage.code_service, localisation_services_etage.code_batiment, etages.code_etage, etages.nom_etage FROM `localisation_services_etage` INNER JOIN etages ON etages.code_etage=localisation_services_etage.code_etage
?>