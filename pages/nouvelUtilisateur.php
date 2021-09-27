<?php  
 require_once("connexiondb.php");
 require_once("../les_fonction/fonctions.php");
 //echo 'Nombre des user2 :'.rechercher_par_login('user2');
// echo 'Nombre des user10@gmail.com :'.rechercher_par_email('user10@gmail.com');


 if($_SERVER['REQUEST_METHOD']=='POST'){
     
     $login=$_POST['login'];
     $pwd1=$_POST['pwd1'];
     $pwd2=$_POST['pwd2'];
     $email=$_POST['email'];
     
     $validationErrors=array();
     
     if(isset($login)){
         $filtredLogin=filter_var($login,FILTER_SANITIZE_STRING);
         if(strlen($filtredLogin)<4){
             $validationErrors[]="Erreur !!! Le login doit contenir au moins 4 caractéres";
         }
     }
     if(isset($pwd1) && isset($pwd2)){
         if(empty($pwd1)){
             $validationErrors[]="Erreur !!! Le mot de passe ne doit pas etre vide";

         }
         if(md5($pwd1)!==md5($pwd2)){
             $validationErrors[]="Erreur !!! Les 2 mot de passe ne sont pas  identiques";
         }
         
     }
     
     if(isset($email)){
         $filtredEmail=filter_var($email,FILTER_SANITIZE_EMAIL);
         if($filtredEmail != true){
             $validationErrors[]="Erreur !!! email non valide";
         }
     }
     if(empty($validationErrors)){
         if(rechercher_par_login($login)==0 && rechercher_par_email($email)==0 ){
             $requete=$pdo->prepare("INSERT INTO utilisateur(login,email,pwd,role,etat) VALUES(:plogin,:pemail,:ppwd,:prole,:petat)");
             $requete->execute(array('plogin'=>$login,'pemail'=>$email,'ppwd'=>md5($pwd1),'prole'=>'VISITEUR','petat'=>0));
             $success_msg="Félicitation, votre compte est créer, mais temporairement inactif jusqu'a activation par l'admin";
         }else{
             if(rechercher_par_login($login)>0){
             $validationErrors[]='Désolé le login existe déja';
             
             
         }if(rechercher_par_email($email)>0){
             $validationErrors[]='Désolé le email existe déja';
             
             
         }
         }
     }
 }

 
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Nouvel utilisateur</title>
     <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="../css/monstyle.css">

</head>
<body>
    <div class=".container col-md-6 col-md-offset-3">
        <h1 class="text-center">Création D'un Nouveau Compte <br>Utilisateur</h1>
        <form class="form" method="post"  >
        <div class="input-container">
             <input type="text" required="required"
              minlength="4" 
              title="Le login doit contenire au moins 4 caractères..."
                name="login"
              placeholder="Taper votre nom d'utilisateur" 
              autocomplete="off" 
              class="form-control" >
        </div>
      
           <div class="input-container">                                                                                                       
        <input type="password" required="required"
              minlength="3" 
                title="Le mot de passe doit contenire au moins 3 caractères..."
                name="pwd1"
              placeholder="Taper votre mot de passe" 
              autocomplete="new-password" 
              class="form-control" >
               </div>
        <div class="input-container">
        <input type="password" required="required"
              minlength="3" 
              name="pwd2"
              placeholder="confirmer votre mot de passe" 
              autocomplete="new-password" 
              class="form-control" >
            </div>
        <div class="input-container">
        <input type="email" required="required"
                name="email"
              placeholder="Taper votre nom email" 
              autocomplete="off" 
              class="form-control" >
            </div>
        <input type="submit" class="btn btn-primary" value="Enregistrer" >
            </form>
        <br>
        <?php 
          if(isset($validationErrors) && !empty($validationErrors)){
              foreach($validationErrors as $error){
              echo '<div class="alert alert-danger">' .$error .'</div>';
          }
          }
          
        
        ?>
    </div>
</body>
</html> 