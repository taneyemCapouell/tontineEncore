<?php
session_start();
if (isset($_SESSION["user"])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="../../assets/fonts/fontawesome-all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Inscription</h3>
                                </div>
                                <div class="card-body">
                                    <?php include('../_partial/alert_message.php') ?>
                                    <form class="form" action="../../controller/traitement_inscription.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nom ">Nom<span class="text-danger">*</span></label>
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

                                                <div class="form-group mt-3">
                                                    <label for="localisation">Localisation<span class="text-danger">*</span></label>
                                                    <input type="text" id="localisation" name="localisation" class="form-control">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="role" class="mb-2">Genre : </label><br>
                                                    <input type="radio" value="masculin" name="genre" class="form-check-input">
                                                    <label class="form-input-label">Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <input type="radio" value="feminin" name="genre" class="form-check-input">
                                                    <label class="form-input-label">Feminin</label>
                                                </div>

                                                <div class="form-group  mt-3 ">
                                                    <label class="form-label">Role<span class="text-danger">*</span></label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="user" selected> User</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
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

                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Association : </label>
                                                <select class="form-control" name="associations_ID">
                                                    <option value="0">0</option>
                                                    <?php
                                                    include_once("../../dbconfig/connexion.php");
                                                    $sql = "SELECT * FROM associations";
                                                    $requette = $bdd->prepare($sql);
                                                    $requette->execute();
                                                    $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($result = $requette->fetch()) {
                                                        extract($result);
                                                        echo "<option value='$associations_ID'>$nom</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="d-flex align-items-center mr-4 mt-4 mb-0">
                                                <button type="submit" class="btn btn-lg mx-4  btn-primary">M'inscrire</button>
                                                <button type="reset" class="btn btn-lg   btn-danger">Annuler</button>
                                            </div>

                                            <div>
                                                <p class="mt-3">Vous avez deja un compte? <a href="../login/login.php">connectez-vous</a></p>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-5">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/scripts.js"></script>
</body>

</html>