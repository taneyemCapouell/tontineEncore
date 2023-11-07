<?php
    session_start();
    if(isset($_SESSION["user"])){
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
        <link rel="icon" href="../../assets/image/cropped-logo-gsc.png">
        <script src="../../assets/fonts/fontawesome-all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php include('../_partial/alert_message.php')?>
                                        <form method="POST" action="../../controller/LoginController.php">

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" require name="mail" placeholder="name@example.com" />
                                                <label for="inputEmail" >Adresse Email</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="pass" require type="password" placeholder="Password" />
                                                <label for="inputPassword">Mot de Passe</label>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                   ²             </div>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Mot de passe oublier?</a>
                                                <button class="btn-primary  btn-lg" type="submit">Login</button>
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
                <footer class="py-4 bg-light mt-auto">
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
