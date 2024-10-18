<?php
session_start();
include ('../config/app.php');
/*********************************** Parametrages Responsables par incident *************************************/
// Creation
if (isset($_POST['parametrerResponsables'])) {

    $responsable=$_POST['responsable'];
  
    $typesIncident=[];

    for ($i=0;$i<count($_POST['typesIncident']);$i++) {
        $typesIncident[]=$_POST['typesIncident'][$i];
    }

    for ($i=0;$i<count($typesIncident);$i++) {
        // echo $typesIncident[$i].'</br>';
        $code_incident=$typesIncident[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM responsables_incidents WHERE code_incident='$code_incident' AND matricule_responsable='$responsable'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `responsables_incidents` (`code_incident`, `matricule_responsable`) 
            VALUES ('$code_incident', '$responsable')");
        }
    }
   

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation validée avec succès !"; 
     header ("Location: ../responsables_incidents.php");

}
// Modification
if (isset($_POST['modifierResponsables'])) {

    $responsable=$_POST['responsable'];
    $id_affectation=$_POST['id_affectation'];
  
    $code_incident=$_POST['type_incident'];

    mysqli_query($con, "UPDATE `responsables_incidents` SET code_incident='$code_incident', matricule_responsable='$responsable' WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifiée avec succès !"; 
     header ("Location: ../responsables_incidents.php");

}
// Suppression
if (isset($_POST['supprimerResponsables'])) {

    $id_affectation=$_POST['id_affectation'];
  

    mysqli_query($con, "DELETE FROM `responsables_incidents` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimée avec succès !"; 
     header ("Location: ../responsables_incidents.php");

}
/*********************************** Intervenant Dage *************************************/
// Creation
if (isset($_POST['parametrerIntervenant'])) {

    $intervenant=$_POST['intervenant'];
  
    $typesIncident=[];

    for ($i=0;$i<count($_POST['typesIncident']);$i++) {
        $typesIncident[]=$_POST['typesIncident'][$i];
    }
    echo $intervenant.'</br>';
    for ($i=0;$i<count($typesIncident);$i++) {
        // echo $typesIncident[$i].'</br>';
        $code_incident=$typesIncident[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM intervenants_interne_incidents WHERE code_incident='$code_incident' AND matricule_intervenant='$intervenant'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `intervenants_interne_incidents` (`code_incident`, `matricule_intervenant`) 
            VALUES ('$code_incident', '$intervenant')");
        }
    }
   

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation validée avec succès !"; 
     header ("Location: ../intervenants_interne.php");

}
// Modification
if (isset($_POST['modifierIntervenant'])) {

    $intervenant=$_POST['intervenant'];
    $id_affectation=$_POST['id_affectation'];
  
    $code_incident=$_POST['type_incident'];

    mysqli_query($con, "UPDATE `intervenants_interne_incidents` SET code_incident='$code_incident', matricule_intervenant='$intervenant' WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifiée avec succès !"; 
     header ("Location: ../intervenants_interne.php");

}
// Suppression
if (isset($_POST['supprimerIntervenant'])) {

    $id_affectation=$_POST['id_affectation'];
  

    mysqli_query($con, "DELETE FROM `intervenants_interne_incidents` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimée avec succès !"; 
     header ("Location: ../intervenants_interne.php");

}

/*********************************** Affectation gestionnaires *************************************/
// Creation
if (isset($_POST['parametrerGestionnaire'])) {

    $gestionnaire=$_POST['matricule_gestionnaire'];
  
    $services=[];

    for ($i=0;$i<count($_POST['services']);$i++) {
        $services[]=$_POST['services'][$i];
    }
    echo $gestionnaire.'</br>';
    for ($i=0;$i<count($services);$i++) {
        //  echo $services[$i].'</br>';
        $code_service=$services[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM gestionnaires_services WHERE code_incident='$code_service' AND matricule_gestionnaire='$gestionnaire'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `gestionnaires_services` (`code_service`, `matricule_gestionnaire`) 
            VALUES ('$code_service', '$gestionnaire')");
        }
    }
    // die;
   

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation validée avec succès !"; 
     header ("Location: ../affecter_gestionnaires.php");

}
// Modification
if (isset($_POST['modifierParamGestionnaires'])) {

    $gestionnaire=$_POST['matricule_gestionnaire'];
    $code_service=$_POST['service'];
    $id_affectation=$_POST['id_affectation'];

    // echo $gestionnaire.'</br>';
    // echo $code_service.'</br>';die;

  
    $code_incident=$_POST['type_incident'];

    mysqli_query($con, "UPDATE `gestionnaires_services` SET code_service='$code_service', matricule_gestionnaire='$gestionnaire' WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifiée avec succès !"; 
     header ("Location: ../affecter_gestionnaires.php");

}
// Suppression
if (isset($_POST['supprimerParamGestionnaires'])) {

    $id_affectation=$_POST['id_affectation'];
  
//   echo $id_affectation.'</br>';die;

    mysqli_query($con, "DELETE FROM `gestionnaires_services` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimée avec succès !"; 
     header ("Location: ../affecter_gestionnaires.php");

}

/*********************************** Affectation Prestataires *************************************/
// Creation
if (isset($_POST['parametrerPrestataire'])) {

    $prestataire=$_POST['prestataire'];
  
    $typesIncident=[];

    echo $prestataire.'</br>';
    for ($i=0;$i<count($_POST['typesIncident']);$i++) {
        $typesIncident[]=$_POST['typesIncident'][$i];
    }
    // echo $intervenant.'</br>';
    for ($i=0;$i<count($typesIncident);$i++) {
        // echo $typesIncident[$i].'</br>';
        $code_incident=$typesIncident[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM prestataires_incidents WHERE code_incident='$code_incident' AND matricule_prestataire='$prestataire'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `prestataires_incidents` (`code_incident`, `matricule_prestataire`) 
            VALUES ('$code_incident', '$prestataire')");
        }
    }
    // die;
   

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation validée avec succès !"; 
     header ("Location: ../prestataires_incidents.php");

}
// Modification
if (isset($_POST['modifierPrestataire'])) {

    $prestataire=$_POST['prestataire'];
    $id_affectation=$_POST['id_affectation'];

    $code_incident=$_POST['type_incident'];

    // echo $prestataire.'</br>';
    // echo $id_affectation.'</br>';
    // echo $code_incident.'</br>';
    // die;

    mysqli_query($con, "UPDATE `prestataires_incidents` SET code_incident='$code_incident', matricule_prestataire='$prestataire' WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifiée avec succès !"; 
     header ("Location: ../prestataires_incidents.php");

}
// Suppression
if (isset($_POST['supprimerPrestataire'])) {

    $id_affectation=$_POST['id_affectation'];
  

    mysqli_query($con, "DELETE FROM `prestataires_incidents` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimée avec succès !"; 
     header ("Location: ../prestataires_incidents");

}

/*********************************** Affectation Services intervenant *************************************/
// Creation
if (isset($_POST['parametrerServiceIntervenant'])) {

    $matricule_service=$_POST['matricule_service'];
  
    $typesIncident=[];

    for ($i=0;$i<count($_POST['typesIncident']);$i++) {
        $typesIncident[]=$_POST['typesIncident'][$i];
    }
    // echo $matricule_service.'</br>';

    // echo $intervenant.'</br>';
    for ($i=0;$i<count($typesIncident);$i++) {
        // echo $typesIncident[$i].'</br>';
        $code_incident=$typesIncident[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM services_intervenant_incidents WHERE code_incident='$code_incident' AND matricule_service='$matricule_service'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `services_intervenant_incidents` (`code_incident`, `matricule_service`) 
            VALUES ('$code_incident', '$matricule_service')");
        }
    }
    // die;
   

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation validée avec succès !"; 
     header ("Location: ../services_intervenants_incidents.php");

}
// Modification
if (isset($_POST['modifierServiceIntervenant'])) {

    $matricule_service=$_POST['matricule_service'];
    $id_affectation=$_POST['id_affectation'];
    $id_affectation_init=$_POST['id_affectation_init'];
    $code_incident=$_POST['type_incident'];

    // echo $matricule_service.'</br>';
    // echo $id_affectation.'</br>';
    // echo $id_affectation_init.'</br>';
    // echo $code_incident.'</br>';
    // die;

    mysqli_query($con, "UPDATE `services_intervenant_incidents` SET code_incident='$code_incident', matricule_service='$matricule_service' WHERE id='$id_affectation_init'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifiée avec succès !"; 
     header ("Location: ../services_intervenants_incidents.php");

}
// Suppression
if (isset($_POST['supprimerServiceIntervenant'])) {

    $id_affectation=$_POST['id_affectation'];
  
    mysqli_query($con, "DELETE FROM `services_intervenant_incidents` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimée avec succès !"; 
     header ("Location: ../services_intervenants_incidents.php");

}


/*********************************** Services batiments *************************************/
// Creation
if (isset($_POST['validerServicesBatiments'])) {

    $code_service=$_POST['code_service'];

    // echo $code_service.'</br>';
    // die;
  
    $codes_batiment=[];

    for ($i=0;$i<count($_POST['code_batiment']);$i++) {
        $codes_batiment[]=$_POST['code_batiment'][$i];
    }

    // echo $matricule_service.'</br>';

    // echo $intervenant.'</br>';
    for ($i=0;$i<count($codes_batiment);$i++) {
        // echo $codes_batiment[$i].'</br>';
        $code_batiment=$codes_batiment[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM localisation_services WHERE code_service='$code_service' AND code_batiment='$code_batiment'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `localisation_services` (`code_batiment`, `code_service`) 
            VALUES ('$code_batiment', '$code_service')");
        }
    }
    // die;

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Service affecté avec succès aux batiments selectionés!"; 
     header ("Location: ../services_batiments.php");

}

// Modification
if (isset($_POST['modifierServiceBatiments'])) {

    $code_service=$_POST['code_serviceEdit'];
    $code_batiment=$_POST['code_batiment'];
    $id_affectation=$_POST['id_affectation'];

    // echo $id_affectation.'</br>';
    // echo $code_service.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    // UPDATE
    mysqli_query($con, "UPDATE `localisation_services` SET code_batiment='$code_batiment', code_service='$code_service' WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation modifié avec succès !"; 
     header ("Location: ../services_batiments.php");

}

// Suppression
if (isset($_POST['supprimerServiceBatiments'])) {

    $id_affectation=$_POST['id_affectation'];

    // echo $id_affectation.'</br>';
    // die;

    // DELETE
    mysqli_query($con, "DELETE FROM `localisation_services` WHERE id='$id_affectation'");

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Affectation supprimé avec succès !"; 
     header ("Location: ../services_batiments.php");

}

/*********************************** Services batiments & Etage *************************************/
// Creation
if (isset($_POST['validerServicesBatimentsEtages'])) {

    $code_service=$_POST['code_service'];
    $code_batiment=$_POST['code_batiment'];

    echo $code_service.'</br>';
    echo $code_batiment.'</br>';
    // die;
  
    $codes_etage=[];

    for ($i=0;$i<count($_POST['codes_etage']);$i++) {
        $codes_etage[]=$_POST['codes_etage'][$i];
    }

    // echo $matricule_service.'</br>';

    // echo $intervenant.'</br>';
    for ($i=0;$i<count($codes_etage);$i++) {
        // echo $codes_etage[$i].'</br>';
        $code_etage=$codes_etage[$i];

        $verifDoublon=mysqli_query($con, "SELECT * FROM localisation_services_etage WHERE code_service='$code_service' AND code_batiment='$code_batiment' AND code_etage='$code_etage'");

        if (mysqli_num_rows($verifDoublon) == 0) 
        {
            mysqli_query($con, "INSERT INTO `localisation_services_etage` (`code_service`, `code_batiment`, `code_etage`) 
            VALUES ('$code_service', '$code_batiment', '$code_etage')");
        }
    }
    // die;

     $_SESSION['errorMsg']=false;
     $_SESSION['successMsg']=true;
     $_SESSION['message'] = "Service affecté avec succès au batiments et étages selectionés!"; 
     header ("Location: ../services_etages.php");

}
?>