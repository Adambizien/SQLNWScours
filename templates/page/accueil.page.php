<?php
    require_once "./src/toolkit.php";
    require_once "./src/affichage.php";
    //ca c'est en abstrat donc pas possible de l'instancier 
    // $pdo = new PDOManagerClass("ordinateur");
    // dd( $pdo->findAll("ordinateur"));
    // dd( $pdo->findBy("ordinateur",['capacite_ram'=> 16,'prix' => 1299]));
    // dd($pdo->create("ordinateur",["marque"=>"ASUS","model"=>"Super Ordi du Turfu","puissance_cpu"=> 3,"capacite_ram"=>32,"puissance_gpu"=>3,"prix"=>4300]));
    // dd($pdo->delete("ordinateur",24));
    // dd($pdo->toManyDelete("ordinateur",[25,26,27,28]));
    // dd($pdo->update("ordinateur",["marque"=>"dobe","model"=>"Super Ordi de merde","puissance_cpu"=> 0,"capacite_ram"=>2,"puissance_gpu"=>0,"prix"=>100000],10));
    // dd($pdo->update("ordinateur",["marque"=>"dobe","model"=>"Super Ordi de merde","puissance_cpu"=> 0,"capacite_ram"=>2],10));
    // $tables = [["avis", "id_ordinateur"], ["ordinateur", "id"]];
    // $columns = ["marque", "model", "avis","ordinateur.id AS ordinateur_id","avis.id AS avis_id"];
    // $conditions = ["ordinateur.id = 15"];
    // $orderBy = ["avis.id" => "ASC"];

    // dd($pdo->getRelation($tables, $columns, $conditions, $orderBy));
    $customPdo = new CustomPDOManager("ordinateur");
    $customPdo->displayAll("ordinateur");
    // dd($customPdo->create("ordinateur",["marque"=>"ASUS","model"=>"Super Ordi du Turfu","puissance_cpu"=> 3,"capacite_ram"=>32,"puissance_gpu"=>3,"prix"=>434400]));