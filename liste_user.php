<?php
require("./dbconfig/connexion.php");
$sql = "SELECT * FROM reunions";
$requette = $bdd->prepare($sql);
$requette->execute();
$result = $requette->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>document pdf</title>
    <link rel="stylesheet" href="./assets/css/bootstrap-grid.min.css">
    <link href="./assets/css/styles.css" rel="stylesheet" />
    <script src="./assets//fonts/fontawesome-all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap-utilities.rtl.min.css.map">
    <link rel="stylesheet" href="./assets/css/style_home.css">
    <style>
        table {
            border-collapse: collapse;
            border: black 1px solid;
        }

        tr {
            border: black 1px solid;
        }

        td {
            border: black 1px solid;
        }
    </style>
</head>

<body>
    <h1>
        Liste des reunions
    </h1>
    <table id="datatablesSimple" class="table text-center table-bordered    ">
        <thead>
            <th>ID</th>
            <th>Date de reunion</th>
            <th>Localisation</th>
            <th>Heure de debut</th>
            <th>Heure de fin</th>
            <th>Montant a cotiser</th>
            <th>Total cotisation</th>
            <th>Beneficiaire</th>
        </thead>
        <tbody>
            <?php
            // boucle sur la variable tableau
            $i = 0;
            foreach ($result as $reunions) {
                $i++;
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $reunions["date_reunion"] ?></td>
                    <td><?= $reunions["localisation"] ?></td>
                    <td><?= $reunions["heure_debut"] ?></td>
                    <td><?= $reunions["heure_fin"] ?></td>
                    <td><?= $reunions["montant_a_cotiser"] ?></td>
                    <td><?= $reunions["total_cotisation"] ?></td>
                    <td><?= $reunions["membres_ID"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
<script src="./assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="./assets/js/bootstrap.bundle.js"></script>

</html>





<div class="form-group">
    <label for="membres_ID" class="form-label">Membres :</label>
    <!-- <p><strong>NB : </strong>Maintenez la touche <strong>ctrl</strong> pour une selection multiple.</p> -->
    <select class="form-control" type="select" tabindex="1" multiple="multiple" id="membres_ID" name="membres_ID">
        <?php
        include_once("../../dbconfig/connexion.php");
        $sql = "SELECT * FROM membres";
        $requette = $bdd->prepare($sql);
        $requette->execute();
        $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
        while ($result = $requette->fetch()) {
            extract($result);
            echo "<option value='$membres_ID'>$nom</option>";
        }
        ?>
    </select>
</div>