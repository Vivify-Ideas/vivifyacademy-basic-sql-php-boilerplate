<?php
  include('db.php');
  if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM posts WHERE id = '$id'";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: ./index.php");
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
                    
                    // $sql = "SELECT users.username, posts.* 
                    // FROM posts INNER JOIN users ON users.id = posts.user_id 
                    // WHERE posts.id = {$_GET['post_id']}";

                    // $statement = $connection->prepare($sql);
                    // $statement->execute();
                    // $statement->setFetchMode(PDO::FETCH_ASSOC);
                    // $singlePost = $statement->fetch();

                    // $sql2 = "SELECT * FROM comments 
                    // WHERE post_id = {$_GET['post_id']}";
                    // $statement = $connection->prepare($sql2);
                    // $statement->execute();
                    // $statement->setFetchMode(PDO::FETCH_ASSOC);
                    // $comments = $statement->fetchAll();

                    // // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    //     // echo '<pre>';
                    //     // var_dump($comments);
                    //     // echo '</pre>';

                    // $sql3 = "SELECT * FROM tags 
                    // INNER JOIN post_tag ON tags.id = post_tag.tag_id 
                    // WHERE post_tag.post_id = {$_GET['post_id']}";
                    // $statement = $connection->prepare($sql3);
                    // $statement->execute();
                    // $statement->setFetchMode(PDO::FETCH_ASSOC);
                    // $tags = $statement->fetchAll();

                    //  echo '<pre>';
                    //     // var_dump($tags);
                    //     echo '</pre>';

                    //Kroz funkciju


                    $sql = "SELECT users.username, posts.* 
                    FROM posts INNER JOIN users ON users.id = posts.user_id 
                    WHERE posts.id = {$_GET['post_id']}";

                    $singlePost = getData($sql, $connection);

                    $sql2 = "SELECT * FROM comments 
                    WHERE post_id = {$_GET['post_id']}";

                    $comments = getData($sql2, $connection, true);


                    $sql3 = "SELECT * FROM tags 
                    INNER JOIN post_tag ON tags.id = post_tag.tag_id 
                    WHERE post_tag.post_id = {$_GET['post_id']}";

                    $tags = getData($sql3, $connection, true);


            ?>

                    <article class="va-c-article">
                        <form action="/single-post.php" method="post">
                            <input hidden type="text" name="id" value="<?php echo($singlePost['id']) ?>">
                            <br><br>
                            <input type="submit" name="delete" value="Delete">
                        </form> 
                        <header>
                            <h1><?php echo $singlePost['title'] ?></h1>

                            <!-- zameniti privremenu kategoriju pravom kategorijom blog post-a iz baze -->
                            <h3>category: <strong><?php echo $singlePost['category']?></strong></h3>

                            <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                            <div class="va-c-article__meta"><?php echo $singlePost['created_at']?> by <?php echo $singlePost['username']?></div>
                        </header>

                        <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
                        <div>
                            <p><?php echo $singlePost['body']?></p>
                        </div>

                        <footer>
                            <h3>tags:

                                <!-- zameniti testne tagove sa pravim tagovima blog post-a iz baze -->
                                <?php foreach($tags as $tag) { ?>
                                <a><?php echo $tag['name']?>,</a>
                                <?php } ?>
                            </h3>
                        </footer>

                        <div class="comments">
                            <h3>comments</h3>
                            <?php foreach($comments as $comment) { ?>
                                <div class="single-comment">
                                    <div>posted by: <strong><?php echo $comment['name']?> </strong> on <?php echo $comment['created_at']?>.</div>
                                    <div><?php echo $comment['text']?>
                                    </div>
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