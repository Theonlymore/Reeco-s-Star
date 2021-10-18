<?php
    
    $host="localhost";
    $table="reeco";
    $login="root";
    $mdp="";

    try {
        $pdo=new PDO("mysql:host=$host;dbname=$table","$login","$mdp");
        $pdo->exec('SET NAMES utf8');
    } catch (PDOException $e) {
        print "Erreur !:".$e->getMessage(). "<br/>";
        die();
    }
?>