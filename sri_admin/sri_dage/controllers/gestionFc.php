<?php
 include ('../config/app.php');
session_start();

date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$anneeEnCours = date('Y', strtotime($dateDuJour));

if (isset($_GET['codeFc']) && isset($_GET['annuleInitDir'])) {
  $codeFc=$_GET['codeFc'];
  $codeDirection=$_GET['annuleInitDir'];

  // echo $codeFc.'</br>';
  // echo $direction;
  $getDirNom = $con->query("SELECT * FROM directions WHERE codeDirection='$codeDirection'");
  while ($row = mysqli_fetch_array($getDirNom)) {
    $nomDirection=$row['libelle'];
  }

  $infosInit = $con->query("SELECT * FROM fc_initialisation_directions WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");

    while ($row = mysqli_fetch_array($infosInit)) { 
        $codeFc=$row['codeFc'];
        $matricule=$row['matricule'];
        $codeDirection=$row['codeDirection'];
        $codeMinistere=$row['codeMinistere'];
        $statut=$row['statut'];
        $commentaire=$row['commentaire'];
        $date_saisie=$row['date_saisie'];
        $codeFc=$row['codeFc'];

        $sql = $con->query("INSERT INTO fc_en_cours_initialisation (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
        VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$date_saisie')");
        }

        $sql = $con->query("DELETE FROM fc_initialisation_directions WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");

        // echo $nomDirection;die;
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Initialisation ".$nomDirection." annulée avec succès ! ";
        header("Location: ../initialiser_fond_commun?fc=$codeFc");

}

if (isset ($_POST['ajouterFc']))  {

    $codeMinistere=$_POST['codeMinistere'];
    $trimestre=$_POST['trimestre'];
    $nomFc=$_POST['nomFc'];
    $description=$_POST['description'];

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");
    $anneeEnCours = date('Y', strtotime($dateDuJour));

    $defaultStatus='Cree';
    

    switch($codeMinistere) {
        case 'FI43' : $debutCodeFc="FC-MFB-$anneeEnCours-";break;
        case 'MEPC' : $debutCodeFc="FC-MEPC-$anneeEnCours-";break;
        case 'MC' : $debutCodeFc="FC-MC-$anneeEnCours-";break;
        default : $debutCodeFc="FC-NMI-$anneeEnCours-";break;
    }

    switch($codeMinistere) {
        case 'FI43' :
            $reqNumFc = mysqli_query($con, "SELECT SUBSTR(codeFc, 13,2) as numFc FROM fonds_commun WHERE codeMinistere='FI43'");
            while ($row = mysqli_fetch_array($reqNumFc)) {
                $numFc=$row['numFc'];
            }
            break;
        case 'MEPC' :
            $reqNumFc = mysqli_query($con, "SELECT SUBSTR(codeFc, 14,2) as numFc FROM fonds_commun WHERE codeMinistere='MEPC'");
            while ($row = mysqli_fetch_array($reqNumFc)) {
                $numFc=$row['numFc'];
            }
            break;
        case 'MC' :
                $reqNumFc = mysqli_query($con, "SELECT SUBSTR(codeFc, 12,2) as numFc FROM fonds_commun WHERE codeMinistere='MC'");
                while ($row = mysqli_fetch_array($reqNumFc)) {
                    $numFc=$row['numFc'];
                }
                break;
        default : $numFc=01;
        break;
    }

    $nextNumFc=$numFc+1;

    $codeFc=$debutCodeFc.$nextNumFc;
    $action='Creation';
    $commentaire='';

    // echo $codeMinistere.'</br>';
    // echo $trimestre.'</br>';
    // echo $nomFc.'</br>';
    // echo $description.'</br>';
    // echo $codeFc.'</br>';
    // echo $anneeEnCours.'</br>';
    // echo $defaultStatus.'</br>';

    $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
    VALUES ('$codeFc','$action','$dateDuJour','$commentaire')");


    $sql = $con->query("INSERT INTO fonds_commun (codeFc, nom, description, codeMinistere, annee, trimestre, montant_global, date_c, statut) 
    VALUES ('$codeFc', '$nomFc','$description','$codeMinistere','$anneeEnCours','$trimestre','0','$date_saisie ','$defaultStatus')");
        
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Fond commun ajouté avec succès ! ";
    header("Location: ../creer_fond_commun");
}

if (isset($_POST['modifierFc'])) {

    $codeMinistere = $_POST['codeMinistere'];
    $nomFc = $_POST['nomFc'];
    $trimestre = $_POST['trimestre'];
    $description = $_POST['description'];
    $codeFc = $_POST['codeFc'];

    // echo $codeMinistere.'</br>';
    // echo $trimestre.'</br>';
    // echo $nomFc.'</br>';
    // echo $description.'</br>';
    // echo $codeFc.'</br>';
  
    $sql = $con->query("UPDATE fonds_commun SET nom='$nomFc', trimestre='$trimestre', description='$description' WHERE codeFc='$codeFc'");

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Fond commun modifié avec succès ! ";
    header("Location: ../creer_fond_commun");
    
}

if (isset($_POST['supprimerFc'])) {
    $codeFc = $_POST['codeFc'];

    $sql = $con->query("DELETE FROM fonds_commun WHERE codeFc='$codeFc'");

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Fond commun supprimé avec succès ! ";
    header("Location: ../creer_fond_commun");

}


if (isset($_POST['ouvrirFc'])) {
    $d_ouverture = $_POST['d_ouverture'];
    // $d_notation = $_POST['d_notation'];
    // $d_l_initialisation = $_POST['d_l_initialisation'];
    // $d_l_notation = $_POST['d_l_notation'];
    $phase='Initialisation';
    $action='Ouverture';
    $commentaire=$_POST['commentaire'];;
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];

    // echo $codeFc;
    

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");


    // $sql= mysqli_query($con, "INSERT INTO deadlines_fc (codeFc,phase,debut,fin) 
    // VALUES ('$codeFc','$phase','$d_ouverture','$d_l_initialisation')");


    $recupAgents = mysqli_query($con, "SELECT matricule, codeDirection FROM agents WHERE codeMinistere='$codeMinistere'");

    // $listeAgents=[];
    // $codeDirections=[];
    while ($row = mysqli_fetch_array($recupAgents)) { 
        $matricule=$row['matricule'];
        $codeDirection=$row['codeDirection'];
        $statut='Actif';
        $commentaire='';

        //   echo $listeAgents[$i].'</br>';
        $sql= mysqli_query($con, "INSERT INTO fc_en_cours_initialisation (codeFc,matricule,codeDirection,codeMinistere,statut, commentaire, date_saisie) 
        VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

        $sql= mysqli_query($con, "INSERT INTO fc_en_cours_initialisation_ref (codeFc,matricule,codeDirection,codeMinistere,statut, commentaire, date_saisie) 
        VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

      }

      $sql = $con->query("UPDATE fonds_commun SET statut='Ouvert' WHERE codeFc='$codeFc'");

      $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
      VALUES ('$codeFc','$action','$dateDuJour','$commentaire')");
  
      $template_file = "../templates_email/ouverture.php";
        
      $to="leborofaye@gmail.com";
      $from="support@sedif.sn";
      $subject='Ouverture du Fond commun du premier trimestre';
      
      $swap_var = array (
          "{EMAIL_TITLE}" => "Ouverture du Fond commun T1",
          "{SITE_ADDR}" => "https://sedif.sn/mfb/dtai/pgav/dev/",
          "{CUSTOM_URL}" => "https://sedif.sn/mfb/dtai/pgav/dev/",
          "{EMAIL_LOGO}" => "https://sedif.sn/mfb/dtai/pgav/assets/images/logo/logo.png",
          "{TO_NAME}" => "Ibrahima",
          "{TO_EMAIL}" => "leborofaye@gmail.com",
          );

      
      //headers
      $headers = "From:  DTAI <support@sedif.sn>\r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
     

      
      if (file_exists($template_file)) {
          $message = file_get_contents ($template_file);
      }
      else
      {
          die("Fichier introuvable !!");
      }
      
      foreach(array_keys($swap_var) as $key) {
          if (strlen($key) > 2 && trim($key) != "")
              $message = str_replace($key, $swap_var[$key], $message);
          
      }
      
      //Envoi du mail
      mail($to, $subject, $message, $headers);

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Fond commun ouvert avec succès ! ";
      header("Location: ../creer_fond_commun");
      


}

if (isset($_POST['ouvrirNotation'])) {

    $debutNotation = $_POST['debutNotation'];
    $finNotation= $_POST['finNotation'];

    $phase='Notation';
    $action='Ouverture Notation';
    $commentaire='Notation';
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];
    

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");

  
    $verifDoublon = mysqli_query($con, "SELECT * FROM deadlines_fc where codeFc='$codeFc' and phase='$phase'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Ce matricule existe deja !";
        $result['message'] = "Probleme ! Ce matricule existe deja !";

        $_SESSION['errorMsg']=true;
        $_SESSION['successMsg']=false;
        $_SESSION['message'] ="Fond commun deja ouvert à la notation ! ";
        header("Location: ../ouverture_fond_commun");
    }
    else
    {

    $sql= mysqli_query($con, "INSERT INTO deadlines_fc (codeFc,phase,debut,fin) 
    VALUES ('$codeFc','$phase','$debutNotation','$finNotation')");


    $recupAgents = mysqli_query($con, "SELECT 
    fc_initialises_clotures.matricule,
    fc_initialises_clotures.codeFc,
    fc_initialises_clotures.codeDirection,
    fc_initialises_clotures.codeMinistere,
    agents.hierarchie
    FROM fc_initialises_clotures INNER JOIN agents ON agents.matricule=fc_initialises_clotures.matricule WHERE fc_initialises_clotures.codeMinistere='$codeMinistere'");

   
    while ($row = mysqli_fetch_array($recupAgents)) { 
        $matricule = $row['matricule'];
        $codeDirection=$row['codeDirection'];
        $hierarchie=$row['hierarchie'];
        $nb_part=0;
        switch ($hierarchie)  {
            case 'A' : $nb_part=5; break;
            case 'B' : $nb_part=4; break;
            case 'C' : $nb_part=3; break;
            case 'D' : $nb_part=3; break;

        }


        $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
    VALUES ('$codeFc','$action','$dateDuJour','$commentaire')");

        $sql= mysqli_query($con, "INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere,matricule, hierarchie,nb_part,date_saisie)
        VALUES ('$codeFc', '$codeDirection', '$codeMinistere', '$matricule', '$hierarchie', '$nb_part', '$dateDuJour')");
    }

      $sql = $con->query("UPDATE fonds_commun SET statut='Initialise' WHERE codeFc='$codeFc'");

      $template_file = "../templates_email/ouverture_notation";
        
      $to="leborofaye@gmail.com";
      $from="support@sedif.sn";
      $subject='Ouverture du Fond commun du premier trimestre';
      
      $swap_var = array (
          "{EMAIL_TITLE}" => "Ouverture du Fond commun T1",
          "{SITE_ADDR}" => "https://sedif.sn/mfb/dtai/pgav/dev/",
          "{CUSTOM_URL}" => "https://sedif.sn/mfb/dtai/pgav/dev/",
          "{EMAIL_LOGO}" => "https://sedif.sn/mfb/dtai/pgav/assets/images/logo/logo.png",
          "{TO_NAME}" => "Ibrahima",
          "{TO_EMAIL}" => "leborofaye@gmail.com",
          );

      
      //headers
      $headers = "From:  DTAI <support@sedif.sn>\r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
     

      
      if (file_exists($template_file)) {
          $message = file_get_contents ($template_file);
      }
      else
      {
          die("Fichier introuvable !!");
      }
      
      foreach(array_keys($swap_var) as $key) {
          if (strlen($key) > 2 && trim($key) != "")
              $message = str_replace($key, $swap_var[$key], $message);
          
      }
      
      //Envoi du mail
      mail($to, $subject, $message, $headers);

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Fond commun ouvert pour notation succès ! ";
      header("Location: ../creer_fond_commun");
      }


}

if (isset($_POST['cloturerInitialisation'])) {

    $d_ouverture = $_POST['d_ouverture'];
    $commentaire = $_POST['commentaire'];

    $action='Cloture Initialisation';
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];
    

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");

    // echo $d_ouverture.'</br>';
    // echo $commentaire.'</br>';
    // echo $codeFc.'</br>';
    // echo $codeMinistere.'</br>';
    // echo $action.'</br>';



    $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
    VALUES ('$codeFc','$action','$dateDuJour','$commentaire')");

    $infosInitialises = $con->query("SELECT * FROM fc_initialises WHERE codeFc='$codeFc' and statut='Actif'");

    while ($row = mysqli_fetch_array($infosInitialises)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
    
      
      $sql = $con->query("INSERT INTO fc_initialises_clotures (codeFc, matricule,codeDirection,codeMinistere,date_saisie) 
      VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$dateDuJour')");
       
       $sql = $con->query("INSERT INTO fc_initialises_clotures_ref (codeFc, matricule,codeDirection,codeMinistere,date_saisie) 
       VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$dateDuJour')");

        // $sql = $con->query("DELETE FROM fc_initialises where codeFc='$codeFc' and codeDirection='$codeDirection'");
       
       $sql = $con->query("UPDATE fonds_commun SET statut='Initialise' WHERE codeFc='$codeFc'");

  }

  $_SESSION['errorMsg']=false;
  $_SESSION['successMsg']=true;
  $_SESSION['message'] ="L'initialisation du fond commun est cloturé avec succès ! ";
  header("Location: ../creer_fond_commun");


}

if (isset($_POST['cloturerNotation'])) {

    $d_cloture = $_POST['d_cloture'];
    $commentaire = $_POST['commentaire'];

    $action='Cloture Notation';
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];
    

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");

    $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
    VALUES ('$codeFc','$action','$d_cloture','$commentaire')");

    $reqNotesV = $con->query("SELECT * FROM fc_notes_validees WHERE codeFc='$codeFc'");

    while ($row = mysqli_fetch_array($reqNotesV)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $hierarchie=$row['hierarchie'];
      $nb_part=$row['nb_part'];
      $decade=$row['decade'];
      $note=$row['note'];
      $points=$row['points'];

      $montant=0;


    //   INSERT INTO `fc_notes_finaux` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `montant`, `date_saisie`) 
    //   VALUES (NULL, '4', 'r', 't', '6', 't', '6', '6', '6', '6', '6', '2022-02-07');
      
      $sql = $con->query("INSERT INTO fc_notes_finaux (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
       
      $sql = $con->query("INSERT INTO fc_notes_finaux_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

      $sql = $con->query("INSERT INTO  calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$montant','$dateDuJour')");

      $sql = $con->query("UPDATE fonds_commun SET statut='Noté' WHERE codeFc='$codeFc'");

    //   $sql = $con->query("DELETE FROM fc_notes_validees where codeFc='$codeFc'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Les notations du fond commun sont cloturées avec succès ! ";
        header("Location: ../creer_fond_commun");
       
  }

  


}

// DRH
if (isset($_POST['enleverAgent'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
    $direction=$_POST['direction'];
  
    // Infos agents
    $getPrenomNom = $con->query("SELECT * FROM agents WHERE matricule='$matricule'");
    while ($row = mysqli_fetch_array($getPrenomNom)) { 
      $agent=$row['prenom'].' '.$row['nom'];
    }
    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_en_cours_initialisation SET statut='Inactif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    // Save justificatif
    $rep = $matricule;

    $repertoire="../Documents/Justificatifs/".$rep."/";
    if (is_dir($repertoire)) 
    {
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];  
    }
    else
    {
        mkdir("../Documents/Justificatifs/".$rep);
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];
    }

    $link_doc="Documents/Justificatifs/".$rep."/".$justificatif;

        // echo $codeFc.'</br>';
        // echo $matricule.'</br>';
        // echo $commentaire.'</br>';
        // echo $dateDuJour.'</br>';
        // echo $link_doc;die;
    $sql = $con->query("INSERT INTO justificatifs (codeFc, matricule, libelle, link_doc, date_saisie) 
    VALUES ('$codeFc', '$matricule', '$commentaire', '$link_doc', '$dateDuJour')");

    

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] =$agent." enlevé(e) de la liste des beneficiaires du fond commun  avec succès ! ";
    header("Location: ../initialiser_fond_commun?fc=$codeFc&dir=$direction");
  
  }

  // Directeurs
  if (isset($_POST['enleverAgentDir'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
    $direction=$_POST['direction'];

      // Infos agents
      $getPrenomNom = $con->query("SELECT * FROM agents WHERE matricule='$matricule'");
      while ($row = mysqli_fetch_array($getPrenomNom)) { 
        $agent=$row['prenom'].' '.$row['nom'];
      }
  
    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_initialisation_directions_encours SET statut='Inactif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] =$agent." enlevé(e) de la liste des beneficiaires du fond commun  avec succès ! ";
    header("Location: ../maj_fond_commun?fc=$codeFc&dir=$direction");
  
  }

  //DRH
  if (isset($_POST['ajouterAgent'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
    $direction=$_POST['direction'];

    // Get prenom & nom
     $getPrenomNom = $con->query("SELECT * FROM agents WHERE matricule='$matricule'");
     while ($row = mysqli_fetch_array($getPrenomNom)) { 
       $agent=$row['prenom'].' '.$row['nom'];
     }
  
    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_en_cours_initialisation SET statut='Actif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    // Save justificatif
    $rep = $matricule;

    $repertoire="../Documents/Justificatifs/".$rep."/";
    if (is_dir($repertoire)) 
    {
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];  
    }
    else
    {
        mkdir("../Documents/Justificatifs/".$rep);
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];
    }

    $link_doc="Documents/Justificatifs/".$rep."/".$justificatif;

        // echo $codeFc.'</br>';
        // echo $matricule.'</br>';
        // echo $commentaire.'</br>';
        // echo $dateDuJour.'</br>';
        // echo $link_doc;die;
    $sql = $con->query("INSERT INTO justificatifs (codeFc, matricule, libelle, link_doc, date_saisie) 
    VALUES ('$codeFc', '$matricule', '$commentaire', '$link_doc', '$dateDuJour')");


    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] =$agent." rajouté(e) dans liste des beneficiaires du fond commun  avec succès ! ";
    header("Location: ../initialiser_fond_commun?fc=$codeFc&dir=$direction");
  
  }

  // Directeurs
  if (isset($_POST['ajouterAgentDir'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
    $direction=$_POST['direction'];
  
    // Get prenom & nom
    $getPrenomNom = $con->query("SELECT * FROM agents WHERE matricule='$matricule'");
    while ($row = mysqli_fetch_array($getPrenomNom)) { 
      $agent=$row['prenom'].' '.$row['nom'];
    }

    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_initialisation_directions_encours SET statut='Actif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    // Save justificatif
    $rep = $matricule;

    $repertoire="../Documents/Justificatifs/".$rep."/";
    if (is_dir($repertoire)) 
    {
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];  
    }
    else
    {
        mkdir("../Documents/Justificatifs/".$rep);
        $m = "../Documents/Justificatifs/".$rep."/".$_FILES['justificatif']['name'];
        move_uploaded_file ($_FILES['justificatif']['tmp_name'], $m);
        $justificatif = $_FILES['justificatif']['name'];
    }

    $link_doc="Documents/Justificatifs/".$rep."/".$justificatif;

        // echo $codeFc.'</br>';
        // echo $matricule.'</br>';
        // echo $commentaire.'</br>';
        // echo $dateDuJour.'</br>';
        // echo $link_doc;die;
    $sql = $con->query("INSERT INTO justificatifs (codeFc, matricule, libelle, link_doc, date_saisie) 
    VALUES ('$codeFc', '$matricule', '$commentaire', '$link_doc', '$dateDuJour')");


    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] =$agent." rajouté(e) dans liste des beneficiaires du fond commun  avec succès ! ";
    header("Location: ../maj_fond_commun?fc=$codeFc&dir=$direction");
  
  }

  //DRH
  if (isset($_POST['annulerInit'])) {
      $codeFc=$_POST['codeFc'];
      $codeDirection=$_POST['codeDirection'];

    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';

    $sql = $con->query("DELETE FROM fc_en_cours_initialisation where codeFc='$codeFc' and codeDirection='$codeDirection'");

    $infosInit = $con->query("SELECT * FROM fc_en_cours_initialisation_ref WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");

    while ($row = mysqli_fetch_array($infosInit)) { 
        $codeFc=$row['codeFc'];
        $matricule=$row['matricule'];
        $codeDirection=$row['codeDirection'];
        $codeMinistere=$row['codeMinistere'];
        $statut=$row['statut'];
        $commentaire=$row['commentaire'];
        $date_saisie=$row['date_saisie'];
        $codeFc=$row['codeFc'];

        $sql = $con->query("INSERT INTO fc_en_cours_initialisation (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
        VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$date_saisie')");
        }
        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Saisie annulée avec succès ! ";
        header("Location: ../initialiser_fond_commun?fc=$codeFc");

}

if (isset($_POST['annulerInitDir'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];

  // echo $codeFc.'</br>';
  // echo $codeDirection.'</br>';

  $sql = $con->query("DELETE FROM fc_initialisation_directions_encours where codeFc='$codeFc' and codeDirection='$codeDirection'");

  $infosInit = $con->query("SELECT * FROM fc_initialisation_directions_encours_ref WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");

  while ($row = mysqli_fetch_array($infosInit)) { 
      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $statut=$row['statut'];
      $nb_part=$row['nb_part'];
      $commentaire=$row['commentaire'];
      $date_saisie=$row['date_saisie'];
      $codeFc=$row['codeFc'];

      $sql = $con->query("INSERT INTO fc_initialisation_directions_encours (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$date_saisie')");
      }

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Saisie annulée avec succès ! ";
      header("Location: ../maj_fond_commun?fc=$codeFc&dir=$codeDirection");

}



  if (isset($_POST['validerInit'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $auteur=$_POST['auteur'];
    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $auteur.'</br>';
// 
  $infosEncours = $con->query("SELECT * FROM fc_en_cours_initialisation inner join agents on agents.matricule=fc_en_cours_initialisation.matricule WHERE fc_en_cours_initialisation.codeFc='$codeFc' and fc_en_cours_initialisation.codeDirection='$codeDirection'");

  while ($row = mysqli_fetch_array($infosEncours)) { 
      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $statut=$row['statut'];
      $commentaire=$row['commentaire'];
      $h=$row['hierarchie'];
      switch($h) {
          case 'A' : $nb_part=5;break;
          case 'B' : $nb_part=4;break;
          case 'C' : $nb_part=3;break;
          case 'D' : $nb_part=3;break;
      }

      $sql = $con->query("INSERT INTO fc_initialisation_directions (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");


      $sql = $con->query("INSERT INTO fc_initialisation_directions_ref (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

        $sql = $con->query("DELETE FROM fc_en_cours_initialisation where codeFc='$codeFc' and codeDirection='$codeDirection'");

      
    //   $sql = $con->query("INSERT INTO fc_initialises (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
    //   VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
    //    $sql = $con->query("INSERT INTO fc_initialises_ref (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
    //    VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
  }

  // Stats nb agent

      $reqNbAgentsInitialises = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInit FROM fc_initialisation_directions WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");
      $nbAgentsInitialises=0;
      while ($row = mysqli_fetch_array($reqNbAgentsInitialises)) {
        $nbAgentsInitialises=$row['nbAgentsInit'];
       }
    
      $reqNbAgentsInitialisesActif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsActifInit FROM fc_initialisation_directions WHERE statut='Actif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesActif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesActif)) {
            $nbAgentsInitialisesActif=$row['nbAgentsActifInit'];
        }
    
      $reqNbAgentsInitialisesInactif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInactifInit FROM fc_initialisation_directions WHERE statut='Inactif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesInactif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesInactif)) {
            $nbAgentsInitialisesInactif=$row['nbAgentsInactifInit'];
        }

        $sql = $con->query("INSERT INTO directions_initialises (codeFc,codeDirection,codeMinistere,nbAgent,nbAgentActif,nbAgentInactif,auteur,date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgentsInitialises','$nbAgentsInitialisesActif','$nbAgentsInitialisesInactif','$auteur','$dateDuJour')");
        
        $sql = $con->query("INSERT INTO acteurs_notations (codeFc,codeDirection,codeMinistere,auteur,date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$auteur','$dateDuJour')");
        
        $reqNomDirection = mysqli_query($con, "SELECT * FROM direction WHERE codeDirection='$codeDirection'");

        while ($row = mysqli_fetch_array($reqNomDirection)) {
            $nomDirection=$row['libelle'];
        }
      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Initialisation des etats de la direction validée avec succès !";
      header("Location: ../initialiser_fond_commun?fc=$codeFc");


}

// Directeurs


if (isset($_POST['validerInitDir'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $auteur=$_POST['auteur'];
    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $auteur.'</br>';
// 
  $infosEncours = $con->query("SELECT * FROM fc_initialisation_directions_encours inner join agents on agents.matricule=fc_initialisation_directions_encours.matricule WHERE fc_initialisation_directions_encours.codeFc='$codeFc' and fc_initialisation_directions_encours.codeDirection='$codeDirection'");

  while ($row = mysqli_fetch_array($infosEncours)) { 
      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $statut=$row['statut'];
      $hierarchie=$row['hierarchie'];
      $commentaire=$row['commentaire'];
      $nb_part=$row['nb_part'];
    //   $h=$row['hierarchie'];
    //   switch($h) {
    //       case 'A' : $nb_part=5;break;
    //       case 'B' : $nb_part=4;break;
    //       case 'C' : $nb_part=3;break;
    //       case 'D' : $nb_part=3;break;
    //   }

      $sql = $con->query("INSERT INTO fc_initialisation_directions_maj (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

      $sql = $con->query("INSERT INTO fc_initialisation_directions_maj_Ref (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");

      $sql = $con->query("INSERT INTO fc_initialisation_directions_archive_dir (codeFc, matricule,nb_part,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$nb_part','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
  }
    $infosEncoursActif = $con->query("SELECT * FROM fc_initialisation_directions_encours inner join agents on agents.matricule=fc_initialisation_directions_encours.matricule WHERE fc_initialisation_directions_encours.codeFc='$codeFc' and fc_initialisation_directions_encours.codeDirection='$codeDirection' and fc_initialisation_directions_encours.statut='Actif'");

    while ($row = mysqli_fetch_array($infosEncoursActif)) { 
        $codeFc=$row['codeFc'];
        $matricule=$row['matricule'];
        $codeDirection=$row['codeDirection'];
        $codeMinistere=$row['codeMinistere'];
        $statut=$row['statut'];
        $hierarchie=$row['hierarchie'];
        $commentaire=$row['commentaire'];
        $nb_part=$row['nb_part'];


// Initialisation Table des notes
// INSERT INTO `fc_en_cours_notation` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `date_saisie`)
      
      $sql = $con->query("INSERT INTO fc_en_cours_notation (codeFc, codeMinistere, codeDirection, matricule, hierarchie, nb_part,decade,note,points, date_saisie) 
      VALUES ('$codeFc','$codeMinistere','$codeDirection','$matricule','$hierarchie','$nb_part','9','0','0','$dateDuJour')");

        $sql = $con->query("INSERT INTO fc_en_cours_notation_ref (codeFc, codeMinistere, codeDirection, matricule, hierarchie, nb_part,decade,note,points, date_saisie) 
        VALUES ('$codeFc','$codeMinistere','$codeDirection','$matricule','$hierarchie','$nb_part','9','0','0','$dateDuJour')");


    }
        $sql = $con->query("DELETE FROM fc_initialisation_directions_encours where codeFc='$codeFc' and codeDirection='$codeDirection'");

      
    //   $sql = $con->query("INSERT INTO fc_initialises (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
    //   VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
    //    $sql = $con->query("INSERT INTO fc_initialises_ref (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
    //    VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
  

  // Stats nb agent

      $reqNbAgentsInitialises = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInit FROM fc_initialisation_directions WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");
      $nbAgentsInitialises=0;
      while ($row = mysqli_fetch_array($reqNbAgentsInitialises)) {
        $nbAgentsInitialises=$row['nbAgentsInit'];
       }
    
      $reqNbAgentsInitialisesActif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsActifInit FROM fc_initialisation_directions WHERE statut='Actif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesActif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesActif)) {
            $nbAgentsInitialisesActif=$row['nbAgentsActifInit'];
        }
    
      $reqNbAgentsInitialisesInactif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInactifInit FROM fc_initialisation_directions WHERE statut='Inactif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesInactif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesInactif)) {
            $nbAgentsInitialisesInactif=$row['nbAgentsInactifInit'];
        }

        $sql = $con->query("INSERT INTO directions_initialises (codeFc,codeDirection,codeMinistere,nbAgent,nbAgentActif,nbAgentInactif,auteur,date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgentsInitialises','$nbAgentsInitialisesActif','$nbAgentsInitialisesInactif','$auteur','$dateDuJour')");
        
        $sql = $con->query("INSERT INTO acteurs_notations (codeFc,codeDirection,codeMinistere,auteur,date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$auteur','$dateDuJour')");
        
        $reqNomDirection = mysqli_query($con, "SELECT * FROM direction WHERE codeDirection='$codeDirection'");

        while ($row = mysqli_fetch_array($reqNomDirection)) {
            $nomDirection=$row['libelle'];
        }


        // Mise a jour du step
        $step="Mise a jour";
        $verifDoublonStep = mysqli_query($con, "SELECT * FROM step_direction where codeFc='$codeFc' AND codeDirection='$codeDirection' AND step='$step'");


        if (mysqli_num_rows($verifDoublonStep ) > 0) 
        {
            $sql = $con->query("UPDATE step_direction SET date_step='$date_saisie' where codeFc='$codeFc' AND codeDirection='$codeDirection' AND step='$step'");
        }
        else
        {
            $sql = $con->query("INSERT INTO `step_direction` (`codeFc`, `codeDirection`, `step`, `date_step`) 
            VALUES ('$codeFc', '$codeDirection', '$step', '$date_saisie')"); 
        }

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Etats Initiaux mises a jour et validée avec succès !";
      header("Location: ../maj_fond_commun?fc=$codeFc");


}
if (isset($_POST['RetourEtatsNotes'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $commentaire=$_POST['commentaire'];

    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $commentaire.'</br>';

    $sql = $con->query("INSERT INTO fc_rejet_notes (codeFc,codeDirection,commentaire,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$commentaire','$dateDuJour')");


    $reqNotesRetour = $con->query("SELECT * FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");
    $nbAgent=0;
    $pointsDirection=0;
    while ($row = mysqli_fetch_array($reqNotesRetour)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $pointsDirection=$pointsDirection+$row['points'];
      $nbAgent=$nbAgent+1;
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $hierarchie=$row['hierarchie'];
      $nb_part=$row['nb_part'];
      $decade=$row['decade'];
      $note=$row['note'];
      $points=$row['points'];

      $montant=0;


    //   INSERT INTO `fc_notes_finaux` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `montant`, `date_saisie`) 
    //   VALUES (NULL, '4', 'r', 't', '6', 't', '6', '6', '6', '6', '6', '2022-02-07');
      
      $sql = $con->query("INSERT INTO fc_notes_rejetees (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
       
      $sql = $con->query("INSERT INTO fc_notes_rejetees_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
      
      $sql = $con->query("INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

       
    //   $sql = $con->query("INSERT INTO  calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$montant','$dateDuJour')");
    
        }

        $sql = $con->query("INSERT INTO directions_notees_rejetees (codeFc,codeDirection,codeMinistere,nbAgent,total_points,commentaire,date_saisie) 
VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgent','$pointsDirection','$commentaire','$dateDuJour')");


        $sql = $con->query("DELETE FROM directions_notees_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");

        $sql = $con->query("DELETE FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");


    //   $sql = $con->query("DELETE FROM fc_notes_validees where codeFc='$codeFc'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Les etats notés sont retournés avec succès au service ! ";
        header("Location: ../monitoring_notes?fc=$codeFc");

}

if (isset($_POST['confirmerEtatsNotes'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $commentaire=$_POST['commentaire'];

    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $commentaire.'</br>';

    $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");
    $nbAgent=0;
    $pointsDirection=0;
    while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $pointsDirection=$pointsDirection+$row['points'];
      $nbAgent=$nbAgent+1;
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $hierarchie=$row['hierarchie'];
      $nb_part=$row['nb_part'];
      $decade=$row['decade'];
      $note=$row['note'];
      $points=$row['points'];

      $montant=0;


    //   INSERT INTO `fc_notes_finaux` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `montant`, `date_saisie`) 
    //   VALUES (NULL, '4', 'r', 't', '6', 't', '6', '6', '6', '6', '6', '2022-02-07');
      
      $sql = $con->query("INSERT INTO fc_notes_confirmees (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
       
      $sql = $con->query("INSERT INTO fc_notes_confirmees_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
      
    //   $sql = $con->query("INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

       
    //   $sql = $con->query("INSERT INTO  calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$montant','$dateDuJour')");
    
        }

        $sql = $con->query("INSERT INTO directions_notees_confirmees (codeFc,codeDirection,codeMinistere,nbAgent,total_points,commentaire,date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgent','$pointsDirection','$commentaire','$dateDuJour')");


        $sql = $con->query("DELETE FROM directions_notees_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");

        $sql = $con->query("DELETE FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");


        // Mise a jour du step
        $step="Demande de signature";
        $verifDoublonStep = mysqli_query($con, "SELECT * FROM step_direction where codeFc='$codeFc' AND codeDirection='$codeDirection' AND step='$step'");


        if (mysqli_num_rows($verifDoublonStep ) > 0) 
        {
            $sql = $con->query("UPDATE step_direction SET date_step='$date_saisie' where codeFc='$codeFc' AND codeDirection='$codeDirection' AND step='$step'");
        }
        else
        {
            $sql = $con->query("INSERT INTO `step_direction` (`codeFc`, `codeDirection`, `step`, `date_step`) 
            VALUES ('$codeFc', '$codeDirection', '$step', '$date_saisie')"); 
        }

    //   $sql = $con->query("DELETE FROM fc_notes_validees where codeFc='$codeFc'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Les etats notés sont confirmés et retournés pour signature avec succès ! ";
        header("Location: ../monitoring_notes?fc=$codeFc");

}

if (isset($_POST['envoyerEtatsTresor'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $commentaire=$_POST['commentaire'];

    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $commentaire.'</br>';

    $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");
    $nbAgent=0;
    $pointsDirection=0;
    while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $pointsDirection=$pointsDirection+$row['points'];
      $nbAgent=$nbAgent+1;
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $hierarchie=$row['hierarchie'];
      $nb_part=$row['nb_part'];
      $decade=$row['decade'];
      $note=$row['note'];
      $points=$row['points'];

      $montant=0;


    //   INSERT INTO `fc_notes_finaux` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `montant`, `date_saisie`) 
    //   VALUES (NULL, '4', 'r', 't', '6', 't', '6', '6', '6', '6', '6', '2022-02-07');
      
      $sql = $con->query("INSERT INTO fc_notes_signees_tresor (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
       
      $sql = $con->query("INSERT INTO fc_notes_signees_tresor_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
      
    //   $sql = $con->query("INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

       
    //   $sql = $con->query("INSERT INTO  calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$montant','$dateDuJour')");
    
        }

        // $sql = $con->query("INSERT INTO directions_notees_confirmees (codeFc,codeDirection,codeMinistere,nbAgent,total_points,commentaire,date_saisie) 
        // VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgent','$pointsDirection','$commentaire','$dateDuJour')");


        // $sql = $con->query("DELETE FROM directions_notees_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");

        // $sql = $con->query("DELETE FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");


      $sql = $con->query("DELETE FROM fc_notes_signees where codeFc='$codeFc' AND codeDirection='$codeDirection'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Les etats signés sont envoyés au tresor avec succès ! ";
        header("Location: ../monitoring_notes_signees?fc=$codeFc");
    //   $sql = $con->query("DELETE FROM fc_notes_validees where codeFc='$codeFc'");

}


if (isset($_POST['envoyerEtatsSgTresor'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $commentaire=$_POST['commentaire'];

    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $commentaire.'</br>';

    $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees_tresor WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");
    $nbAgent=0;
    $pointsDirection=0;
    while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $pointsDirection=$pointsDirection+$row['points'];
      $nbAgent=$nbAgent+1;
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $hierarchie=$row['hierarchie'];
      $nb_part=$row['nb_part'];
      $decade=$row['decade'];
      $note=$row['note'];
      $points=$row['points'];

      $montant=0;


    //   INSERT INTO `fc_notes_finaux` (`id`, `codeFc`, `codeDirection`, `codeMinistere`, `matricule`, `hierarchie`, `nb_part`, `decade`, `note`, `points`, `montant`, `date_saisie`) 
    //   VALUES (NULL, '4', 'r', 't', '6', 't', '6', '6', '6', '6', '6', '2022-02-07');
      
      $sql = $con->query("INSERT INTO fc_notes_signees_sg_tresor (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
       
      $sql = $con->query("INSERT INTO fc_notes_signees_sg_tresor_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
      VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
      
    //   $sql = $con->query("INSERT INTO fc_en_cours_notation (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

       
    //   $sql = $con->query("INSERT INTO  calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    //   VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$montant','$dateDuJour')");
    
        }

        // $sql = $con->query("INSERT INTO directions_notees_confirmees (codeFc,codeDirection,codeMinistere,nbAgent,total_points,commentaire,date_saisie) 
        // VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgent','$pointsDirection','$commentaire','$dateDuJour')");


        // $sql = $con->query("DELETE FROM directions_notees_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");

        // $sql = $con->query("DELETE FROM fc_notes_validees WHERE codeFc='$codeFc' AND codeDirection='$codeDirection'");


      $sql = $con->query("DELETE FROM fc_notes_signees_tresor where codeFc='$codeFc' and codeDirection='$codeDirection'");

        $_SESSION['errorMsg']=false;
        $_SESSION['successMsg']=true;
        $_SESSION['message'] ="Les etats du service sont validés et envoyés au secretaire generale avec succès ! ";
        header("Location: ../monitoring_tresor?fc=$codeFc");

}

if (isset($_POST['demanderApprobationPaiement'])) {
  $codeFc=$_POST['codeFc'];
  $commentaire=$_POST['commentaire'];
  $auteur=$_POST['auteur'];
  $statut_approbation="Demande Envoyée";


  $sql = $con->query("INSERT INTO approbation_paiement (codeFc,statut_approbation,auteur, commentaire,date_saisie) 
  VALUES ('$codeFc','$statut_approbation','$auteur','$commentaire', '$dateDuJour')");
   


  $_SESSION['errorMsg']=false;
  $_SESSION['successMsg']=true;
  $_SESSION['message'] ="La demande d'approbation pour le paiement est envoyée avec succès ! ";
  header("Location: ../creer_fond_commun");
}

if (isset($_POST['approuverPaiement'])) {
  $codeFc=$_POST['codeFc'];
  $commentaire=$_POST['commentaire'];
  $auteur=$_POST['auteur'];
  $statut_approbation="Demande Approuvée";


  $sql = $con->query("INSERT INTO approbation_paiement (codeFc,statut_approbation,auteur, commentaire,date_saisie) 
  VALUES ('$codeFc','$statut_approbation','$auteur','$commentaire', '$dateDuJour')");
   


  $_SESSION['errorMsg']=false;
  $_SESSION['successMsg']=true;
  $_SESSION['message'] ="Le fond commun $codeFc est approuvé pour paiement avec succès ! ";
  header("Location: ../creer_fond_commun");
}

if (isset($_POST['envoyerEtatsSgMinistere'])) {
  $codeFc=$_POST['codeFc'];
  $montantGlobal=$_POST['montantGlobal'];


  // echo $codeFc.'</br>';
  // echo $codeDirection.'</br>';
  // echo $commentaire.'</br>';


  $verifDoublon = mysqli_query($con, "SELECT * FROM montant_fc_propose WHERE codeFc='$codeFc'");


  if (mysqli_num_rows($verifDoublon ) > 0) 
  {
    $sql = $con->query("UPDATE montant_fc_propose SET montant='$montantGlobal', date_saisie='$dateDuJour' WHERE codeFc='$codeFc'");
  }
  else
  {
    $sql = $con->query("INSERT INTO montant_fc_propose (codeFc,codeMinistere,montant,date_saisie) VALUES ('$codeFc','$montantGlobal','$dateDuJour')");
  }

  $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees_sg_tresor WHERE codeFc='$codeFc'");
  $nbAgent=0;
  $pointsDirection=0;
  while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

    $codeFc=$row['codeFc'];
    $matricule=$row['matricule'];
    $pointsDirection=$pointsDirection+$row['points'];
    $nbAgent=$nbAgent+1;
    $codeDirection=$row['codeDirection'];
    $codeMinistere=$row['codeMinistere'];
    $hierarchie=$row['hierarchie'];
    $nb_part=$row['nb_part'];
    $decade=$row['decade'];
    $note=$row['note'];
    $points=$row['points'];

    $montant=0;
    
    $sql = $con->query("INSERT INTO fc_notes_signees_sg_ministere (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
     
    $sql = $con->query("INSERT INTO fc_notes_signees_sg_ministere_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

    // $sql = $con->query("DELETE FROM fc_notes_signees_tresor where codeFc='$codeFc' and codeDirection='$codeDirection'");

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="L'enveloppe du fond commun envoyée au secretaire generale du ministere avec succès ! ";
      header("Location: ../creer_fond_commun");

}
}

// Envoi Ministere 2
if (isset($_POST['envoyerEtatsSgMinistere2'])) {
  $codeFc=$_POST['codeFc'];
  $montantGlobal=$_POST['montantGlobal'];

  

  // echo $codeFc.'</br>';
  // echo $codeDirection.'</br>';
  // echo $commentaire.'</br>';


  $verifDoublon = mysqli_query($con, "SELECT * FROM montant_fc_propose WHERE codeFc='$codeFc'");


  if (mysqli_num_rows($verifDoublon ) > 0) 
  {
    $sql = $con->query("UPDATE montant_fc_propose SET montant='$montantGlobal', date_saisie='$dateDuJour' WHERE codeFc='$codeFc'");
  }
  else
  {
    $sql = $con->query("INSERT INTO montant_fc_propose (codeFc,codeMinistere,montant,date_saisie) VALUES ('$codeFc','$montantGlobal','$dateDuJour')");
  }

  $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees_sg_tresor WHERE codeFc='$codeFc'");
  $nbAgent=0;
  $pointsDirection=0;
  while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

    $codeFc=$row['codeFc'];
    $matricule=$row['matricule'];
    $pointsDirection=$pointsDirection+$row['points'];
    $nbAgent=$nbAgent+1;
    $codeDirection=$row['codeDirection'];
    $codeMinistere=$row['codeMinistere'];
    $hierarchie=$row['hierarchie'];
    $nb_part=$row['nb_part'];
    $decade=$row['decade'];
    $note=$row['note'];
    $points=$row['points'];

    $montant=0;
    
    $sql = $con->query("INSERT INTO fc_notes_signees_sg_ministere (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
     
    $sql = $con->query("INSERT INTO fc_notes_signees_sg_ministere_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");

    $sql = $con->query("INSERT INTO calcul_fc_encours_simulation (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','0','$dateDuJour')");

    // $sql = $con->query("DELETE FROM fc_notes_signees_tresor where codeFc='$codeFc' and codeDirection='$codeDirection'");
    
    // Similation
  }
    // On recupere le nombre total de point
    $reqTotalPoints = mysqli_query($con, "SELECT SUM(points) as mGlobal FROM calcul_fc_encours_simulation WHERE codeFc='$codeFc'");
    $totalPoints=0;
    while ($row = mysqli_fetch_array($reqTotalPoints)) {
        $totalPoints=$row['mGlobal'];
    }

    $montantParPoint=round(($montantGlobal/$totalPoints),2);


    $reqNotes= $con->query("SELECT * FROM calcul_fc_encours_simulation WHERE codeFc='$codeFc'");

    $montantAgent=0;
    while ($row = mysqli_fetch_array($reqNotes)) { 
      $matricule=$row['matricule'];
      $montantAgent=$row['points']*$montantParPoint;

      $sql = $con->query("UPDATE calcul_fc_encours_simulation SET montant='$montantAgent' WHERE matricule='$matricule'");

    }


    // Dispatch des montants par direction

    $reqNotes= $con->query("SELECT codeFc, codeDirection, codeMinistere, SUM(montant) as montantDirection, SUM(points) as pointsDirection FROM calcul_fc_encours_simulation GROUP BY codeFc, codeDirection, codeMinistere");
    
    while ($row = mysqli_fetch_array( $reqNotes)) { 
        $codeFc=$row['codeFc'];
        $codeDirection=$row['codeDirection'];
        $codeMinistere=$row['codeMinistere'];
        $montantDirection=$row['montantDirection'];
        $pointsDirection=$row['pointsDirection'];

        // On insere dans la table des resultats par direction
        $sql= mysqli_query($con, "INSERT INTO resultats_fc_direction_simulation (codeFc, codeDirection, codeMinistere, points, montant, date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$pointsDirection','$montantDirection','$dateDuJour')");


    }

      // Dispatch des montants par banque

      $reqBanque= $con->query("SELECT 
      calcul_fc_encours_simulation.codeFc,
      agents.codeBanque,
      SUM(calcul_fc_encours_simulation.montant) as montantBanque
      FROM calcul_fc_encours_simulation INNER JOIN agents ON agents.matricule=calcul_fc_encours_simulation.matricule
      WHERE calcul_fc_encours_simulation.codeFc='$codeFc'
      GROUP BY calcul_fc_encours_simulation.codeFc, 
      agents.codeBanque");
    
      while ($row = mysqli_fetch_array($reqBanque)) { 
          $codeFc=$row['codeFc'];
          $codeBanque=$row['codeBanque'];
          $montantBanque=$row['montantBanque'];

          // On insere dans la table des resultats par banque
          $sql= mysqli_query($con, "INSERT INTO resultats_fc_banque_simulation (codeFc,codeBanque, montant, date_saisie) 
          VALUES ('$codeFc','$codeBanque','$montantBanque','$dateDuJour')");

      }

        // Dispatch des montants par agence

        $reqAgence= $con->query("SELECT 
        calcul_fc_encours_simulation.codeFc,
        agents.codeAgence,
        SUM(calcul_fc_encours_simulation.montant) as montantAgence
        FROM calcul_fc_encours_simulation INNER JOIN agents ON agents.matricule=calcul_fc_encours_simulation.matricule
        WHERE calcul_fc_encours_simulation.codeFc='$codeFc'
        GROUP BY calcul_fc_encours_simulation.codeFc, 
        agents.codeAgence");
      
        while ($row = mysqli_fetch_array($reqAgence)) { 
            $codeFc=$row['codeFc'];
            $codeAgence=$row['codeAgence'];
            $montantAgence=$row['montantAgence'];

            // On insere dans la table des resultats par agence
            $sql= mysqli_query($con, "INSERT INTO resultats_fc_agence_simulation (codeFc,codeAgence, montant, date_saisie) 
            VALUES ('$codeFc','$codeAgence','$montantAgence','$dateDuJour')");


        }



    // Fin simulation
      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="L'enveloppe du fond commun envoyée au secretaire generale du ministere avec succès ! ";
      header("Location: ../creer_fond_commun");

}


if (isset($_POST['approuverEnveloppe'])) {
  $codeFc=$_POST['codeFc'];
  $montantFc=$_POST['montantFc'];

  

  // echo $codeFc.'</br>';
  // echo $montantFc.'</br>';
  // echo $commentaire.'</br>';


  $verifDoublon = mysqli_query($con, "SELECT * FROM montant_fc_approuve WHERE codeFc='$codeFc'");


  if (mysqli_num_rows($verifDoublon ) > 0) 
  {
    $sql = $con->query("UPDATE montant_fc_approuve SET montant='$montantFc', date_saisie='$dateDuJour' WHERE codeFc='$codeFc'");
  }
  else
  {
    $sql = $con->query("INSERT INTO montant_fc_approuve (codeFc,montant,date_saisie) VALUES ('$codeFc','$montantFc','$dateDuJour')");
  }

  $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees_sg_ministere WHERE codeFc='$codeFc'");
  $nbAgent=0;
  $pointsDirection=0;
  while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

    $codeFc=$row['codeFc'];
    $matricule=$row['matricule'];
    $pointsDirection=$pointsDirection+$row['points'];
    $nbAgent=$nbAgent+1;
    $codeDirection=$row['codeDirection'];
    $codeMinistere=$row['codeMinistere'];
    $hierarchie=$row['hierarchie'];
    $nb_part=$row['nb_part'];
    $decade=$row['decade'];
    $note=$row['note'];
    $points=$row['points'];

    $montant=0;
    
    $sql = $con->query("INSERT INTO fc_notes_finaux (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
     
    $sql = $con->query("INSERT INTO fc_notes_finaux_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");


    $sql = $con->query("INSERT INTO calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','0','$dateDuJour')");

    // $sql = $con->query("DELETE FROM fc_notes_signees_tresor where codeFc='$codeFc' and codeDirection='$codeDirection'");

    $sql = $con->query("UPDATE fonds_commun SET statut='Noté' WHERE codeFc='$codeFc'");

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="L'enveloppe du fond commun est approuvée avec succès ! ";
      header("Location: ../creer_fond_commun");

}
}


if (isset($_POST['approuverEnveloppe2'])) {
  $codeFc=$_POST['codeFc'];
  $montantFc=$_POST['montantFc'];

  

  // echo $codeFc.'</br>';
  // echo $montantFc.'</br>';
  // echo $commentaire.'</br>';


  $verifDoublon = mysqli_query($con, "SELECT * FROM montant_fc_approuve WHERE codeFc='$codeFc'");


  if (mysqli_num_rows($verifDoublon ) > 0) 
  {
    $sql = $con->query("UPDATE montant_fc_approuve SET montant='$montantFc', date_saisie='$dateDuJour' WHERE codeFc='$codeFc'");
  }
  else
  {
    $sql = $con->query("INSERT INTO montant_fc_approuve (codeFc,montant,date_saisie) VALUES ('$codeFc','$montantFc','$dateDuJour')");
  }

  $reqNotesConfirmees = $con->query("SELECT * FROM fc_notes_signees_sg_ministere WHERE codeFc='$codeFc'");
  $nbAgent=0;
  $pointsDirection=0;
  while ($row = mysqli_fetch_array($reqNotesConfirmees)) { 

    $codeFc=$row['codeFc'];
    $matricule=$row['matricule'];
    $pointsDirection=$pointsDirection+$row['points'];
    $nbAgent=$nbAgent+1;
    $codeDirection=$row['codeDirection'];
    $codeMinistere=$row['codeMinistere'];
    $hierarchie=$row['hierarchie'];
    $nb_part=$row['nb_part'];
    $decade=$row['decade'];
    $note=$row['note'];
    $points=$row['points'];

    $montant=0;
    
    $sql = $con->query("INSERT INTO fc_notes_finaux (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");
     
    $sql = $con->query("INSERT INTO fc_notes_finaux_ref (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','$dateDuJour')");


    $sql = $con->query("INSERT INTO calcul_fc_encours (codeFc,codeDirection,codeMinistere, matricule,hierarchie,nb_part,decade,note,points,montant,date_saisie) 
    VALUES ('$codeFc','$codeDirection','$codeMinistere','$matricule','$hierarchie','$nb_part',' $decade','$note','$points','0','$dateDuJour')");

    // $sql = $con->query("DELETE FROM fc_notes_signees_tresor where codeFc='$codeFc' and codeDirection='$codeDirection'");

    $sql = $con->query("UPDATE fonds_commun SET statut='Noté' WHERE codeFc='$codeFc'");

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="L'enveloppe du fond commun est approuvée avec succès ! ";
      header("Location: ../creer_fond_commun");

}
}

if (isset($_POST['calculerFc'])) {
    $montantGlobal=$_POST['montantGlobal'];
    $action='Fond calcule';
    $commentaire='';
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];



    $sql= mysqli_query($con, "INSERT INTO historique_fc (`codeFc`,`action`,`date`,`commentaire`) 
    VALUES ('$codeFc','$action','$dateDuJour','$commentaire')");

    // On recupere le nombre total de point
    $reqTotalPoints = mysqli_query($con, "SELECT SUM(points) as mGlobal FROM calcul_fc_encours WHERE codeFc='$codeFc'");
    $totalPoints=0;
    while ($row = mysqli_fetch_array($reqTotalPoints)) {
        $totalPoints=$row['mGlobal'];
    }

    $montantParPoint=round(($montantGlobal/$totalPoints),2);


    $reqNotes= $con->query("SELECT * FROM calcul_fc_encours WHERE codeFc='$codeFc'");

    $montantAgent=0;
    while ($row = mysqli_fetch_array($reqNotes)) { 
      $matricule=$row['matricule'];
      $montantAgent=$row['points']*$montantParPoint;

      $sql = $con->query("UPDATE calcul_fc_encours SET montant='$montantAgent' WHERE matricule='$matricule'");

    }


    // Dispatch des montants par direction

    $reqNotes= $con->query("SELECT codeFc, codeDirection, codeMinistere, SUM(montant) as montantDirection, SUM(points) as pointsDirection FROM calcul_fc_encours GROUP BY codeFc, codeDirection, codeMinistere");
    
    while ($row = mysqli_fetch_array( $reqNotes)) { 
        $codeFc=$row['codeFc'];
        $codeDirection=$row['codeDirection'];
        $codeMinistere=$row['codeMinistere'];
        $montantDirection=$row['montantDirection'];
        $pointsDirection=$row['pointsDirection'];

        // On insere dans la table des resultats par direction
        $sql= mysqli_query($con, "INSERT INTO resultats_fc_direction (codeFc, codeDirection, codeMinistere, points, montant, date_saisie) 
        VALUES ('$codeFc','$codeDirection','$codeMinistere','$pointsDirection','$montantDirection','$dateDuJour')");


    }

     // Dispatch des montants par banque

     $reqBanque= $con->query("SELECT 
     calcul_fc_encours.codeFc,
     agents.codeBanque,
     SUM(calcul_fc_encours.montant) as montantBanque
     FROM calcul_fc_encours INNER JOIN agents ON agents.matricule=calcul_fc_encours.matricule
     WHERE calcul_fc_encours.codeFc='$codeFc'
     GROUP BY calcul_fc_encours.codeFc, 
     agents.codeBanque");
    
     while ($row = mysqli_fetch_array($reqBanque)) { 
         $codeFc=$row['codeFc'];
         $codeBanque=$row['codeBanque'];
         $montantBanque=$row['montantBanque'];
 
         // On insere dans la table des resultats par banque
         $sql= mysqli_query($con, "INSERT INTO resultats_fc_banque (codeFc,codeBanque, montant, date_saisie) 
         VALUES ('$codeFc','$codeBanque','$montantBanque','$dateDuJour')");
 
     }

       // Dispatch des montants par agence

       $reqAgence= $con->query("SELECT 
       calcul_fc_encours.codeFc,
       agents.codeAgence,
       SUM(calcul_fc_encours.montant) as montantAgence
       FROM calcul_fc_encours INNER JOIN agents ON agents.matricule=calcul_fc_encours.matricule
       WHERE calcul_fc_encours.codeFc='$codeFc'
       GROUP BY calcul_fc_encours.codeFc, 
       agents.codeAgence");
      
       while ($row = mysqli_fetch_array($reqAgence)) { 
           $codeFc=$row['codeFc'];
           $codeAgence=$row['codeAgence'];
           $montantAgence=$row['montantAgence'];
   
           // On insere dans la table des resultats par agence
           $sql= mysqli_query($con, "INSERT INTO resultats_fc_agence (codeFc,codeAgence, montant, date_saisie) 
           VALUES ('$codeFc','$codeAgence','$montantAgence','$dateDuJour')");
   
   
       }

       $sql = $con->query("UPDATE fonds_commun SET statut='Calculé' WHERE codeFc='$codeFc'");

  
        // // Generation des bordereau d'envoi (Par Banque...)
        // include ('../genererEtatBanques');

        // // Agents beneficiaires par direction (Par Banque...)
        // include ('../genererEtatAgents');

        // include ('../exports');

       $_SESSION['errorMsg']=false;
       $_SESSION['successMsg']=true;
       $_SESSION['message'] ="Calculé avec succès ! ";
       header("Location: ../creer_fond_commun");


    // echo 'done !';
    // echo $montantGlobal.'</br>';
    // echo $codeFc.'</br>';
    // echo $codeMinistere.'</br>';
    // echo $totalPoints.'</br>';
    // echo 'Montant par point: '.$montantParPoint.'</br>';



}

if (isset($_POST['genererEtatsFinaux'])) {
  $codeFc=$_POST['codeFc'];

      
    // Generation des bordereau d'envoi (Par Banque...)
    include ('genererEtatBanques.php');

    // Agents beneficiaires par direction (Par Banque...)
    include ('genererEtatAgents.php');

    include ('exports.php');

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Etats finaux generés avec succès ! ";
    header("Location: ../creer_fond_commun");

}



if (isset($_POST['signerFc'])) {

    $codeFc=$_POST['codeFc'];
    $folderPath = "../signatures/";
    $image_parts = explode(";base64,", $_POST['signed']); 
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.'.$image_type;
    file_put_contents($file, $image_base64);
    
    $nomFile =  substr($file,3,100); 
    // echo "Signature enregistré avec Succès !";
    // // echo $file;
    // echo $codeFc.'</br>';
    // echo $nomFile;

    // On insere dans la table des resultats par banque
    $sql= mysqli_query($con, "INSERT INTO signatures (codeFc,signature, date_saisie) 
    VALUES ('$codeFc','$nomFile','$dateDuJour')");

    include ('../genererEtatBanques.php');
  
//   echo 'done';
  }
?>