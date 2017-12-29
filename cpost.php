<?php
session_start();

//check cookie activated

setcookie('test' , '12345' , 3600+time() , "/", "" , false , false);
if(! isset($_COOKIE['test'])){
	header("location: login.php");
	exit();
}


//check user level is 1
if(!isset($_SESSION['id']) || !isset($_COOKIE['ke']) ){
	header("location: 404page.php");
	exit();
}
if(! isset($_SESSION['admin']) && $_SESSION['admin'] != '1' ){
	$_SESSION['isadmin'] = "1";
	header('location: login.php');
	exit();
}

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

    <style>
    label {
        display: inline-block;
        text-align: right;
    }
    </style>
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
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector : "#mytext",
            height   : 400,
            width    : 700,
            //toolbar: 'undo redo | styleselect | bold italic | link image',
            plugins : 'codesample link image hr table textcolor contextmenu lists charmap preview anchor spellchecker searchreplace code textcolor',
            toolbar1  : 'undo redo styleselect bold italic forecolor backcolor alignleft aligncenter alignright charmap preview anchor spellchecker searchreplace ',
             toolbar2 :'bullist numlist outdent indent hr blockquote table tabledelete textcolor codesample code link unlink image source',
        });
    </script>
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

               
<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/admin.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Admin Page</a>
</li>

<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/cpost.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Create Post</a>
</li>

					<li class="">
						<a title="Information" id="nav_menu_info" href="http://localhost:8080/post/logout.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						Logout</a>
					</li>



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
            <div class="blog-post">





<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    define("UPLOAD_DIR", "/home/mahmud/lampstack-7.1.7-0/apache2/htdocs/post/img/");
    if (!empty($_FILES['filename']['name'])) {
        $image = $_FILES['image'];
        
        if ($image['error'] !== UPLOAD_ERR_OK) {
            echo "Error occured";
            exit;
        }
        
        $name = preg_replace("/[^A-Z0-9._-]/i", '_', $image['name'] );
        
        $i = 0;
        $parts = pathinfo($name);
        while (file_exists(UPLOAD_DIR . $name)) {
            $i++;
            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
        }
        // preserve file from temporary directory
        $success = move_uploaded_file($image["tmp_name"], UPLOAD_DIR . $name);
        if (!$success) {
            echo "<p>Unable to save file.</p>";
            exit;
        } else {
            $imageurl = UPLOAD_DIR . $name;
        }
        
        // set proper permissions on the new file
        chmod(UPLOAD_DIR . $name, 0644);
    }


        $errors = array();
    if (!empty(trim($_POST['title'])) && is_string($_POST['title'])) {
        $title = trim($_POST['title']);
    } else {
        $errors[] = "Title is missing";
    }

    if (!empty(trim($_POST['bio'])) && is_string($_POST['bio'])) {
        $bio = trim($_POST['bio']);
    } else {
        $errors[] = "Bio is missing";
    }

    if (!empty(trim($_POST['mytext'])) && is_string($_POST['mytext'])) {
        $mytext = trim($_POST['mytext']);
    } else {
        $errors[] = "Post is missing";
    }
        $errors = array_filter($errors);
    if (empty($errors)) {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO posts(title , bio , content) VALUES(:title , :bio, :content) ");
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":content", $mytext, PDO::PARAM_STR);
            $stmt->bindParam(":bio", $bio, PDO::PARAM_STR);
            $stmt->execute();
            $id = $conn->lastInsertId();

            echo "<p><h2>Post published</h2></p>";
        } catch (PDOException $e) {
            echo "error occured connecting ".$e->getMessage();
        }
    
        try {
                $conn2 = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
                $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt2 = $conn2->prepare("INSERT INTO `images`(`postid`, `imageurl`) VALUES(:postid ,:imageurl) ");
                $stmt2->bindParam(":postid", $id, PDO::PARAM_INT);
                $stmt2->bindParam(":imageurl", $imageurl, PDO::PARAM_STR);
                $stmt2->execute();
        } catch (PDOException $e2) {
            // echo "Error occured ". $e2->getMessage();
        }
    } else {
            echo "You Forgot :";
        foreach ($errors as $error) {
            echo "<br>".$error;
        }
    }
}

?>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" >
        <label for="title">Title:</label>
            <p>
                <input type="text" name="title" size="70" value="<?php if (!empty($errors) && isset($_POST['title'])) {
                    echo $_POST['title'];
} ?>" />
            </p>
            <label for="bio">Bio:</label>
            <p>
                <textarea name="bio" cols="70" rows="5" ><?php if (!empty($errors) && isset($_POST['bio'])) {
                    echo $_POST['bio'];
} ?></textarea>
            </p>
            <p>
            <label for="image">Add Image</label>
            <input type="file" name="image" />
            </p>
            <span id="form1" ></span>
            <p>
            <p>
                <textarea id="mytext" name="mytext" ><?php if (!empty($errors) && isset($_POST['mytext'])) {
                    echo $_POST['mytext'];
} ?></textarea>
            </p>
            <label for="submit" ></label>
            <input type="submit" name="submit" value="Publish Post" />
            </p>

        </form>
        </div>

        <!--div class="blog-post">
            <a href="&&**blog/2017/08/quick-guide-simple-and-secure-automatic-updates"><h2 class="blog-post-title">The Quick Guide to Simple and Secure Automatic Updates</h2></a>
            <p class="blog-post-meta">August 30, 2017 by <a href="&&**blog/author/scott-arciszewski">Scott Arciszewski</a></p>
            <p>Should your software update itself automatically? <strong>YES!</strong></p>
            <p>If you aren't convinced, we've previously <a href="&&**blog/2016/10/guide-automatic-security-updates-for-php-developers#why-automatic-updates">made the case for automatic updates</a> as a means of preventing yesterday's software vulnerabilities from being exploited today.</p>
            <p>However, as <a href="&&**blog/2016/10/guide-automatic-security-updates-for-php-developers#outdated-software-risk">our previous article on the subject</a> notes, implementing automatic updates requires a nontrivial amount of engineering effort.</p>
            <p>Our company has been hard at work for the past few years to diminish the effort required to achieve <em>secure automatic updates</em> in the PHP community. Most of our efforts are reproducible and/or relevant to any other programming stack, although <a href="https://dev.to/paragonie/php-72-the-first-programming-language-to-add-modern-cryptography-to-its-standard-library">PHP remains the first major programming language to decide to adopt modern cryptography in its standard library</a>.</p>
            <p>Let's explore how to use our existing work to build a secure automatic update system, without having to do any of the heavy lifting.</p>
                        <p class="text-center readmore-wrapper">
            <a class="btn btn-default btn-sm readmore" href="&&**blog/2017/08/quick-guide-simple-and-secure-automatic-updates#after-fold">
                Continue Reading this Blog Post »
            </a>
            </p>
    </div--><!-- /.blog-post -->
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
//$pretest = preg_replace("/[^A-Z0-9._-]/i", "_", "myname456!@#%$%^^&*()_+|\/??.php");
//echo $pretest;

//$parts = pathinfo('/home/mahmud/0#DEV/Web Development/wd book/Javascript & jquery/Eloquent.JavaScript.2nd.Edition.Dec.2014.pdf');
//echo "<pre/>";
//print_r($_FILES);

?>
