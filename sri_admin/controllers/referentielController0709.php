<?php
session_start();
include('../config/app');
/*********************************** Batiments *************************************/
// Creation
if (isset($_POST['ajouterBatiment'])) {
    $nom_batiment = $_POST['nom_batiment'];
    $contact_batiment = $_POST['contact_batiment'];
    $adresse_batiment = $_POST['adresse_batiment'];


    // Generation Code Batiment
    $getLastCode = mysqli_query($con, "SELECT max(code_batiment) as lastCode FROM batiments");
    while ($row = mysqli_fetch_array($getLastCode)) {
        $lastCode = $row['lastCode'];
    }

    if (!empty($lastCode)) {
        $code_batiment = $lastCode + 1;
    } else {
        $code_batiment = 101;
    }
    // echo $nom_batiment.'</br>';
    // echo $contact_batiment.'</br>';
    // echo $adresse_batiment.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM batiments WHERE nom_batiment='$nom_batiment'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce batiment existe deja ! ";
        header("Location: ../batiments");
    } else {
        $sql = mysqli_query($con, "INSERT INTO `batiments` (`code_batiment`, `nom_batiment`, `adresse`, `contact`) 
        VALUES ('$code_batiment', '$nom_batiment', '$adresse_batiment', '$contact_batiment');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Bâtiment ajouté avec succès !";
            header('Location: ../batiments');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../batiments');
        }
    }
}
// Modification
if (isset($_POST['modifierBatiment'])) {

    $code_batiment = $_POST['code_batiment'];
    $nom_batiment = $_POST['nom_batiment'];
    $contact_batiment = $_POST['contact_batiment'];
    $adresse_batiment = $_POST['adresse_batiment'];

    // echo $nom_batiment.'</br>';
    // echo $contact_batiment.'</br>';
    // echo $adresse_batiment.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $sql = mysqli_query($con, "UPDATE `batiments` SET nom_batiment='$nom_batiment', adresse='$adresse_batiment', contact='$contact_batiment' WHERE code_batiment='$code_batiment'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Bâtiment modifié avec succès !";
        header('Location: ../batiments');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../batiments');
    }
}
// Suppression
if (isset($_POST['supprimerBatiment'])) {

    $code_batiment = $_POST['code_batiment'];

    $sql = mysqli_query($con, "DELETE FROM `batiments` WHERE code_batiment='$code_batiment'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Bâtiment supprimé avec succès !";
        header('Location: ../batiments');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../batiments');
    }
}
/************************************* Etages ***************************************/
// Creation
if (isset($_POST['ajouterEtage'])) {

    $nom_etage = $_POST['nom_etage'];
    $code_batiment = $_POST['code_batiment'];

    // Generation Code Etage
    $getLastCode = mysqli_query($con, "SELECT max(code_etage) as lastCode FROM etages");
    while ($row = mysqli_fetch_array($getLastCode)) {
        $lastCode = $row['lastCode'];
    }

    if (!empty($lastCode)) {
        $code_etage = $lastCode + 1;
    } else {
        $code_etage = 201;
    }
    // echo $nom_etage.'</br>';
    // echo $code_etage.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM etages WHERE nom_etage='$nom_etage' and code_batiment='$code_batiment'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "L'etage existe deja dans ce batiment! ";
        header("Location: ../etages");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `etages` (`code_batiment`, `code_etage`, `nom_etage`) 
        VALUES ('$code_batiment', '$code_etage', '$nom_etage');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Étage ajoutée avec succès !";
            header('Location: ../etages');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../etages');
        }
    }
}
// Modification
if (isset($_POST['modifierEtage'])) {

    $nom_etage = $_POST['nom_etage'];
    $code_batiment = $_POST['code_batiment'];
    $code_etage = $_POST['code_etage'];

    // echo $nom_etage.'</br>';
    // echo $code_etage.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $sql = mysqli_query($con, "UPDATE etages SET code_batiment='$code_batiment', nom_etage='$nom_etage' WHERE code_etage='$code_etage'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Etage modifiée avec succès !";
        header('Location: ../etages');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../etages');
    }
}
// Suppression
if (isset($_POST['supprimerEtage'])) {

    $code_etage = $_POST['code_etage'];

    $sql = mysqli_query($con, "DELETE FROM `etages` WHERE code_etage='$code_etage'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Etage supprimée avec succès !";
        header('Location: ../etages');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../etages');
    }
}

/************************************* Pieces ***************************************/
// Creation
if (isset($_POST['ajouterPiece'])) {

    $nom_piece = $_POST['nom_piece'];
    $code_etage = $_POST['code_etage'];
    $code_batiment = $_POST['code_batiment'];

    // Generation Code Etage
    $getLastCode = mysqli_query($con, "SELECT max(code_piece) as lastCode FROM pieces");
    while ($row = mysqli_fetch_array($getLastCode)) {
        $lastCode = $row['lastCode'];
    }

    if (!empty($lastCode)) {
        $code_piece = $lastCode + 1;
    } else {
        $code_piece = 301;
    }
    // echo $nom_piece.'</br>';
    // echo $code_piece.'</br>';
    // echo $code_etage.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM pieces WHERE nom_piece='$nom_piece' and code_etage='$code_etage'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "La piece existe deja dans l'etage! ";
        header("Location: ../pieces");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `pieces` (`code_batiment`, `code_etage`, `code_piece`, `nom_piece`) 
        VALUES ('$code_batiment', '$code_etage', '$code_piece', '$nom_piece');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Piece ajoutée avec succès !";
            header('Location: ../pieces');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !" . mysqli_error($con);
            header('Location: ../pieces');
        }
    }
}
// Modification
if (isset($_POST['modifierPiece'])) {

    $nom_piece = $_POST['nom_piece'];
    $code_piece = $_POST['code_piece'];
    // $code_etage=$_POST['code_etage'];
    // $code_batiment=$_POST['code_batiment'];

    // echo $nom_piece.'</br>';
    // echo $code_piece.'</br>';
    // echo $code_etage.'</br>';
    // echo $code_batiment.'</br>';
    // die;

    $sql = mysqli_query($con, "UPDATE pieces SET nom_piece='$nom_piece' WHERE code_piece='$code_piece'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Piece modifiée avec succès !";
        header('Location: ../pieces');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../pieces');
    }
}
// Suppression
if (isset($_POST['supprimerPiece'])) {

    $code_piece = $_POST['code_piece'];

    $sql = mysqli_query($con, "DELETE FROM `pieces` WHERE code_piece='$code_piece'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Piece supprimée avec succès !";
        header('Location: ../pieces');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../pieces');
    }
}


/************************************* Ministeres ***************************************/
// Creation
if (isset($_POST['ajouterMinistere'])) {

    $code = $_POST['code'];
    $libelle = $_POST['libelle'];
    $sigle = $_POST['sigle'];


    // echo $code.'</br>';
    // echo $libelle.'</br>';
    // echo $sigle.'</br>';

    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM ministeres WHERE codeMinistere='$code' OR libelle='$libelle' OR acronyme='$sigle'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce ministere existe deja ! ";
        header("Location: ../ministeres");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `ministeres` (`codeMinistere`, `acronyme`, `libelle`) 
        VALUES ('$code', '$sigle', '$libelle');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Ministere ajouté avec succès !";
            header('Location: ../ministeres');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../ministeres');
        }
    }
}
// Modification
if (isset($_POST['modifierMinistere'])) {

    $code = $_POST['code'];
    $libelle = $_POST['libelle'];
    $sigle = $_POST['sigle'];
    $code_ministere = $_POST['code_ministere'];

    // echo $code.'</br>';
    // echo $libelle.'</br>';
    // echo $sigle.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE ministeres SET libelle='$libelle', codeMinistere='$code', acronyme='$sigle' WHERE codeMinistere='$code_ministere'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Ministere modifié avec succès !";
        header('Location: ../ministeres');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../ministeres');
    }
}
// Suppression
if (isset($_POST['supprimerMinistere'])) {

    $code_ministere = $_POST['code_ministere'];

    $sql = mysqli_query($con, "DELETE FROM `ministeres` WHERE codeMinistere='$code_ministere'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Ministere supprimé avec succès !";
        header('Location: ../ministeres');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../ministeres');
    }
}


/************************************* Services ***************************************/
// Creation
if (isset($_POST['ajouterService'])) {

    $code_service = $_POST['code_service'];
    $code_ministere = $_POST['code_ministere'];
    $libelle = $_POST['libelle'];
    $sigle = $_POST['sigle'];


    // echo $code_service.'</br>';
    // echo $code_ministere.'</br>';
    // echo $libelle.'</br>';
    // echo $sigle.'</br>';

    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM services WHERE code_service='$code_service' OR libelle='$libelle' OR sigle='$sigle'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce service existe deja ! ";
        header("Location: ../directions");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `services` (`code_service`, `libelle`, `sigle`, `codeMinistere`) 
        VALUES ('$code_service', '$libelle', '$sigle', '$code_ministere');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Service ajouté avec succès !";
            header('Location: ../directions');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../directions');
        }
    }
}
// Modification
if (isset($_POST['modifierService'])) {

    $code_service = $_POST['code_service'];
    $code_service_init = $_POST['code_service_init'];
    $libelle = $_POST['libelle'];
    $sigle = $_POST['sigle'];
    $code_ministere = $_POST['code_ministere'];

    // echo $code_service.'</br>';
    // echo $code_ministere.'</br>';
    // echo $libelle.'</br>';
    // echo $sigle.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE services SET libelle='$libelle', code_service='$code_service', sigle='$sigle', codeMinistere='$code_ministere' WHERE code_service='$code_service_init'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Services modifié avec succès !";
        header('Location: ../directions');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../directions');
    }
}
// Suppression
if (isset($_POST['supprimerService'])) {

    $code_service = $_POST['code_service_init'];

    $sql = mysqli_query($con, "DELETE FROM `services` WHERE code_service='$code_service'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Service supprimé avec succès !";
        header('Location: ../directions');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../directions');
    }
}


/************************************* Gestionnaires ***************************************/
// Creation
if (isset($_POST['ajouterGestionnaire'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = '+221' . $_POST['telephone'];
    $email = $_POST['email'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';die;


    // Generation Code Batiment
    $getLastMatricule = mysqli_query($con, "SELECT max(matricule_gestionnaire) as lastMatricule FROM gestionnaires");
    while ($row = mysqli_fetch_array($getLastMatricule)) {
        $lastMatricule = $row['lastMatricule'];
    }

    if (!empty($lastMatricule)) {
        $matricule_gestionnaire = $lastMatricule + 1;
    } else {
        $matricule_gestionnaire = 401;
    }

    $verifIntegrite = mysqli_query($con, "SELECT * FROM gestionnaires WHERE email='$email' OR telephone='$telephone'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce gestionnaire existe deja ! ";
        header("Location: ../gestionnaires");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `gestionnaires` (`matricule_gestionnaire`, `prenom`, `nom`, `email`, `telephone`) 
        VALUES ('$matricule_gestionnaire', '$prenom', '$nom', '$email', '$telephone');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Gestionnaire ajouté avec succès !";
            header('Location: ../gestionnaires');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../gestionnaires');
        }
    }
}
// Modification
if (isset($_POST['modifierGestionnaire'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $matricule_gestionnaire = $_POST['matricule_gestionnaire'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_gestionnaire.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE gestionnaires SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE matricule_gestionnaire='$matricule_gestionnaire'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Gestionnaires modifié avec succès !";
        header('Location: ../gestionnaires');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../gestionnaires');
    }
}
// Suppression
if (isset($_POST['supprimerGestionnaire'])) {

    $matricule_gestionnaire = $_POST['matricule_gestionnaire'];


    $sql = mysqli_query($con, "DELETE FROM `gestionnaires` WHERE matricule_gestionnaire='$matricule_gestionnaire'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Gestionnaire supprimé avec succès !";
        header('Location: ../gestionnaires');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../gestionnaires');
    }
}

/************************************* Responsables ***************************************/
// Creation
if (isset($_POST['ajouterResponsable'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = '+221' . $_POST['telephone'];
    $email = $_POST['email'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';die;


    // Generation Code Batiment
    $getLastMatricule = mysqli_query($con, "SELECT max(matricule) as lastMatricule FROM responsables_dage");
    while ($row = mysqli_fetch_array($getLastMatricule)) {
        $lastMatricule = $row['lastMatricule'];
    }

    if (!empty($lastMatricule)) {
        $matricule_responsable = $lastMatricule + 1;
    } else {
        $matricule_responsable = 501;
    }

    $verifIntegrite = mysqli_query($con, "SELECT * FROM responsables_dage WHERE email='$email' OR telephone='$telephone'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce responsable existe deja ! ";
        header("Location: ../responsables_dage");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `responsables_dage` (`matricule`, `prenom`, `nom`, `email`, `telephone`) 
        VALUES ('$matricule_responsable', '$prenom', '$nom', '$email', '$telephone');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Responsable ajouté avec succès !";
            header('Location: ../responsables_dage');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../responsables_dage');
        }
    }
}
// Modification
if (isset($_POST['modifierResponsable'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $matricule_responsable = $_POST['matricule_responsable'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_responsable.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE responsables_dage SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE matricule='$matricule_responsable'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Responsable modifié avec succès !";
        header('Location: ../responsables_dage');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../responsables_dage');
    }
}
// Suppression
if (isset($_POST['supprimerResponsable'])) {

    $matricule_responsable = $_POST['matricule_responsable'];


    $sql = mysqli_query($con, "DELETE FROM `responsables_dage` WHERE matricule='$matricule_responsable'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Responsable supprimé avec succès !";
        header('Location: ../responsables_dage');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../responsables_dage');
    }
}


/************************************* Responsables ***************************************/
// Creation
if (isset($_POST['ajouterIntervenant'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = '+221' . $_POST['telephone'];
    $email = $_POST['email'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';die;


    // Generation Code Batiment
    $getLastMatricule = mysqli_query($con, "SELECT max(matricule_intervenant) as lastMatricule FROM intervenants_interne");
    while ($row = mysqli_fetch_array($getLastMatricule)) {
        $lastMatricule = $row['lastMatricule'];
    }

    if (!empty($lastMatricule)) {
        $matricule_intervenant = $lastMatricule + 1;
    } else {
        $matricule_intervenant = 701;
    }

    $verifIntegrite = mysqli_query($con, "SELECT * FROM intervenants_interne WHERE email='$email' OR telephone='$telephone'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Cet intervenant existe deja ! ";
        header("Location: ../intervenants_dage");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `intervenants_interne` (`matricule_intervenant`, `prenom`, `nom`, `email`, `telephone`) 
        VALUES ('$matricule_intervenant', '$prenom', '$nom', '$email', '$telephone');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Intervenant ajouté avec succès !";
            header('Location: ../intervenants_dage');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../intervenants_dage');
        }
    }
}
// Modification
if (isset($_POST['modifierIntervenant'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $matricule_intervenant = $_POST['matricule_intervenant'];

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_intervenant.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE intervenants_interne SET prenom='$prenom', nom='$nom', telephone='$telephone', email='$email' WHERE matricule_intervenant='$matricule_intervenant'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Intervenant modifié avec succès !";
        header('Location: ../intervenants_dage');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../intervenants_dage');
    }
}
// Suppression
if (isset($_POST['supprimerIntervenant'])) {

    $matricule_intervenant = $_POST['matricule_intervenant'];

    $sql = mysqli_query($con, "DELETE FROM `intervenants_interne` WHERE matricule_intervenant='$matricule_intervenant'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Intervenant supprimé avec succès !";
        header('Location: ../intervenants_dage');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../intervenants_dage');
    }
}

/************************************* Types d'incident ***************************************/
// Creation
if (isset($_POST['ajouterTypeIncident'])) {

    $type_incident = $_POST['type_incident'];
    $couleur = $_POST['couleur'];

    // echo $type_incident.'</br>';
    // echo $couleur.'</br>';die;

    // Generation Code Etage
    $getLastCode = mysqli_query($con, "SELECT max(code_incident) as lastCode FROM type_incidents");
    while ($row = mysqli_fetch_array($getLastCode)) {
        $lastCode = $row['lastCode'];
    }

    if (!empty($lastCode)) {
        $code_incident = $lastCode + 1;
    } else {
        $code_incident = 201;
    }

    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_gestionnaire.'</br>';

    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM type_incidents WHERE type_incident='$type_incident'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce type d'incident existe deja ! ";
        header("Location: ../types_incident");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `type_incidents` (`code_incident`, `type_incident`, `couleur`) 
        VALUES ('$code_incident', '$type_incident', '$couleur');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Type d'incident ajouté avec succès !";
            header('Location: ../types_incident');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../types_incident');
        }
    }
}
// Modification
if (isset($_POST['modifierTypeIncident'])) {

    $type_incident = $_POST['type_incident'];
    $couleur = $_POST['couleur'];
    $code_incident = $_POST['code_incident'];

    // echo $type_incident.'</br>';
    // echo $couleur.'</br>';
    // echo $code_incident.'</br>';die;


    $sql = mysqli_query($con, "UPDATE type_incidents SET type_incident='$type_incident', couleur='$couleur' WHERE code_incident='$code_incident'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Type d'incident modifié avec succès !";
        header('Location: ../types_incident');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../types_incident');
    }
}
// Suppression
if (isset($_POST['supprimerTypeIncident'])) {

    $code_incident = $_POST['code_incident'];

    $sql = mysqli_query($con, "DELETE FROM `type_incidents` WHERE code_incident='$code_incident'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Type d'incident supprimé avec succès !";
        header('Location: ../types_incident');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../types_incident');
    }
}

/************************************* Prestataires ***************************************/
// Creation
if (isset($_POST['ajouterPrestataire'])) {

    $denomination = $_POST['denomination'];
    $adresse = $_POST['adresse'];
    $telephone = '+221' . $_POST['telephone'];
    $email = $_POST['email'];
    $matricule_presta = $_POST['matricule_presta'];


    // echo $code_service.'</br>';
    // echo $code_ministere.'</br>';
    // echo $libelle.'</br>';
    // echo $sigle.'</br>';

    // die;
    // Generation matricule prestataire
    $getLastMatricule = mysqli_query($con, "SELECT max(matricule_presta) as lastMatricule FROM prestataires");

    while ($row = mysqli_fetch_array($getLastMatricule)) {
        $lastMatricule = $row['lastMatricule'];
    }

    if (!empty($lastMatricule)) {
        $matricule_presta = $lastMatricule + 1;
    } else {
        $matricule_presta = 601;
    }

    $verifIntegrite = mysqli_query($con, "SELECT * FROM prestataires WHERE denomination='$code_service' OR telephone='$telephone' OR email='$email'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce Prestataire existe deja ! ";
        header("Location: ../prestataires");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `prestataires` (`matricule_presta`, `denomination`, `adresse`,  `telephone`, `email`) 
        VALUES ('$matricule_presta', '$denomination', '$adresse', '$telephone', '$email');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Prestataire ajouté avec succès !";
            header('Location: ../prestataires');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../prestataires');
        }
    }
}
// Modification
if (isset($_POST['modifierPrestataire'])) {

    $denomination = $_POST['denomination'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $matricule_presta = $_POST['matricule_presta'];


    // echo $denomination.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_presta.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE prestataires SET denomination='$denomination', adresse='$adresse', email='$email', telephone='$telephone' WHERE matricule_presta='$matricule_presta'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Prestataire modifié avec succès !";
        header('Location: ../prestataires');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../prestataires');
    }
}
// Suppression
if (isset($_POST['supprimerPrestataire'])) {

    $matricule_presta = $_POST['matricule_presta'];

    $sql = mysqli_query($con, "DELETE FROM `prestataires` WHERE matricule_presta='$matricule_presta'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Prestataire supprimé avec succès !";
        header('Location: ../prestataires');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../prestataires');
    }
}

/************************************* Services intervenant ***************************************/
// Creation
if (isset($_POST['ajouterServiceIntervenant'])) {

    // echo 'yy';die;
    $nom_service = $_POST['nom_service'];
    $telephone = '+221' . $_POST['telephone'];
    $email = $_POST['email'];

    // $matricule_service=$_POST['matricule_service'];




    // Generation matricule prestataire
    $getLastMatricule = mysqli_query($con, "SELECT max(matricule_service) as lastMatricule FROM services_intervenant");

    while ($row = mysqli_fetch_array($getLastMatricule)) {
        $lastMatricule = $row['lastMatricule'];
    }

    if (!empty($lastMatricule)) {
        $matricule_service = $lastMatricule + 1;
    } else {
        $matricule_service = 801;
    }

    // echo $nom_service.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_service.'</br>';
    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM services_intervenant WHERE nom_service='$nom_service'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce service existe deja ! ";
        header("Location: ../services_intervenant");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `services_intervenant` (`matricule_service`, `nom_service`, `telephone`, `email`) 
        VALUES ('$matricule_service', '$nom_service', '$telephone', '$email');");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Service ajouté avec succès !";
            header('Location: ../services_intervenant');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../services_intervenant');
        }
    }
}
// Modification
if (isset($_POST['modifierServiceIntervenant'])) {

    $matricule_service = $_POST['matricule_service'];

    $nom_service = $_POST['nom_service'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    // echo $nom_service.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_service.'</br>';
    // die;


    // $matricule_service=$_POST['matricule_service'];

    // echo $denomination.'</br>';
    // echo $telephone.'</br>';
    // echo $email.'</br>';
    // echo $matricule_presta.'</br>';

    // die;

    $sql = mysqli_query($con, "UPDATE services_intervenant SET nom_service='$nom_service', email='$email', telephone='$telephone' WHERE matricule_service='$matricule_service'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Service modifié avec succès !";
        header('Location: ../services_intervenant');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../services_intervenant');
    }
}
// Suppression
if (isset($_POST['supprimerServiceIntervenant'])) {

    // echo 't';die;
    $matricule_service = $_POST['matricule_service'];

    // echo $matricule_service;die;

    $sql = mysqli_query($con, "DELETE FROM `services_intervenant` WHERE matricule_service='$matricule_service'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Service supprimé avec succès !";
        header('Location: ../services_intervenant');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../services_intervenant');
    }
}

/************************************* Types d'incident ***************************************/
// Creation
if (isset($_POST['ajouterRole'])) {

    $role = $_POST['nom_role'];

    // echo $role.'</br>';

    // die;
    $getLastCode = mysqli_query($con, "SELECT max(code_role) as lastCode FROM roles");

    while ($row = mysqli_fetch_array($getLastCode)) {
        $lastCode = $row['lastCode'];
    }

    if (!empty($lastCode)) {
        $code_role = $lastCode + 1;
    } else {
        $code_role = 1;
    }

    $verifIntegrite = mysqli_query($con, "SELECT * FROM roles WHERE role='$role'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Ce rôle existe deja ! ";
        header("Location: ../roles");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `roles` (`code_role`,`role`) VALUES ('$code_role','$role')");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Rôle ajouté avec succès !";
            header('Location: ../roles');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../roles');
        }
    }
}
// Modification
if (isset($_POST['modifierRole'])) {

    $id = $_POST['idE'];
    $role = $_POST['nom_role'];




    $sql = mysqli_query($con, "UPDATE roles SET role='$role' WHERE id='$id'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Rôle modifié avec succès !";
        header('Location: ../roles');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la modification !";
        header('Location: ../roles');
    }
}
// Suppression
if (isset($_POST['supprimerRole'])) {

    $id = $_POST['idE'];

    $sql = mysqli_query($con, "DELETE FROM `roles` WHERE id='$id'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Rôle supprimé avec succès !";
        header('Location: ../roles');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../roles');
    }
}

/************************************* Utilisateurs ***************************************/
// Creation
if (isset($_POST['ajouterUser'])) {

    $code_role = $_POST['code_role'];
    $pass_tmp = '5d0cf713a106628663bb8c552f31d4491fc9f38a0878626b5af4b0d91a914291';

    $getRoleName = mysqli_query($con, "SELECT * FROM roles WHERE code_role='$code_role'");
    while ($row = mysqli_fetch_array($getRoleName)) {
        $role = $row['role'];
    }

    switch ($code_role) {
        case 1:
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            break;
        case 2:
            // Gestionnaire....
            $matricule = $_POST['matricule'];
            $getInfos = mysqli_query($con, "SELECT * FROM gestionnaires WHERE matricule_gestionnaire='$matricule'");

            while ($row = mysqli_fetch_array($getInfos)) {
                $prenom = $row['prenom'];
                $nom = $row['nom'];
                $email = $row['email'];
            }
            break;
        case 3:
            // Responsables....
            $matricule = $_POST['matricule'];
            $getInfos = mysqli_query($con, "SELECT * FROM responsables_dage WHERE matricule='$matricule'");

            while ($row = mysqli_fetch_array($getInfos)) {
                $prenom = $row['prenom'];
                $nom = $row['nom'];
                $email = $row['email'];
            }
            break;
        default:
            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Ce rôle n'est pas encore prise en compte ! ";
            header("Location: ../utilisateurs");
            die;
            break;
    }

    // echo $code_role.'</br>';
    // echo $role.'</br>';
    // echo $matricule.'</br>';
    // echo $prenom.'</br>';
    // echo $nom.'</br>';
    // echo $email.'</br>';
    // die;

    $verifIntegrite = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($verifIntegrite) > 0) {
        // $sql =  $con->query("UPDATE contacts SET telephone='$telephone', email='$email', adresse='$adresse' WHERE matricule='$matricule'");

        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Un utilisateur existe deja avec cet email ! ";
        header("Location: ../utilisateurs");
    } else {

        $sql = mysqli_query($con, "INSERT INTO `users` (`prenom`, `nom`, `email`, `password`, `role`, `statut`, `date_c`) 
    VALUES ('$prenom', '$nom', '$email', '$pass_tmp', '$role', '1', '$date_saisie')");

        if ($sql) {
            $_SESSION['errorMsg'] = false;
            $_SESSION['successMsg'] = true;
            $_SESSION['message'] = "Utilisateur ajouté avec succès !";
            header('Location: ../utilisateurs');
        } else {

            $_SESSION['errorMsg'] = true;
            $_SESSION['successMsg'] = false;
            $_SESSION['message'] = "Echec de la creation !";
            header('Location: ../utilisateurs');
        }
    }
}

// Suppression
if (isset($_POST['supprimerUser'])) {

    $email = $_POST['email'];

    $sql = mysqli_query($con, "DELETE FROM `users` WHERE email='$email'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Utilisateur supprimé avec succès !";
        header('Location: ../utilisateurs');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la suppression !";
        header('Location: ../utilisateurs');
    }
}

// Desactiver
if (isset($_POST['desactiverUser'])) {

    $email = $_POST['email'];

    $sql = mysqli_query($con, "UPDATE `users` SET statut=0 WHERE email='$email'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Utilisateur desactivé avec succès !";
        header('Location: ../utilisateurs');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la desactivation !";
        header('Location: ../utilisateurs');
    }
}

// Activer
if (isset($_POST['activerUser'])) {

    $email = $_POST['email'];

    $sql = mysqli_query($con, "UPDATE `users` SET statut=1 WHERE email='$email'");

    if ($sql) {
        $_SESSION['errorMsg'] = false;
        $_SESSION['successMsg'] = true;
        $_SESSION['message'] = "Utilisateur activé avec succès !";
        header('Location: ../utilisateurs');
    } else {
        $_SESSION['errorMsg'] = true;
        $_SESSION['successMsg'] = false;
        $_SESSION['message'] = "Echec de la l'activation !";
        header('Location: ../utilisateurs');
    }
}
