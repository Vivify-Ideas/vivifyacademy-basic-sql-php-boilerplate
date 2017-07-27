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
<body class="va-l-page va-l-page--single">

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">


            <?php

                if (isset($_GET['post_id'])) {

                    $postId = $_GET['post_id'];

                    // pripremamo upit
                    $sql = "SELECT id, title, created_at, content, created_by FROM posts WHERE id = {$postId}";
                    $statement = $connection->prepare($sql);

                    // izvrsavamo upit
                    $statement->execute();

                    // zelimo da se rezultat vrati kao asocijativni niz.
                    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                    // punimo promenjivu sa rezultatom upita
                    $singlePost = $statement->fetch();

                    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    //            echo '<pre>';
                    //            var_dump($singlePost);
                    //            echo '</pre>';
            ?>


            <article class="va-c-article">
                <header>
                    <h1><?php echo($singlePost['title']) ?></h1>
                    <h3>category: <strong>Sports</strong></h3>
                    <div class="va-c-article__meta">12.06.2017. by John Doe</div>
                </header>

                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt vitae molestias rem repellendus commodi provident? Magnam, nobis quisquam perferendis consectetur deserunt laboriosam pariatur a, eum suscipit ratione iusto ullam aperiam quas quod culpa dolore corrupti voluptatem placeat enim commodi in.</p>
                    <p>Vel quasi sunt rem unde ea repellat eveniet at officia totam. Provident ut harum temporibus impedit odio quam amet accusamus ad quisquam velit incidunt praesentium cupiditate consectetur repellendus, fugiat quidem, officiis laudantium autem possimus ullam minima adipisci itaque? Eos, minus!</p>
                    <p>Veritatis exercitationem enim magnam deserunt velit facere quos ea hic quibusdam molestiae minus, earum reprehenderit error architecto cum cumque perferendis quas impedit rerum sapiente facilis debitis! Error, obcaecati ea illum beatae voluptate consequatur, iusto quam sapiente fugiat, exercitationem maiores similique?</p>
                    <p>Magni provident ex, doloribus architecto labore corrupti numquam. Beatae cumque alias aliquam iste ratione dolore in, odio libero numquam nemo reprehenderit modi magnam a laboriosam, ab quidem itaque deserunt explicabo facere deleniti illum, fuga vitae. Officiis at laborum doloremque assumenda.</p>
                </div>

                <footer>
                    <h3>tags: <a>football</a>, <a>champions league</a>, <a>qualifiers</a></h3>
                </footer>

                <div class="comments">
                    <h3>comments</h3>
                    <div class="single-comment">
                        <div>posted by: <strong>Pera Peric</strong> on 15.06.2017.</div>
                        <div>Provident ut harum temporibus impedit odio quam amet accusamus ad quisquam velit incidunt praesentium cupiditate consectetur repellendus, fugiat quidem, officiis laudantium autem possimus ullam minima adipisci itaque? Eos, minus!</div>
                    </div>
                    <div class="single-comment">
                        <div>posted by: <strong>Mitar Miric</strong> on 18.06.2017.</div>
                        <div>Incidunt praesentium cupiditate consectetur repellendus, fugiat quidem, officiis laudantium autem possimus ullam minima adipisci itaque? Eos, minus!</div>
                    </div>
                    <div class="single-comment">
                        <div>posted by: <strong>Dule Savic</strong> on 20.06.2017.</div>
                        <div>Jedna je Crvena Zvezda!</div>
                    </div>
                </div>

                <?php
                    } else {
                        echo('post_id parameter was not sent through $_GET.');
                    }
                ?>

            </article>
        </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>