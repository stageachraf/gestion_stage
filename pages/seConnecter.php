<?php
  
   session_start();
   require_once('connexiondb.php');
   $login=isset($_POST['login'])?$_POST['login']:0;
   $pwd=isset($_POST['pwd'])?$_POST['pwd']:0;

   $requete="select iduser,login,email,role,etat from utilisateur where login='$login' and pwd=MD5('$pwd')";
   $resultat=$pdo->query($requete);
   
   if($user=$resultat->fetch()){
       if($user['etat']==1){
           $_SESSION['user']=$user;
           header('location:../index.php');
       }else{
           $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Votre compte est desactivé.<br> Veuillez contacter l'administration";
           header('location:login.php');
       }
   }else{
           $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou mot de passe incorrect!!!";
           header('location:login.php');
       }
?>

