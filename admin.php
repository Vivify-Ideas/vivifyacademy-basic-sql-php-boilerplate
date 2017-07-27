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
<body class="va-l-page va-l-page--admin">
    <header class="va-l-site-header">
        <a href="index.php" class="va-c-site-logo" title="VivifyAcademy blog">
            Vivify<strong>blog</strong>
        </a>

        <nav class="va-c-site-nav">
            <a href="index.php" title="Home">Home</a>
            <a href="about.html" title="About">About</a>
            <a href="contact.html" title="Contact">Contact</a>
            <a href="admin.php" title="Admin">Admin</a>
        </nav>
    </header>

    <div class="va-l-container">
        <main class="va-l-page-content">
            <table class="va-c-table va-c-post-list">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="#" title="#">Post title</a></td>
                        <td><a href="#" title="#">Edit</a> <a href="#" title="#">Delete</a></td>
                    </tr>

                    <tr>
                        <td><a href="#" title="#">Post title</a></td>
                        <td><a href="#" title="#">Edit</a> <a href="#" title="#">Delete</a></td>
                    </tr>
                </tbody>
            </table>
            
            <header class="va-l-page-header">
                <h1>Add new post</h1>
            </header>
            
            <div class="va-c-form va-c-new-post">
                <div class="va-c-form-group">
                    <label class="va-c-control-label">Post title</label>
                    <input type="text" class="va-c-form-control">
                </div>

                <div class="va-c-form-group">
                    <label class="va-c-control-label">Post content</label>
                    <textarea rows="10" class="va-c-form-control"></textarea>
                </div>

                <div class="va-c-form-group">
                    <button class="va-c-btn va-c-btn--link">Cancel</button> or
                    <button class="va-c-btn va-c-btn--primary">Save</button>
                </div>
            </div>
        </main>
    </div>
    
    <footer class="va-l-site-footer">
        <p>Copyright &copy; 2017.</p>

        <nav>
            <a href="index.php" title="Home">Home</a>
            <a href="about.html" title="About">About</a>
            <a href="contact.html" title="Contact">Contact</a>
            <a href="admin.php" title="Admin">Admin</a>
        </nav>
    </footer>
</body>
</html>