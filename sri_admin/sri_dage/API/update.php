<?php
// UPDATE Ministere

    if ($action == 'updateMinistere') {
        $id = $_POST['id'];
        $code = $_POST['codeMinistere'];
        $acronyme = $_POST['acronyme'];
        $libelle = $_POST['libelle'];


        $sql =  $con->query("UPDATE ministeres SET codeMinistere='$code', acronyme='$acronyme', libelle='$libelle' WHERE id='$id'");

        if ($sql) {
            $result['message'] = "Ministere modifié avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de la mise a jour !";
        }
    }

    // UPDATE Note agent

    if ($action == 'updateNote') {
        $id = $_POST['id'];
        $codeFc=$_POST['codeFc'];
        $codeDirection=$_POST['codeDirection'];
        $codeMinistere=$_POST['codeMinistere'];
        $matricule = $_POST['matricule'];
        $hierarchie=$_POST['hierarchie'];
        $nb_part=$_POST['nb_part'];
        $decade=$_POST['decade'];
        $note = $_POST['note'];

        echo $codeFc;die;

        // $sql =  $con->query("UPDATE ministeres SET codeMinistere='$code', acronyme='$acronyme', libelle='$libelle' WHERE id='$id'");

        // if ($sql) {
        //     $result['message'] = "Ministere modifié avec succès !";
        // } else {
        //     $result['error'] = true;
        //     $result['message'] = "Probleme ! Echec de la mise a jour !";
        // }
    }

// UPDATE Direction Generale

if ($action == 'updateDirectionGenerale') {
    $id = $_POST['id'];
    $codeDirectionGenerale = $_POST['codeDirectionGenerale'];
    $codeMinistere = $_POST['codeMinistere'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];


    $sql =  $con->query("UPDATE directions_generales SET codeDirectionGenerale='$codeDirectionGenerale', sigle='$sigle', libelle='$libelle', codeMinistere='$codeMinistere' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Direction generale modifiée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Direction

if ($action == 'updateDirection') {
    $id = $_POST['id'];
    $codeDirection = $_POST['codeDirection'];
    $codeDirectionGenerale = $_POST['codeDirectionGenerale'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];

    //Update Ministere

    $recupMinistere = $con->query("SELECT codeMinistere FROM directions_generales WHERE codeDirectionGenerale='$codeDirectionGenerale'");

    while ($row = mysqli_fetch_array($recupMinistere)) {
        $codeMinistere=$row['codeMinistere'];
    }


    $sql =  $con->query("UPDATE directions SET codeDirection='$codeDirection', codeDirectionGenerale='$codeDirectionGenerale', sigle='$sigle', libelle='$libelle', codeMinistere='$codeMinistere' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Direction modifiée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Secteurs

if ($action == 'updateSecteur') {
    $id = $_POST['id'];
    $codeSecteur = $_POST['codeSecteur'];
    $secteur = $_POST['secteur'];


    $sql =  $con->query("UPDATE secteurs SET codeSecteur='$codeSecteur', secteur='$secteur' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Secteur modifié avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Metiers

if ($action == 'updateCorps') {
    $id = $_POST['id'];
    $codeCorps = $_POST['codeCorps'];
    $libelle = $_POST['libelle'];


    $sql =  $con->query("UPDATE corps SET codeCorps='$codeCorps', libelle='$libelle' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Corps modifié avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Hierarchie

if ($action == 'updateHierarchie') {
    $id = $_POST['id'];
    $hierarchie = $_POST['hierarchie'];
    $libelle = $_POST['libelle'];
    $nb_part = $_POST['nb_part'];



    $sql =  $con->query("UPDATE hierarchies SET hierarchie='$hierarchie', libelle='$libelle', nb_part='$nb_part' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Hierarchie modifiée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Hierarchie

if ($action == 'updateBanque') {
    $id = $_POST['id'];
    $codeBanque = $_POST['codeBanque'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];
    $adresse = $_POST['adresse'];

    $sql =  $con->query("UPDATE banques SET codeBanque='$codeBanque', sigle='$sigle', libelle='$libelle', adresse='$adresse' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Banque modifiée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}

// UPDATE Agence

if ($action == 'updateAgence') {
    $id = $_POST['id'];
    $codeAgence = $_POST['codeAgence'];
    $codeBanque = $_POST['codeBanque'];
    $libelleAgence = $_POST['libelleAgence'];
    $codeAgenceIBAN = $_POST['codeAgenceIBAN'];
    $adresse = $_POST['adresseAgence'];

    $sql =  $con->query("UPDATE agences SET codeAgence='$codeAgence', codeBanque='$codeBanque', libelleAgence='$libelleAgence', codeAgenceIBAN='$codeAgenceIBAN', adresseAgence='$adresse' WHERE id='$id'");

    if ($sql) {
        $result['message'] = "Agence modifiée avec succès !";
    } else {
        $result['error'] = true;
        $result['message'] = "Probleme ! Echec de la mise a jour !";
    }
}



?>

 