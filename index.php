<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP / MySQL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>Bases de données MySQL</h1>  


<?php

// Données du Serveur 
        $servername = 'localhost';
        $username = 'root';
        $password = 'culture';
        $dbname = 'TPTable';


// Connexion
    try{
        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}

        catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
        // Requête 1

        echo '<h2>Requête 1</h2>';
        echo 'Nom, Prénom et ville de l\'ensemble des clients :';

        $req = $dbco->prepare('SELECT Nom,Prenom,Ville FROM  Clients');
        $req->execute();


        echo '<table border="1">';
        echo '<tr><th>Nom</th><th>Prenom</th><th>Ville</th></tr>';

        
        while ($donnees = $req->fetch()) {
        echo '<tr><td>' . $donnees['Nom'] . '</td>';
        echo '<td>' . $donnees['Prenom'] . '</td>';
        echo '<td>' . $donnees['Ville'] . '</td></tr>';
        }

        echo '</table>';


        // Requête 2

        echo '<h2>Requête 2</h2>';
        echo 'Ensemble des données du Flash N°5 :';

        $req = $dbco->prepare('SELECT * FROM Flash WHERE Id_Flash = 5');
        $req->execute();

        echo '<table border="1">';
        echo '<tr><th>Id QR Code</th><th>Date Flash</th><th>Smartphone</th><th>Id Client</th></tr>';

        
        while ($donnees = $req->fetch()) {
        echo '<tr><td>' . $donnees['Id_QRCode'] . '</td>';
        echo '<td>' . $donnees['Date_Flash'] . '</td>';
        echo '<td>' . $donnees['Smartphone'] . '</td>';
        echo '<td>' . $donnees['Id_Client'] . '</td></tr>';
        }

        echo '</table>';


        // Requête 3

        echo '<h2>Requête 3</h2>';

        $req = $dbco->prepare('SELECT Id_Flash FROM Flash WHERE Date_Flash BETWEEN 2021-02-01 AND 2021-02-28');
        $req->execute();

        echo '<table border="1">';
        echo '<tr><th>Id Client</th><th>QRCode</th></tr>';

        
        while ($donnees = $req->fetch()) {
        echo '<tr><td>' . $donnees['Id_Client'] . '</td>';
        echo '<td>' . $donnees['QRCode'] . '</td>';
        }

        echo '</table>';


        // Requête 4

        echo '<h2>Requête 4</h2>';
        echo 'Ensemble des clients et données obtenus avec la table 3 :';


        $req = $dbco->prepare('SELECT * FROM Flash WHERE Id_QRCode = 3');
        $req->execute();

        echo '<table border="1">';
        echo '<tr><th>Id Flash</th><th>Date Flash</th><th>Smartphone</th><th>Id Client</th><th>Id QR Code</th></tr>';

        
        while ($donnees = $req->fetch()) {
        echo '<tr><td>' . $donnees['Id_Flash'] . '</td>';
        echo '<td>' . $donnees['Date_Flash'] . '</td>';
        echo '<td>' . $donnees['Smartphone'] . '</td>';
        echo '<td>' . $donnees['Id_Client'] . '</td>';
        echo '<td>' . $donnees['Id_QRCode'] . '</td>';
        }

        echo '</table>';
?>

<!--Requête 5-->
<h2>Requête 5</h2>

<P> Tables flashées étant à l'ombre, et leur nombre de places :</p>

        <table>
        <tr>
        <th>Id Flash</th>
        <th>Places à Table</th>
        </tr>


<?php 
        $req = $dbco->prepare('SELECT Emplacement,Places FROM Resto_Table WHERE ID_QRCode = 2');
        $req->execute();
        
        
        while ($donnees = $req->fetch()) {
        echo '<tr><td>' . $donnees['Emplacement'] . '</td>';
        echo '<td>' . $donnees['Places'] . '</td></tr>';
        }
        
?>

        </table>

</body>
</html>
