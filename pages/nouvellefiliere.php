<?php
    require_once("identifier.php");
?>

<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>  
        
<div class="container">
                
            <div class="panel panel-primary margetop60">
            <div class="panel-heading">veuillez saisir les donnés de la nouvelle filière</div>
            <div class="panel-body">
                <form method="post" action="insertFiliere.php" class="form">
                    
                    <div class="form-group">
                         <label for="niveau">Nom de la filière:</label>
                   <input type="text" name="nomF" 
                          placeholder="le nom de la filière" 
                          class="form-control"
                          />
                         </div>
                    <div class="form-group">
                   <label for="niveau">Niveau:</label>  
                    <select name="niveau" class="form-control" id="niveau">
                        <option value="m">Master</option>
                        <option value="l">Licence</option>
                        <option value="ts" selected>Technicien spécialisé</option>
                        <option value="t">Technicien</option>
                        <option value="q">Qualification</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                    </button>
                    
                </form>
            </div>
            
        </div>
            
            </div>
    </body>
</HTML>