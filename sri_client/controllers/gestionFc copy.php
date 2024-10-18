<?php
 include ('../config/app.php');
session_start();

date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");
$anneeEnCours = date('Y', strtotime($dateDuJour));

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
    header("Location: ../creer_fond_commun.php");
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
    header("Location: ../creer_fond_commun.php");
    
}

if (isset($_POST['supprimerFc'])) {
    $codeFc = $_POST['codeFc'];

    $sql = $con->query("DELETE FROM fonds_commun WHERE codeFc='$codeFc'");

    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Fond commun supprimé avec succès ! ";
    header("Location: ../creer_fond_commun.php");

}


if (isset($_POST['ouvrirFc'])) {
    $d_ouverture = $_POST['d_ouverture'];
    // $d_notation = $_POST['d_notation'];
    $d_l_initialisation = $_POST['d_l_initialisation'];
    // $d_l_notation = $_POST['d_l_notation'];
    $phase='Initialisation';
    $action='Ouverture';
    $commentaire='';
    
    $codeFc=$_POST['codeFc'];
    $codeMinistere=$_POST['codeMinistere'];

    // echo $codeFc;
    

    date_default_timezone_set('Africa/Dakar');
    $date_saisie = date("Y-m-d H:i:s");
    $dateDuJour = date("Y-m-d");

  
    $statut='Actif';

    $verifDoublon = mysqli_query($con, "SELECT * FROM deadlines_fc where codeFc='$codeFc' AND phase='$phase'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Ce matricule existe deja !";
        $result['message'] = "Probleme ! Ce matricule existe deja !";

        $_SESSION['errorMsg']=true;
        $_SESSION['successMsg']=false;
        $_SESSION['message'] ="Fond commun deja ouvert ! ";
        header("Location: ../ouverture_fond_commun.php");
    }
    else
    {

    $sql= mysqli_query($con, "INSERT INTO deadlines_fc (codeFc,phase,debut,fin) 
    VALUES ('$codeFc','$phase','$d_ouverture','$d_l_initialisation')");


    $recupAgents = mysqli_query($con, "SELECT * FROM agents WHERE codeMinistere='$codeMinistere'");

    $listeAgents=[];
    $codeDirections=[];
    while ($row = mysqli_fetch_array($recupAgents)) { 
        $listeAgents[] = $row['matricule'];
        $codeDirections[]=$row['codeDirection'];
      }

      for ($i=0;$i<count($listeAgents);$i++) {
        //   echo $listeAgents[$i].'</br>';
        $sql= mysqli_query($con, "INSERT INTO fc_en_cours_initialisation (codeFc,matricule,codeDirection,codeMinistere,statut, commentaire, date_saisie) 
        VALUES ('$codeFc','$listeAgents[$i]','$codeDirections[$i]','$codeMinistere','$statut',' ','$dateDuJour')");

        $sql= mysqli_query($con, "INSERT INTO fc_en_cours_initialisation_ref (codeFc,matricule,codeDirection,codeMinistere,statut, commentaire, date_saisie) 
        VALUES ('$codeFc','$listeAgents[$i]','$codeDirections[$i]','$codeMinistere','$statut',' ','$dateDuJour')");

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
      header("Location: ../creer_fond_commun.php");
      }


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
        header("Location: ../ouverture_fond_commun.php");
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

      $template_file = "../templates_email/ouverture_notation.php";
        
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
      header("Location: ../creer_fond_commun.php");
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
  header("Location: ../creer_fond_commun.php");


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
        header("Location: ../creer_fond_commun.php");
       
  }

  


}


if (isset($_POST['enleverAgent'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
  
    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_en_cours_initialisation SET statut='Inactif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Agent enlevé de la liste avec succès ! ";
    header("Location: ../initialiser_fond_commun.php?fc=$codeFc");
  
  }

  if (isset($_POST['ajouterAgent'])) {
  
    $codeFc=$_POST['codeFc'];
    $matricule=$_POST['matricule'];
    $commentaire=$_POST['commentaire'];
  
    // echo $codeFc.'</br>';
    // echo $matricule.'</br>';
    // echo $commentaire.'</br>';
  
    $sql = $con->query("UPDATE fc_en_cours_initialisation SET statut='Actif', commentaire='$commentaire' WHERE matricule='$matricule'");
  
    $_SESSION['errorMsg']=false;
    $_SESSION['successMsg']=true;
    $_SESSION['message'] ="Agent rajouté dans la liste avec succès ! ";
    header("Location: ../initialiser_fond_commun.php?fc=$codeFc");
  
  }

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
        header("Location: ../initialiser_fond_commun.php?fc=$codeFc");

}


  if (isset($_POST['validerInit'])) {
    $codeFc=$_POST['codeFc'];
    $codeDirection=$_POST['codeDirection'];
    $auteur=$_POST['auteur'];
    // echo $codeFc.'</br>';
    // echo $codeDirection.'</br>';
    // echo $auteur.'</br>';
// 
  $infosEncours = $con->query("SELECT * FROM fc_en_cours_initialisation WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");

  while ($row = mysqli_fetch_array($infosEncours)) { 
      $codeFc=$row['codeFc'];
      $matricule=$row['matricule'];
      $codeDirection=$row['codeDirection'];
      $codeMinistere=$row['codeMinistere'];
      $statut=$row['statut'];
      $commentaire=$row['commentaire'];
      
      $sql = $con->query("INSERT INTO fc_initialises (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
      VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
       $sql = $con->query("INSERT INTO fc_initialises_ref (codeFc, matricule,codeDirection,codeMinistere,statut,commentaire,date_saisie) 
       VALUES ('$codeFc','$matricule','$codeDirection','$codeMinistere','$statut','$commentaire','$dateDuJour')");
       
  }

  // Stats nb agent

      $reqNbAgentsInitialises = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInit FROM fc_initialises WHERE codeFc='$codeFc' and codeDirection='$codeDirection'");
      $nbAgentsInitialises=0;
      while ($row = mysqli_fetch_array($reqNbAgentsInitialises)) {
        $nbAgentsInitialises=$row['nbAgentsInit'];
       }
    
      $reqNbAgentsInitialisesActif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsActifInit FROM fc_initialises WHERE statut='Actif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesActif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesActif)) {
            $nbAgentsInitialisesActif=$row['nbAgentsActifInit'];
        }
    
      $reqNbAgentsInitialisesInactif = mysqli_query($con, "SELECT COUNT(matricule) as nbAgentsInactifInit FROM fc_initialises WHERE statut='Inactif' AND codeFc='$codeFc' and codeDirection='$codeDirection'");
        $nbAgentsInitialisesInactif=0;
        while ($row = mysqli_fetch_array($reqNbAgentsInitialisesInactif)) {
            $nbAgentsInitialisesInactif=$row['nbAgentsInactifInit'];
        }

  $sql = $con->query("INSERT INTO directions_initialises (codeFc,codeDirection,codeMinistere,nbAgent,nbAgentActif,nbAgentInactif,auteur,date_saisie) 
  VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgentsInitialises','$nbAgentsInitialisesActif','$nbAgentsInitialisesInactif','$auteur','$dateDuJour')");
  
  $sql = $con->query("INSERT INTO acteurs_notations (codeFc,codeDirection,codeMinistere,auteur,date_saisie) 
  VALUES ('$codeFc','$codeDirection','$codeMinistere','$auteur','$dateDuJour')");
  

  $sql = $con->query("DELETE FROM fc_en_cours_initialisation where codeFc='$codeFc' and codeDirection='$codeDirection'");

      $_SESSION['errorMsg']=false;
      $_SESSION['successMsg']=true;
      $_SESSION['message'] ="Initialisation validée avec succès ! </br> Merci de votre collaboration";
      header("Location: ../creer_fond_commun.php");


}

?>