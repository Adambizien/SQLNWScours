<?php
    require_once "./src/toolkit.php";
    $pdo = new PDOManagerClass("ordinateur");
    // dd( $pdo->findAll("ordinateur"));
    dd( $pdo->findBy("ordinateur",['capacite_ram'=> 16,'prix' => 1299]));

    