<?php
    include('db.php');


    if(isset($_POST['submit'])) {
        $body = $_POST['body'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        if(empty($body) || empty($title) || empty($category) || empty($content)) {
            echo("Nisu svi podaci popunjeni");
        } else {
            $currentDate = date('Y-m-d h:i');
            $sql = "INSERT INTO posts (title, body, content, category, user_id, created_at, updated_at, published)
            VALUES('$title', '$body', '$content', '$category', 1, '$currentDate', '$currentDate', 0)";

            $statement = $connection->prepare($sql);
            $statement->execute();

            header("Location: ./index.php");
        
        }

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

<?php
    include('header.php');
    ?>
    <div class="form-wrapper">
    <h1 class="c-p-title"> Create new post </h1>
    <form action="create-post.php" method="POST" id="postsForma">
        <ul class="flex-outer">
            <li>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter title">
            </li>
            <li>
                <label for="category">Category</label>
                <input type="text" name="category" id="category" placeholder="Enter Category">
            </li>
            <li>
                <label for="email">content</label>
                <textarea name="content" placeholder="Enter content" rows="10" id="bodyPosts"></textarea><br>
            </li>
            <li>
                <label for="email">Body</label>
                <textarea name="body" placeholder="Enter body" rows="10" id="bodyPosts"></textarea><br>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
</div>
<?php
    include('footer.php');

    ?>
?>