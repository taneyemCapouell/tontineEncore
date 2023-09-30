<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./monstyle.css">
    <title>mon formulaire</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-6  offset-3"> 
               <div class="ml-5">
               <form class="form" action="traitementConnex.php" method="POST">
                        <h2 class="text-primary">CONNEXION</h2>
        
                    <div class="form-group mt-3">
                        <label for="mail  ">Adresse email <span class="text-danger">*</span></label>
                        <input type="email" id="mail" name="mail" class="form-control">
                    </div>
        
                    <div class="form-group mt-3">
                        <label for="pass ">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" id="pass" name="pass" class="form-control">
                    </div>
                    
                    <div class="btn">
                        <button type="submit" class="btn-primary btn-lg btn-block ">LOGIN</button>
                    </div>

                    <div>
                        <p>Vous n'avez pas de compte? Cliquez <a href="inscription.php">ici</a> pour vous enregistree</p>
                    </div>
        
                </form>
               </div>
            </div>
        </div>
    </div>
</body>
</html>