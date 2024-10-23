<?php
session_start();
include('config/app.php');
require 'vendor/autoload.php';
// include autoloader
// require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;


if (isset($_SESSION['User']) && isset($_SESSION['UserPass']) && $_SESSION['role'] == 'Administrateur' || $_SESSION['role'] == 'Responsable' || $_SESSION['role'] == 'Intervenant' || $_SESSION['role'] == 'Gestionnaire') {
  $showEdit = 0;
  $showAffect = 0;
  $emailUser = $_SESSION['email'];
  $roleUser = $_SESSION['role'];
  if (isset($_GET['code_intervention'])) {
    $code_intervention = $_GET['code_intervention'];
    $script_filename = $_SERVER['SCRIPT_FILENAME'];

    // Remplacer 'sri_admin/fiche_pdf.php' par 'sri_client'
    $modified_path = str_replace('sri_admin/fiche_pdf.php', 'sri_client', $script_filename);



    // echo $code_intervention;die;
    $getInterventions = mysqli_query($con, "SELECT 
        interventions.code_intervention,
        interventions.code_incident,
        interventions.intervenant,
        interventions.numero_incident,
        interventions.date_intervention,
        interventions.date_saisie,
        interventions.statut,
        services.code_service,
        services.libelle,
        services.sigle,
        type_incidents.type_incident,
        interventions.type_intervenant
        FROM `interventions`
        INNER JOIN services ON services.code_service=interventions.service
        INNER JOIN type_incidents ON type_incidents.code_incident=interventions.code_incident WHERE interventions.code_intervention='$code_intervention'");

    while ($row = mysqli_fetch_array($getInterventions)) {
      $intervenant = $row['intervenant'];
      $code_incident = $row['code_incident'];
      $numero_incident = $row['numero_incident'];
      $service = $row['libelle'];
      $code_service = $row['code_service'];
      $statut = $row['statut'];
      $categorie = $row['type_incident'];
      $date_intervention = date('d / m / Y', strtotime($row['date_intervention']));
      $date_affectation = date('d / m / Y', strtotime($row['date_saisie']));
      $heure_affectation = date('H:i', strtotime($row['date_saisie']));
      $code_intervention = $row['code_intervention'];
      $type_intervenant = $row['type_intervenant'];
      $date_annulation = date('d / m / Y', strtotime($row['date_saisie']));
    }
    // GET gestionnaire...
    $getGestionnaire = mysqli_query($con, "SELECT * FROM `gestionnaires_services` INNER JOIN gestionnaires ON gestionnaires.matricule_gestionnaire=gestionnaires_services.matricule_gestionnaire WHERE gestionnaires_services.code_service='$code_service'");

    while ($row = mysqli_fetch_array($getGestionnaire)) {
      $gestionnaire_service = $row['prenom'] . ' ' . $row['nom'];
      $telephone_gestionnaire = $row['telephone'];
    }
    // get couleur
    $getCouleur = mysqli_query($con, "SELECT * FROM signalements INNER JOIN type_incidents on type_incidents.code_incident=signalements.code_incident where signalements.numero_incident='$numero_incident'");
    while ($row = mysqli_fetch_array($getCouleur)) {
      $couleur = $row['couleur'];
    }
    // echo $sigle;die;
    if ($type_intervenant == 'prestataire') {
      $recupPresta = mysqli_query($con, "SELECT * FROM prestataires WHERE matricule_presta='$intervenant'");
      while ($row = mysqli_fetch_array($recupPresta)) {
        $intervenant_incident = $row['denomination'];
      }
    }

    if ($type_intervenant == 'interne') {
      $recupInterne = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE matricule_intervenant='$intervenant'");
      while ($row = mysqli_fetch_array($recupInterne)) {
        $intervenant_incident = $row['prenom'] . ' ' . $row['nom'];
      }
    }

    if ($type_intervenant == 'service') {
      $recupService = mysqli_query($con, "SELECT * FROM services_intervenant WHERE matricule_service='$intervenant'");
      while ($row = mysqli_fetch_array($recupService)) {
        $intervenant_incident = $row['nom_service'];
      }
    }


    // Contacts responsable Dage
    $getContactResponsable = mysqli_query($con, "SELECT * FROM `responsables_incidents` INNER JOIN responsables_dage ON responsables_incidents.matricule_responsable=responsables_incidents.matricule_responsable WHERE responsables_incidents.code_incident='$code_incident'");

    while ($row = mysqli_fetch_array($getContactResponsable)) {
      $matriculeResponsable = $row['matricule_responsable'];
      $responsableDage = $row['prenom'] . ' ' . $row['nom'];
      // $nomResponsable=$row['nom']; 
      $emailResponsable = $row['email'];
      $telephoneResponsable = $row['telephone'];
    }

    // Infos Incident
    $getIncidents = mysqli_query($con, "SELECT * FROM `signalements` INNER JOIN services on services.code_service=signalements.code_service where signalements.numero_incident='$numero_incident'");

    while ($row = mysqli_fetch_array($getIncidents)) {
      $description = $row['description'];
      $auteur = $row['auteur'];
      $telephone = $row['telephone'];
      $date_reception = date('d / m / Y', strtotime($row['date_reception']));
      $heure_reception = date('H:i', strtotime($row['date_reception']));
      $image = $row['photo'];
      $contact = $row['telephone'];
      $code_batiment = $row['code_batiment'];
      $code_etage = $row['code_etage'];
      $code_piece = $row['piece'];
      $statut_incident = $row['piece'];
      $libelle_service = $row['libelle'];
      $sigle_service = $row['sigle'];
      // date("Y-m-d H:i:s");
    }

    // Get localisation 
    $getLoc = mysqli_query($con, "SELECT 
        signalements.numero_incident,
        batiments.nom_batiment,
        batiments.adresse,
        batiments.contact,
        etages.nom_etage,
        types_localisation_c.type
        FROM `signalements` 
        INNER JOIN batiments ON batiments.code_batiment=signalements.code_batiment 
        INNER JOIN etages ON signalements.code_etage=etages.code_etage
        INNER JOIN types_localisation_c ON types_localisation_c.code_localisation=signalements.piece
        WHERE signalements.numero_incident='$numero_incident' AND signalements.code_batiment='$code_batiment' AND signalements.code_etage='$code_etage' AND signalements.piece='$code_piece';");

    while ($row = mysqli_fetch_array($getLoc)) {
      $batiment = $row['nom_batiment'];
      $etage = $row['nom_etage'];
      $piece = $row['type'];
      $adresse = $row['adresse'];
      $contact_immeuble = $row['contact'];
    }

    $getInfosAnn = mysqli_query($con, "SELECT * FROM `commentaires_annulation_intervention` INNER JOIN interventions ON interventions.code_intervention=commentaires_annulation_intervention.code_intervention INNER JOIN responsables_dage ON responsables_dage.email=commentaires_annulation_intervention.matricule_auteur WHERE interventions.code_intervention='$code_intervention'");

    while ($row = mysqli_fetch_array($getInfosAnn)) {
      $raisons_annulation = $row['commentaire'];
      $date_annulation = date('d / m / Y', strtotime($row['date_annulation']));
      $auteur_annulation = $row['prenom'] . ' ' . $row['nom'];
    }

    // Get infos annulation...
  }

  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  $options = $dompdf->getOptions();
  $options->set('isRemoteEnabled', true);
  $dompdf->setOptions($options);

  ob_start();
  require_once('fiche_intervention_pdf.php');
  $html = ob_get_contents();
  ob_get_clean();
  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF to Browser
  $dompdf->stream('fiche_intervention.pdf', ['Attachment' => 0]);
} else {
  header('Location: fiche_intervention?code_intervention=' . $_GET['code_intervention']);
}
