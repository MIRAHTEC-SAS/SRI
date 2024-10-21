<?php
session_start();
include('../config/app.php');
/*********************************** Edition incident *************************************/

if (isset($_POST['editerIncident'])) {

    $numero_incident = $_POST['numero_incident'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];


    // Update Incident
    $sql = mysqli_query($con, "UPDATE signalements set description='$description' where numero_incident='$numero_incident'");

    // Update Incident
    $sql = mysqli_query($con, "UPDATE signalements_incidents set code_incident='$categorie' where numero_incident='$numero_incident'");


    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Incident edité avec succés !";
    header("Location: ../details_signalements?numero_incident=$numero_incident");

    // echo 'yes';
    // echo $numero_incident.'</br>';
    // echo $categorie.'</br>';
    // echo $description.'</br>';
    // echo $testi.'</br>';
}
/*********************************** Affectation incident *************************************/
if (isset($_POST['affecterIncident'])) {

    $numero_incident = $_POST['numero_incident'];
    $code_incident = $_POST['code_incident'];
    $code_service = $_POST['code_service'];
    $intervenant = $_POST['intervenant'];
    $date_intervention = $_POST['date_intervention'];
    $auteur = $_POST['auteur'];

    // GET Date declaration...
    $getDateDeclaration = mysqli_query($con, "SELECT * FROM signalements WHERE numero_incident='$numero_incident'");
    while ($row = mysqli_fetch_array($getDateDeclaration)) {
        $date_declaration = date('Y-m-d', strtotime($row['date_reception']));
    }

    // echo $numero_incident.'</br>';
    // echo $code_service.'</br>';
    // echo $code_incident.'</br>';
    // echo $intervenant.'</br>';
    // echo 'Date Incident : '.$date_declaration.'</br>';
    // echo 'Intervention : '.$date_intervention.'</br>';
    // echo $auteur;

    // die;


    if ($date_declaration > $date_intervention) {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "La date d'intervention ne peut pas etre anterieure a la date de l'incident !";
        header("Location: ../details_signalements?numero_incident=$numero_incident&amp;&affect=1");
    } else {


        // echo $numero_incident.'</br>';
        // echo $code_service.'</br>';
        // echo $code_incident.'</br>';
        // echo $intervenant.'</br>';
        // echo $date_intervention.'</br>';

        // echo $auteur;die;


        // echo $auteur;die;
        // Generation Code Intervention
        $getLastCode = mysqli_query($con, "SELECT max(code_intervention) as lastCode FROM interventions");
        while ($row = mysqli_fetch_array($getLastCode)) {
            $lastCode = $row['lastCode'];
        }

        if (!empty($lastCode)) {
            $code_intervention = $lastCode + 1;
        } else {
            $code_intervention = 901;
        }

        // echo $numero_incident.'</br>';
        // echo $code_incident.'</br>';
        // echo $code_service.'</br>';
        // echo $intervenant.'</br>';
        // echo $code_intervention.'</br>';
        // echo $dateDuJour.'</br>';
        // echo $date_saisie.'</br>';
        // echo $date_intervention.'</br>';
        // die;

        // Requete de verification prestataire
        $verifPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");
        // Requete de verification prestataire
        $verifInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");
        // Requete de verification prestataire
        $verifService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");

        if (mysqli_num_rows($verifPresta) > 0) {
            // echo 'Je suis un Presta !'
            // Recuperer les infos
            $type_intervenant = 'prestataire';
            $getInfosPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");

            while ($row = mysqli_fetch_array($getInfosPresta)) {
                $matricule_presta = $row['matricule_prestat'];
                $denomination = $row['denomination'];
                $adresse = $row['adresse'];
                $telephone = $row['telephone'];
                $email = $row['email'];
            }

            //persister dans la table des interventions avec statut planifiée
            $reqPersistIntervention = mysqli_query($con, "INSERT INTO `interventions` (`code_intervention`, `numero_incident`, `service`, `code_incident`, `intervenant`, `type_intervenant`, `date_intervention`, `date_saisie`, `statut`) 
        VALUES ('$code_intervention', '$numero_incident', '$code_service', '$code_incident', '$intervenant', '$type_intervenant', '$date_intervention', '$date_saisie', 'planifiee')");

            // Maj Historique statut Intervention
            $sql = mysqli_query($con, "INSERT INTO `historique_statuts_intervention` (`code_intervention`, `statut`, `date_statut`, `auteur`) 
        VALUES ('$code_intervention', 'planifiee', '$date_saisie', '$auteur')");
            if (!$reqPersistIntervention) {
                // echo 'Pas persisté !';
                $_SESSION['errorMsg'] = true;
                $_SESSION['successMsg'] = false;
                $_SESSION['message'] = "L'intervention n'a pas pu etre enregistrée !";
                header("Location: ../details_signalements?numero_incident=$numero_incident&amp;&affect=1");
            } else {
                // echo 'Persisté';
                // Mettre a jour le statut du signalement
                $sql = mysqli_query($con, "UPDATE signalements SET statut='en cours' WHERE numero_incident='$numero_incident'");

                // historique statut
                // Maj Historique statut Incident
                $sql = mysqli_query($con, "INSERT INTO `historique_statuts_incident` (`numero_incident`, `statut`, `date_statut`, `auteur`) 
            VALUES ('$numero_incident', 'en cours', '$date_saisie', '$auteur')");


                // Get categorie incident
                $getCategorie = mysqli_query($con, "SELECT * FROM `type_incidents` WHERE code_incident='$code_incident'");

                while ($row = mysqli_fetch_array($getCategorie)) {
                    $categorie = $row['type_incident'];
                }

                // Adresse service
                $reqInfosLocalisation = $con->query("SELECT * FROM `localisation_services` INNER JOIN batiments on localisation_services.code_batiment=batiments.code_batiment WHERE localisation_services.code_service='$code_service'");

                while ($row = mysqli_fetch_array($reqInfosLocalisation)) {
                    $localisation = $row['nom_batiment'];
                    $adresse = $row['adresse'];
                    $contact = $row['contact'];
                }

                // Etage

                $reqEtage = $con->query("SELECT * FROM `signalements` inner join etages ON etages.code_etage=signalements.code_etage WHERE signalements.numero_incident='$numero_incident'");

                while ($row = mysqli_fetch_array($reqEtage)) {
                    $etage = $row['nom_etage'];
                    $piece = $row['piece'];
                }

                // Notifier l'intervenant
                $getInfosIncident = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service WHERE numero_incident='$numero_incident'");

                while ($row = mysqli_fetch_array($getInfosIncident)) {
                    $description = $row['description'];
                    $photo = $row['photo'];
                    $service = $row['libelle'];
                    $sigle = $row['sigle'];
                }

                //Check variables...
                // echo $numero_incident.'</br>';
                // echo $description.'</br>';
                // echo $photo.'</br>';
                // echo $service.'</br>';
                // echo $sigle.'</br>';
                // echo $etage.'</br>';
                // echo $piece.'</br>';
                // echo $adresse.'</br>';
                // echo $localisation.'</br>';
                // echo $categorie.'</br>';
                // echo $contact.'</br>';
                // echo $telephone.'</br>';
                // echo $email.'</br>';

                // die;


                include('notification_affectation.php');

                $_SESSION['errorMsg'] = false;
                $_SESSION['successMsg'] = true;
                $_SESSION['message'] = "Intervention planifiée avec succès !";
                header("Location: ../signalements.php");
            }
            // echo 'done';die;


        } elseif (mysqli_num_rows($verifInterne) > 0) {
            // echo 'Je suis interne !';

            $type_intervenant = 'interne';

            // Recuperer les infos
            $getInfosInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");

            while ($row = mysqli_fetch_array($getInfosInterne)) {
                $matricule_intervenant = $row['matricule_intervenant'];
                $intervenant_interne = $row['prenom'] . ' ' . $row['nom'];
                $telephone = $row['telephone'];
                $email = $row['email'];
            }

            //persister dans la table des interventions avec statut planifiée
            $reqPersistIntervention = mysqli_query($con, "INSERT INTO `interventions` (`code_intervention`, `numero_incident`, `service`, `code_incident`, `intervenant`, `type_intervenant`, `date_intervention`, `date_saisie`, `statut`) 
            VALUES ('$code_intervention', '$numero_incident', '$code_service', '$code_incident', '$intervenant', '$type_intervenant', '$date_intervention', '$date_saisie', 'planifiee')");

            // Maj Historique statut Intervention
            $sql = mysqli_query($con, "INSERT INTO `historique_statuts_intervention` (`code_intervention`, `statut`, `date_statut`, `auteur`) 
            VALUES ('$code_intervention', 'planifiee', '$date_saisie', '$auteur')");
            if (!$reqPersistIntervention) {
                // echo 'Pas persisté !';
                $_SESSION['errorMsg'] = true;
                $_SESSION['successMsg'] = false;
                $_SESSION['message'] = "L'intervention n'a pas pu etre enregistrée !";
                header("Location: ../details_signalements?numero_incident=$numero_incident&amp;&affect=1");
            } else {
                // echo 'Persisté';
                // Mettre a jour le statut du signalement
                $sql = mysqli_query($con, "UPDATE signalements SET statut='en cours' WHERE numero_incident='$numero_incident'");

                // historique statut
                // Maj Historique statut Incident
                $sql = mysqli_query($con, "INSERT INTO `historique_statuts_incident` (`numero_incident`, `statut`, `date_statut`, `auteur`) 
                VALUES ('$numero_incident', 'en cours', '$date_saisie', '$auteur')");


                // Notifier l'intervenant
                include('notification_affectation.php');


                $_SESSION['errorMsg'] = false;
                $_SESSION['successMsg'] = true;
                $_SESSION['message'] = "Intervention planifiée avec succès !";
                header("Location: ../signalements.php");
            }
            // echo 'done';die;

        } elseif (mysqli_num_rows($verifService) > 0) {
            echo 'Je suis un service !';

            $type_intervenant = 'service';

            // Recuperer les infos
            $getInfosService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");

            while ($row = mysqli_fetch_array($getInfosService)) {
                $matricule_service = $row['matricule_service'];
                $denomination = $row['denomination'];
                $telephone = $row['telephone'];
                $email = $row['email'];
            }

            //persister dans la table des interventions avec statut planifiée
            $reqPersistIntervention = mysqli_query($con, "INSERT INTO `interventions` (`code_intervention`, `numero_incident`, `service`, `code_incident`, `intervenant`, `type_intervenant`, `date_intervention`, `date_saisie`, `statut`) 
            VALUES ('$code_intervention', '$numero_incident', '$code_service', '$code_incident', '$intervenant', '$type_intervenant', '$date_intervention', '$date_saisie', 'planifiee')");

            // Maj Historique statut Intervention
            $sql = mysqli_query($con, "INSERT INTO `historique_statuts_intervention` (`code_intervention`, `statut`, `date_statut`, `auteur`) 
            VALUES ('$code_intervention', 'planifiee', '$date_saisie', '$auteur')");
            if (!$reqPersistIntervention) {
                // echo 'Pas persisté !';
                $_SESSION['errorMsg'] = true;
                $_SESSION['successMsg'] = false;
                $_SESSION['message'] = "L'intervention n'a pas pu etre enregistrée !";
                header("Location: ../details_signalements?numero_incident=$numero_incident&amp;&affect=1");
            } else {
                // echo 'Persisté';
                // Mettre a jour le statut du signalement
                $sql = mysqli_query($con, "UPDATE signalements SET statut='en cours' WHERE numero_incident='$numero_incident'");

                // historique statut
                // Maj Historique statut Incident
                $sql = mysqli_query($con, "INSERT INTO `historique_statuts_incident` (`numero_incident`, `statut`, `date_statut`, `auteur`) 
                VALUES ('$numero_incident', 'en cours', '$date_saisie', '$auteur')");


                // Notifier l'intervenant

                $_SESSION['errorMsg'] = false;
                $_SESSION['successMsg'] = true;
                $_SESSION['message'] = "Intervention planifiée avec succès !";
                header("Location: ../signalements.php");
            }
            // echo 'done';die;

        } else {
            echo 'Je suis introuvable';
            $type_intervenant = 'service';
        }
    }
    // die;
    //         echo $numero_incident.'</br>';
    //         echo $intervenant.'</br>';


}
/*********************************** Affectation incident *************************************/

if (isset($_POST['rejeterIncident'])) {

    $numero_incident = $_POST['numero_incident'];
    $raisons = $_POST['raisons'];
    $auteur = $_POST['auteur'];

    // echo $numero_incident.'</br>';
    // echo $raisons.'</br>';
    // echo $auteur.'</br>';

    $sql = mysqli_query($con, "INSERT INTO `commentaires_rejets` (`numero_incident`, `commentaire`, `date_rejet`, `matricule_auteur`) 
        VALUES ('$numero_incident', '$raisons', '$date_saisie', '$auteur')");

    // Maj Historique statut Intervention
    $sql = mysqli_query($con, "INSERT INTO `historique_statuts_incident` (`numero_incident`, `statut`, `date_statut`, `auteur`) 
        VALUES ('$numero_incident', 'rejete', '$date_saisie', '$auteur')");

    // Mettre a jour le statut du signalement
    $sql = mysqli_query($con, "UPDATE signalements SET statut='rejete' WHERE numero_incident='$numero_incident'");

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Demande d'intervention rejetée avec succès !";
    header("Location: ../signalements.php");
}
