<?php 
// POST Ministere

if ($action == 'postMinistere') {

    $codeMinistere = $_POST['codeMinistere'];
    $acronyme = $_POST['acronyme'];
    $libelle = $_POST['libelle'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM  ministeres where codeMinistere='$codeMinistere'");

    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Le code ministere existe deja !";
        $result['message'] = "Probleme ! Le code ministere existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO  ministeres (codeMinistere, acronyme, libelle) VALUES ('$codeMinistere','$acronyme','$libelle') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Ministere ajouté avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout du ministere !";
        }
    }



}
// POST Direction generale

if ($action == 'postDirectionGenerale') {

    $codeDirectionGenerale = $_POST['codeDirectionGenerale'];
    $codeMinistere = $_POST['codeMinistere'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];



    $verifDoublon = mysqli_query($con, "SELECT * FROM  directions_generales where codeDirectionGenerale='$codeDirectionGenerale'");

    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Le code direction existe deja !";
        $result['message'] = "Probleme ! Le code direction existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO  directions_generales (codeDirectionGenerale, libelle, sigle, codeMinistere, statut) VALUES ('$codeDirectionGenerale','$libelle','$sigle','$codeMinistere','1') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Direction gènèrale ajoutée avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la direction generale !";
        }
    }
    
}

// POST Direction

if ($action == 'postDirection') {

    $codeDirection = $_POST['codeDirection'];
    $codeDirectionGenerale = $_POST['codeDirectionGenerale'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];

    $recupMinistere = $con->query("SELECT codeMinistere FROM directions_generales WHERE codeDirectionGenerale='$codeDirectionGenerale'");

    while ($row = mysqli_fetch_array($recupMinistere)) {
        $codeMinistere=$row['codeMinistere'];
    }
   
    $verifDoublon = mysqli_query($con, "SELECT * FROM  directions where codeDirection='$codeDirection'");

    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Le code direction existe deja !";
        $result['message'] = "Probleme ! Le code direction existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO  directions (codeDirection, libelle, sigle, codeDirectionGenerale, codeMinistere, statut) VALUES ('$codeDirection','$libelle','$sigle','$codeDirectionGenerale','$codeMinistere','1') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Direction ajouté avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la direction !";
        }
    }
}

// POST Secteurs

if ($action == 'postSecteur') {

    $codeSecteur = $_POST['codeSecteur'];
    $secteur = $_POST['secteur'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM  secteurs where codeSecteur='$codeSecteur'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Le code secteur existe deja !";
        $result['message'] = "Probleme ! Le code secteur existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO secteurs (codeSecteur, secteur) VALUES ('$codeSecteur','$secteur') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Secteur ajouté avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la direction !";
        }
    }

}

// POST Metiers

if ($action == 'postCorps') {

    $codeCorps = $_POST['codeCorps'];
    $libelle = $_POST['libelle'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM  corps where codeCorps='$codeCorps'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Le code metier existe deja !";
        $result['message'] = "Probleme ! Le code metier existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO corps (codeCorps, libelle) VALUES ('$codeCorps','$libelle') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Corps ajouté avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout du corps!";
        }
    }

}

// POST Hierarchies

if ($action == 'postHierarchie') {

    $hierarchie = $_POST['hierarchie'];
    $libelle = $_POST['libelle'];
    $nb_part = $_POST['nb_part'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM  hierarchies where hierarchie='$hierarchie'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Cette hierarchie existe deja !";
        $result['message'] = "Probleme ! Cette hierarchie existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO hierarchies (hierarchie, libelle, nb_part) VALUES ('$hierarchie','$libelle','$nb_part') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Hierarchie ajoutée avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la hierarchie!";
        }
    }

}

// POST Banques

if ($action == 'postBanque') {

    $codeBanque = $_POST['codeBanque'];
    $sigle = $_POST['sigle'];
    $libelle = $_POST['libelle'];
    $adresse = $_POST['adresse'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM  banques where codeBanque='$codeBanque'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Ce code existe deja !";
        $result['message'] = "Probleme ! Ce code existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO banques (codeBanque, libelle, sigle, adresse) VALUES ('$codeBanque','$libelle','$sigle','$adresse') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Banque ajoutée avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la banque!";
        }
    }

}

// POST Agences

if ($action == 'postAgence') {

    $codeAgence = $_POST['codeAgence'];
    $codeBanque = $_POST['codeBanque'];
    $libelleAgence = $_POST['libelleAgence'];
    $codeAgenceIBAN = $_POST['codeAgenceIBAN'];
    $adresse = $_POST['adresseAgence'];

    $verifDoublon = mysqli_query($con, "SELECT * FROM agences where codeAgence='$codeAgence'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Ce code existe deja !";
        $result['message'] = "Probleme ! Ce code existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO agences (codeAgence, libelleAgence, adresseAgence, codeAgenceIBAN, codeBanque) VALUES ('$codeAgence','$libelleAgence','$adresse','$codeAgenceIBAN', '$codeBanque') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Agence ajoutée avec succès !";
        } else {
            $result['error'] = true;
            $result['message'] = "Probleme ! Echec de l'ajout de la banque!";
        }
    }

}

// POST Agent

if ($action == 'postAgent') {

    $matricule = $_POST['matricule'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $numeroCompte = $_POST['numeroCompte'];
    $iban = $_POST['iban'];
    $codeAgence = $_POST['codeAgence'];
    $codeBanque = $_POST['codeBanque'];
    $hierarchie = $_POST['hierarchie'];
    $codeCorps = $_POST['codeCorps'];
    $codeFonction = $_POST['codeFonction'];
    $codeDirection = $_POST['codeDirection'];
    $codeDirectionGenerale = $_POST['codeDirectionGenerale'];
    $codeMinistere = $_POST['codeMinistere'];
    

    $verifDoublon = mysqli_query($con, "SELECT * FROM agents where matricule='$matricule'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! Ce matricule existe deja !";
        $result['message'] = "Probleme ! Ce matricule existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO agents (matricule, prenom, nom, codeMinistere, codeDirectionGenerale, codeDirection, codeFonction, codeCorps, hierarchie, codeBanque, codeAgence, numeroCompte, iban) 
        VALUES ('$matricule', '$prenom', '$nom', '$codeMinistere', '$codeDirectionGenerale', '$codeDirection', '$codeFOnction', '$codeCorps', '$hierarchie', '$codeBanque', '$codeAgence', '$numeroCompte', '$iban') ");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Agent ajouté avec succès !";
        } else {
            $result['error'] = "Probleme ! Echec de l'ajout de l'agent!";
            $result['message'] = "Probleme ! Echec de l'ajout de l'agent!";
        }
    }

}

// Post User
if ($action == 'postUser') {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email= $_POST['email'];
    $codeDirection = $_POST['codeDirection'];
    $codeMinistere = $_POST['codeMinistere'];
    $role = $_POST['role'];
    
    $mdpTemp='c355c70cca980e819a59f9d34f71460b6f207c950bccc62965b0da3669442fb9';

    // echo $prenom;die;

    $verifDoublon = mysqli_query($con, "SELECT * FROM users where email='$email'");


    if (mysqli_num_rows($verifDoublon ) > 0) 
    {
        $result['error'] = "Erreur ! L'utilisateur existe deja !";
        $result['message'] = "Probleme ! L'utilisateur existe deja !";
    }
    else
    {
        $sql = $con->query("INSERT INTO `users` (`prenom`, `nom`, `email`, `password`, `role`, `date_c`) 
        VALUES ('$prenom', '$nom', '$email', '$mdpTemp', '$role', '$dateDuJour')");

        if ($sql) {
            $result['error'] = false;
            $result['message'] = "Utilisateur ajouté avec succès !";
        } else {
            $result['error'] = "Probleme ! Echec de l'ajout de l'utilisateur!";
            $result['message'] = "Probleme ! Echec de l'ajout de l'utilisateur";
        }
    }

    

}
?>