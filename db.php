<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "vivify_blog_3_dan";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }



// pripremamo upit
$sql = "SELECT id, title, created_at, content, created_by FROM posts ORDER BY created_at DESC LIMIT 3";
$statement = $connection->prepare($sql);

// izvrsavamo upit
$statement->execute();

// zelimo da se rezultat vrati kao asocijativni niz.
// ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
$statement->setFetchMode(PDO::FETCH_ASSOC);

// punimo promenjivu sa rezultatom upita
$posts = $statement->fetchAll();

// koristite var_dump kada god treba da proverite sadrzaj neke promenjive
//    echo '<pre>';
                //    var_dump($posts);
                //    echo '</pre>';


?>