<?php 
    require_once("identifier.php");

   require_once('connexiondb.php');
   $nom=isset($_POST['nom'])?$_POST['nom']:"";
   $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
   $civilite=isset($_POST['civilite'])?$_POST['civilite']:"";
   $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:1;

   $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
   $imagetemp=$_FILES['photo']['tmp_name'];
   move_uploaded_file($imagetemp,"../images/".$nomPhoto);
   

   // echo $nomPhoto."<br>";
    //echo $imagetemp;


   
   $requete="insert into stagiaire(nom,prenom,civilite,idFiliere,photo) values(?,?,?,?,?)";     $params=array($nom,$prenom,$civilite,$idFiliere,$nomPhoto);
   
   $resultat=$pdo->prepare($requete);
   $resultat->execute($params);

   header('location:stagiaires.php');
?>