<?php

use Dompdf\Dompdf;
use Dompdf\Options;
require("./dbconfig/connexion.php");
$sql = "SELECT * FROM reunions";
$requette = $bdd->prepare($sql);
$requette->execute();
$result = $requette->fetchAll();

ob_start();
require_once("./liste_user.php") ;

// recupere le contenu du html
$html = ob_get_contents();

ob_end_clean();
require_once("./assets/dompdf/autoload.inc.php");
// changer la police du caracter
$options = new Options();
$options->set('defaultFont' , 'courier'); 

$dompdf = new Dompdf($options);

// mettre du html
$dompdf->loadHtml($html);

// generer le pdf
$dompdf->render();

// taille du fichier
$dompdf->setPaper("A4", "portrait"); 

$fichier = ("liste_reunion9.pdf");
// envoyer le pdf en tant que fichier a telecharger
$dompdf->stream($fichier);
?>
