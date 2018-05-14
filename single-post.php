<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "academy-blog";

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
<body class="va-l-page va-l-page--single">

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php
                if (isset($_GET['post_id'])) {
                    // pripremamo upit
                    $sql =
                    "SELECT *,
                        COALESCE(posts.id, users.id) as id,
                        COALESCE(posts.created_at, users.created_at) as created_at
                    FROM posts
                        JOIN users ON posts.user_id = users.id
                    WHERE posts.id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);

                    // izvrsavamo upit
                    $statement->execute();

                    // zelimo da se rezultat vrati kao asocijativni niz.
                    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                    // punimo promenjivu sa rezultatom upita
                    $singlePost = $statement->fetch();

                    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                        echo '<pre>';
                        // var_dump($singlePost);
                        echo '</pre>';

            ?>

                    <article class="va-c-article">
                        <header>
                            <h1><?php echo $singlePost['title'] ?></h1>

                            <!-- zameniti privremenu kategoriju pravom kategorijom blog post-a iz baze -->
                            <h3>category: <strong> Sports </strong></h3>

                            <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                            <div class="va-c-article__meta"><?php echo $singlePost['created_at'] ?> by <?php echo $singlePost['name'] ?></div>
                        </header>

                        <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
                        <div>
                            <?php echo $singlePost['body'] ?>
                        </div>

                        <footer>
                            <h3>tags:

                                <!-- zameniti testne tagove sa pravim tagovima blog post-a iz baze -->
                                <?php
                            $sqlTags =
                                "SELECT * FROM posts RIGHT JOIN post_tag ON posts.id = post_tag.post_id RIGHT JOIN tags ON tags.id = post_tag.tag_id WHERE  posts.id = {$_GET['post_id']}";

                            $statement = $connection->prepare($sqlTags);

                            // izvrsavamo upit
                            $statement->execute();

                            // zelimo da se rezultat vrati kao asocijativni niz.
                            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                            $statement->setFetchMode(PDO::FETCH_ASSOC);

                            // punimo promenjivu sa rezultatom upita
                            $tags = $statement->fetchAll();

                            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                                echo '<pre>';
                                var_dump($tags);
                                echo '</pre>';

                                foreach ($tags as $tag) {
                            ?>
                                <a><?php echo $tag['name']; ?>  </a> <br>
                                <?php  } ?>
                            </h3>
                        </footer>

                        <div class="comments">
                            <h3>comments</h3>

                            <!-- zameniti testne komentare sa pravim komentarima koji pripadaju blog post-u iz baze -->
                            <?php
                            $sqlComments =
                                "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";

                            $statement = $connection->prepare($sqlComments);

                            // izvrsavamo upit
                            $statement->execute();

                            // zelimo da se rezultat vrati kao asocijativni niz.
                            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                            $statement->setFetchMode(PDO::FETCH_ASSOC);

                            // punimo promenjivu sa rezultatom upita
                            $comments = $statement->fetchAll();

                            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                                echo '<pre>';
                                // var_dump($singlePost);
                                echo '</pre>';

                                foreach ($comments as $comment) {
                            ?>
                                    <div class="single-comment">
                                        <div>posted by: <strong>Pera Peric</strong> on <?php echo $comment['created_at'] ?></div>
                                        <div> <?php echo $comment['body'] ?> </div>
                                    </div>
                                <?php } ?>
                        </div>
                    </article>

            <?php
                } else {
                    echo('post_id nije prosledjen kroz $_GET');
                }
            ?>

        </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>