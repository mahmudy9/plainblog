

<?php

if (isset($_GET['id'])) {
    if (is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        ?>
        




<!DOCTYPE html>
<!-- saved from url=(0026)&&**blog -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="alternate" title="RSS Feed for the Paragon Initiative Enterprises Blog" href="&&**rss/" type="application/rss+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="&&**favicon.ico">

    <title>Blogger discover and share ideas</title>


    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="icon" type="image/png" href="logo.png">
    <link href="css/Envy.css" rel="stylesheet">
    <link href="css/Components.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/github.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
   
</head>

<body>
    <header>
    <nav class="navbar navbar-inverse navbar-fixed-top btn-glass navbar-trans">
        <div class="container" id="top-container">
            <div class="navbar-header">

                <a class="navbar-brand" href="&&">
                    <img alt="Blogger discover and share ideas" id="logo" src="img/logo.png" title="Blogger discover and share ideas">
                </a>
                <p class="navbar-text"><a title="Blogger discover and share ideas" href="&&" class="white"> Blogger </a></p>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right uppercase">
                    <li class="">
                        <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/index.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Home</a>
                    </li>

                    <!-- Newsfeed when logged in -->

                    <!--li class="">
                        <a title="Services" href="&&**blog#" id="nav_menu_services" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Bloggers
                        </a>
                    </li-->

                    <?php
//require_once("session_handle.php");
                    session_start();
                    if (isset($_SESSION['level']) && $_SESSION['level'] == 1) {
                        session_regenerate_id();
                        if (isset($_SESSION['expire'])) {
                            $expire = strtotime($_SESSION['expire']);
                            setcookie("keepme", $_SESSION['hash'], $expire, "/", "", 0, 1);
                        }
                        //echo $_SESSION['expire'];
    
                                        echo <<<EOD


<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/admin.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Admin Page</a>
</li>

<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/cpost.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Create Post</a>
</li>
    

EOD;
                    }
?>


                                        <li><a title="Community Projects" href="http://localhost:8080/post/about.php">About</a></li>
                    <li class="">
                        <a title="Community" href="http://localhost:8080/post/contact.php" id="nav_menu_security" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Contact
                        </a>
                    </li>
                    <!-- notification icon -->
                    <!-- display user dropdown (logout , myposts , myprofile , create-post) -->
                    <!--li><a title="Our Blog" href="&&**blog">Log in</a></li>
                    <li><a title="Contact Us" href="&&**contact">Sign up</a></li-->
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <!-- End Navbar -->

    </header>

    <div class="wallpaper">
    <div class="container container-fluid">
            <div class="header">
        <div class="row row-centered">
            <div class="col-lg-12 text-left">
                <h2>Paragon Initiative Enterprises Blog</h2>
                <h4>The latest information from the team that develops cryptographically secure PHP software.</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-8">
          
            
        <?php

        try {
                $conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM posts WHERE id = $id ");
                $stmt->execute();
                $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$results) {
                echo "<center><h2>404 error page not found</h2></center>";
                exit;
            } else {
                //while($results = $stmt->fetch(PDO::FETCH_ASSOC)){

                //$id = $results['id'] ;
                $title = htmlentities($results['title']);
                $bio = htmlentities($results['bio']);
                $createdAt = $results['created_at'];
                $content = htmlentities($results['content']);

                echo <<<EOD
        <div class='blog-post'>
        <h2 class='blog-post-title'>$title</h2>
        <p class='blog-post-meta'>$createdAt by <a href='http://localhost:8080/post/about.php'>Moody</a></p>
        <p>$content</p>
</div>
EOD;
                      //                      }
            }
        } catch (PDOException $e) {
            echo "error occured" . $e->getMessage();
        }


        ?>

        </div>
        <!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

            <div class="sidebar-module" id="blog_menu">
                <h4>Archives</h4>
                <ol class="list-unstyled" id="blog_menu_dates">                    <li class="blog_year">
                        <a href="&&**blog/2017"><i class="fa fa-calendar"></i> 2017</a>
                        <ul>                            <li class="blog_month"><a href="&&**blog/2017/01"><i class="fa fa-clock-o"></i> January 2017</a></li>
                                                        
                            </ul>
                    </li>           
                    </ol>
            </div>
            <div class="sidebar-module">
                <h4>Blog Categories</h4>
                <ol class="blog_categories list-unstyled">
                     <li>
    <a href="&&**blog/category/business"><i class="fa fa-folder"></i> Business</a>
    </li>
  <li>
    <a href="&&**blog/category/paragon-initiative"><i class="fa fa-folder-open"></i> Paragon Initiative</a>
           
     </ol>
    </li>
            </div>
           
        </div>
        <!-- /.blog-sidebar -->

    </div>
    <!-- /.row -->

    <hr class="pagebreak">
                    
            </div>
        </div>
    <!-- Start Footer -->
    <footer class="footer">
    </footer>
    <!-- /container -->

</body>
</html>
<?php
    } else {
        echo "<center><h2>404 error page not found</h2></center>";
    }
} else {
    echo "<center><h2>404 error page not found</h2></center>";
}

?>