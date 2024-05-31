<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'or PHP 8</title>
    <style>
        body {
            background-color: #eee;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #FFC107;
            padding: 20px;
            border: 1px solid #000;
        }
        .avis {
            margin-top: 20px;
        }
        .avis div {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Donnez votre avis sur PHP 8 !</h1>
        <form method="post">
            <label for="nom">Nom :</label><br>
            <input type="text" id="nom" name="nom"><br>
            <label for="mail">Mail :</label><br>
            <input type="text" id="mail" name="mail"><br>
            <label for="commentaire">Vos commentaires sur le site</label><br>
            <textarea id="commentaire" name="commentaire"></textarea><br>
            <input type="submit" name="envoyer" value="Envoyer">
            <input type="submit" name="afficher" value="Afficher les avis">
        </form>
        <?php
            if (isset($_POST['envoyer'])) {
                $nom = $_POST['nom'];
                $mail = $_POST['mail'];
                $commentaire = $_POST['commentaire'];
                $date = date("d/m/y H:i:s");

                $avis = "$nom|$mail|$commentaire|$date\n";

                file_put_contents('avis.txt', $avis, FILE_APPEND);
            }

            if (isset($_POST['afficher'])) {
                $avis = file('avis.txt');
                $avis = array_reverse($avis);
                $avis = array_slice($avis, 0, 5);

                foreach ($avis as $a) {
                    list($nom, $mail, $commentaire, $date) = explode('|', trim($a));
                    echo "<tr>";
                    echo "<td>$nom</td>";
                    echo "<td>$date</td><br><br>";
                    echo "<td>$commentaire</td> <br><br>";
                    echo "</tr>";
                }
            }
            ?>
    </div>
</body>
</html>
