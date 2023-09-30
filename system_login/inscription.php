<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./monstyle.css">
    <title>Mon formulaire</title>
</head>
<body>
    <div class="container-fluid mt-5">
    <div class="row ml-2">
        <div class="col-md-6 offset-3">

                <?php 
                    if(!empty($_SESSION['erreur'])){
                        echo'<div class="alert alert-danger" role="alert">
                        '.$_SESSION['erreur'].'
                        </div>';

                        $_SESSION['erreur'] = "";
                    }
                ?>
            <form class="form" action="traitementInscrip.php" method="POST">
                    <h2 class="text-primary ">INSCRIPTION</h2>
    
                <div class="form-group">
                    <label for="nom mt-4">Nom<span class="text-danger">*</span></label>
                    <input type="text" id="nom" name="nom" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="prenom">Prenom<span class="text-danger">*</span></label>
                    <input type="tetx" id="prenom" name="prenom" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="mail">Votre email<span class="text-danger">*</span></label>
                    <input type="email" id="mail" name="mail" class="form-control">
                </div>
    
                <div class="form-group mt-3">
                    <label for="telephone">Telephone<span class="text-danger">*</span></label>
                    <input type="number" id="telephone" name="telephone" class="form-control">
                </div>

                <div class="form-group mt-3" >
                    <select name="role" id="role" class="form-control">
                        <option value="user"selected> User</option>
                        <option value="admin" >Admin</option>
                    </select>
                </div>
    
                <div class="form-group mt-3">
                    <label for="genre">Genre<span class="text-danger">*</span></label>
                    <input type="text" id="genre" name="genre" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="date_nais">Date de naissance<span class="text-danger">*</span></label>
                    <input type="date" id="date_nais" name="date_nais" class="form-control">
                </div>
    
                <div class="form-group mt-3">
                    <label for="pass">Mot de passe<span class="text-danger">*</span></label>
                    <input type="password" id="pass" name="pass" class="form-control">
                </div>
    
                <div class="form-group mt-3">
                    <label for="confirmer">Confirmer le mot de passe<span class="text-danger">*</span></label>
                    <input type="password" id="confirmer" name="confirmer" class="form-control">
                </div>
                
                <div class="btn mt-3">
                    <button type="submit" class=" btn-lg  btn-block btn-primary">M'INSCRIRE</button>
                </div>

                <div>
                    <p>Vous avez deja un compte? <a href="connexion_user.php">connectez-vous</a></p>
                </div>

            </form>
        </div>
    </div> 
    </div>    
</body>
</html> 