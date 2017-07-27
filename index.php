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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Vivify Academy Blog - Homepage</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="va-l-page va-l-page--homepage">

    <?php include('header.php') ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php

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



            // iteriramo kroz niz post-ova
            foreach ($posts as $post) { ?>

                <article class="va-c-article">
                    <header>
                        <h1><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>
                        <div class="va-c-article__meta">12. 6. 2017. by John Doe</div>
                    </header>

                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt vitae molestias rem repellendus commodi provident? Magnam, nobis quisquam perferendis consectetur deserunt laboriosam pariatur a, eum suscipit ratione iusto ullam aperiam quas quod culpa dolore corrupti voluptatem placeat enim commodi in.</p>
                    </div>
                </article>

            <?php } ?>

            <div class="va-c-paginator">
                <a href="all-posts.php" title="All posts">All posts</a>
            </div>
        </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>