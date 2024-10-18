<?php
session_start();
date_default_timezone_set('Africa/Dakar');
$date_saisie = date("Y-m-d H:i:s");
$dateDuJour = date("Y-m-d");

$codeFc=$_POST['codeFc'];
$codeDirection=$_POST['codeDirection'];
$codeMinistere=$_POST['codeMinistere'];
$auteur = $_POST['auteur'];

for ($i = 0; $i < count($_POST['matricules']); $i++) {
    $mat[] = $_POST['matricules'][$i];
    $hierarchies[] = $_POST['hierarchies'][$i];
    $parts[] = $_POST['nb_parts'][$i];
    $decades[] = $_POST['decades'][$i];
    $notes[] = $_POST['notes'][$i];
    // $points[] = (int)$_POST['nb_parts'][$i]*(int)$_POST['decades'][$i])*(int)$_POST['notes'][$i];
    }

    $recupAuteurSaisie= mysqli_query($con, "SELECT auteur FROM directions_notees");

    while ($row = mysqli_fetch_array($recupAuteurSaisie)) { 
        $auteurSaisie = $row['auteur'];
    }

    $pointsDirection=0;
    $nbAgent=0;
    for ($i = 0; $i < count($mat); $i++) 
    {
    
        $points=0;
        $points=$parts[$i]* $decades[$i]*$notes[$i];
        // echo 'code Fc : '.$codeFc.' - code Dir : '.$codeDirection.' - codeMin: '.$codeMinistere.' - Matricule : '.$mat[$i].' - Hierarchie : '.$hierarchies[$i].' - Part : '.$parts[$i].' - decade : '.$decades[$i].' - Note :'.$notes[$i].' - Points : '.$points.' - Auteur : '.$auteur.'</br></br>';

        $sql= mysqli_query($con, "INSERT INTO fc_notes_validees (codeFc,codeDirection,codeMinistere,matricule, hierarchie,nb_part,decade,note,points,date_saisie)
            VALUES ('$codeFc', '$codeDirection', '$codeMinistere', '$mat[$i]', '$hierarchies[$i]', '$parts[$i]', '$decades[$i]', '$notes[$i]', '$points', '$dateDuJour')");
        
        $sql= mysqli_query($con, "INSERT INTO fc_notes_validees_ref (codeFc,codeDirection,codeMinistere,matricule, hierarchie,nb_part,decade,note,points,date_saisie)
        VALUES ('$codeFc', '$codeDirection', '$codeMinistere', '$mat[$i]', '$hierarchies[$i]', '$parts[$i]', '$decades[$i]', '$notes[$i]', '$points', '$dateDuJour')");

        $pointsDirection = $pointsDirection+$points;
        $nbAgent=$nbAgent+1;
    }

// echo $pointsDirection;
// On persiste les meta donnees
$sql = $con->query("INSERT INTO directions_notees_validees (codeFc,codeDirection,codeMinistere,nbAgent,total_points,auteur,valideur,date_saisie) 
VALUES ('$codeFc','$codeDirection','$codeMinistere','$nbAgent','$pointsDirection','$auteurSaisie','$auteur','$dateDuJour')");

$sql = $con->query("DELETE FROM fc_notees_enregistrees where codeFc='$codeFc' and codeDirection='$codeDirection'");

// Mise a jour du step
$step="Notes validees";
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
$_SESSION['message'] ="Notes validées avec succès ! </br>";
header("Location: ../creer_fond_commun");


// echo 'Done'; 


// for ($i = 0; $i < count($mat); $i++) {
//     echo $mat[$i].'</br>';
//     echo $hierarchies[$i].'</br>';
//     echo $parts[$i].'</br>';
//     echo $decades[$i].'</br>';
//     echo $notes[$i].'</br>';
//     echo $points[$i].'</br>';

// }



// $verifDoublon = mysqli_query($con, "SELECT * FROM  notes where id_classe='$id_classe' and id_cours='$id_cours' and id_evaluation='$id_evaluation' and matricule_eleve='$mat[0]' ");


// if (mysqli_num_rows($verifDoublon) > 0) {
//     $_SESSION['successMsg']=false;
//     $_SESSION['errorMsg']=true;
//     $_SESSION['message'] = "Echec ! Les notes de cette evaluation sont deja saisies";
//     header('location: notes.php');
// } 
// else {
//     for ($i = 0; $i < count($_POST['matricule']); $i++) {
//         //  echo $id_classe. '</br>';
//         // echo $id_cours. '</br>';
//         // echo $id_evalution. '</br>';
//         // echo $mat[$i]. '</br>';
//         // echo $note[$i]. '</br>';

//         $sql = $con->query("INSERT INTO  notes (id_classe, id_cours, id_evaluation, matricule_eleve, note) 
//     VALUES ('$id_classe','$id_cours','$id_evalution','$mat[$i]', '$note[$i]') ");
   
//     $_SESSION['successMsg']=true;
//     $_SESSION['errorMsg']=false;
//     $_SESSION['message'] = "<strong style='color:green; font-size:16px'> Les notes de l'evaluation sont saisies avec success ! !</strong>";
//     header('location: notes.php');
// }


die;
?>