<?php
include('../config/app.php');
/*********************************** Annulation Intervention *************************************/

if (isset($_POST['annulerIntervention'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $statutIncident = $_POST['statutIncident'];
    $raisons = $_POST['raisons'];

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
    header("Location: ../interventions_planifiees");

    // echo 'yes';
    // echo $numero_incident.'</br>';
    // echo $categorie.'</br>';
    // echo $description.'</br>';
    // echo $testi.'</br>';
}
/*********************************** Relance Intervenant *************************************/

if (isset($_POST['relancerIntervenant'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $msg = $_POST['msg'];

    // echo $code_intervention.'</br>';
    // echo $msg.'</br>';
    // echo $auteur.'</br>';die;

    // Persister le msg
    $sql = mysqli_query($con, "INSERT INTO `relances_intervenant` (`code_intervention`, `msg`, `date_relance`, `auteur`) 
    VALUES ('$code_intervention', '$msg', '$date_saisie', '$auteur')");

    // Get id intervenant
    $getIdIntervenant = mysqli_query($con, "SELECT intervenant FROM interventions WHERE code_intervention='$code_intervention'");

    while ($row = mysqli_fetch_array($getIdIntervenant)) {
        $intervenant = $row['intervenant'];
    }
    //  echo  $intervenant;die;
    // Envoyer les notifications
    // Requete de verification prestataire
    $verifPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$Intervenant'");
    // Requete de verification prestataire
    $verifInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$Intervenant'");
    // Requete de verification prestataire
    $verifService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$Intervenant'");

    if (mysqli_num_rows($verifPresta) > 0) {
        //  echo 'Je suis un Presta !';die;
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

        // Notifier intervenant
        //  include('notification_relance.php');

        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Intervenant relancé avec succès !";
        header("Location: ../interventions_planifiees");
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

            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Intervention planifiée avec succès !";
            header("Location: ../signalements");
        }
        // echo 'done';die;

    } elseif (mysqli_num_rows($verifService) > 0) {
        //  echo 'Je suis un service !';

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
            $_SESSION['message'] = "Intervenant relancé avec succès !";
            header("Location: ../fiche_intervention?code_intervention=$code_intervention");
        }
        // echo 'done';die;

    } else {
        //  echo 'Je suis introuvable';
        //  $type_intervenant='service';
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Intervenant relancé avec succès !";
        header("Location: ../interventions_planifiees");
    }
}

/*********************************** Cloture Incident *************************************/

if (isset($_POST['cloturerIntervention'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $comment = $_POST['comment'];

    // echo $code_intervention.'</br>';
    // echo $comment.'</br>';
    // echo $auteur.'</br>';
    // die;

    // Persister le msg
    $sql = mysqli_query($con, "INSERT INTO `commentaires_cloture_intervention` (`code_intervention`, `commentaire`, `date_cloture`, `auteur`) 
    VALUES ('$code_intervention', '$comment', '$date_saisie', '$auteur')");


    // Requete de verification prestataire
    $getNumeroIncident = mysqli_query($con, "SELECT numero_incident FROM interventions WHERE code_intervention='$code_intervention'");

    while ($row = mysqli_fetch_array($getNumeroIncident)) {
        $numero_incident = $row['numero_incident'];
    }
    // Update intervention
    $sql = mysqli_query($con, "UPDATE interventions SET statut='terminee' WHERE code_intervention='$code_intervention' ");

    // Update Incident
    $sql = mysqli_query($con, "UPDATE signalements SET statut='termine' WHERE numero_incident='$numero_incident' ");

    // Notifier gestionnaire



    //  include('notification_relance.php');

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Intervention cloturée avec succès !";
    header("Location: ../interventions_terminees");
}
/*********************************** Pre approbation Incident *************************************/

if (isset($_POST['preapprobationIntervention'])) {

    $code_intervention = $_POST['code_intervention'];
    $auteur = $_POST['auteur'];
    $comment = $_POST['comment'];

    // echo $code_intervention.'</br>';
    // echo $comment.'</br>';
    // echo $auteur.'</br>';
    // die;

    // Persister le msg
    $sql = mysqli_query($con, "INSERT INTO `commentaires_cloture_intervention` (`code_intervention`, `commentaire`, `date_cloture`, `auteur`) 
    VALUES ('$code_intervention', '$comment', '$date_saisie', '$auteur')");


    // Requete de verification prestataire
    $getNumeroIncident = mysqli_query($con, "SELECT numero_incident FROM interventions WHERE code_intervention='$code_intervention'");

    while ($row = mysqli_fetch_array($getNumeroIncident)) {
        $numero_incident = $row['numero_incident'];
    }
    // Update intervention
    $sql = mysqli_query($con, "UPDATE interventions SET statut='Approuvée par le responsable' WHERE code_intervention='$code_intervention' ");

    // Update Incident
    $sql = mysqli_query($con, "UPDATE signalements SET statut='Approuvée par le responsable' WHERE numero_incident='$numero_incident' ");

    // Notifier gestionnaire



    //  include('notification_relance.php');

    $_SESSION['errorMsg'] = false;
    $_SESSION['successMsg'] = true;
    $_SESSION['message'] = "Intervention preapprouvé avec succès !";
    header("Location: ../interventions_approuvees");
}
