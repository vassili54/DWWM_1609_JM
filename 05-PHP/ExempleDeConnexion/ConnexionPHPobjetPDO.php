<?php
        try {

            $connect = new PDO('mysql:host=localhost;port=3306;dbname=annuaire;charset=utf8', 'root', '');
        } catch (Exception $e) {

            echo $e->getMessage();
        }

        $rq = "SELECT * from carnet where carnet.VILLE like 'ORLEANS' ";

        $PDOstatement = $connect->query($rq, PDO::FETCH_ASSOC);

        while ($ligne = $PDOstatement->fetch()) {

            var_export($ligne);
            echo "<br>";
        }

        ?>