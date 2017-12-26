<?php
session_start();

//check cookie activated
$level = "" ;
setcookie('test' , '12345' , 3600+time() , "/", "" , false , false);
if(! isset($_COOKIE['test'])){
$level = "";
}


//check user level is 1
 if (isset($_COOKIE['ke'])) {
	$keep = $_COOKIE['ke'];
	try {
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare(" SELECT * FROM sessions WHERE (hash = :hash) ");
		$stmt->bindParam(':hash' , $keep , PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION = $result;
			$id = $result['user_id'];
			$stmt2= $conn->prepare("SELECT * FROM users WHERE (id = '$id')");
			$stmt2->execute();
			if($stmt2->rowCount() == 1){
			$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION = $result2;
            if($result2['level'] == 1){
                $level = "1";
            }elseif($result['level']== 0){
                $level = "0";
            }
		}
		}
		$conn = null;
	} catch (PDOException $e) {
		echo "error occured".$e->getMessage();
	}
}elseif (! isset($_SESSION['level']) ) {
	$level = "";
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

<?php
/*
if (isset($_COOKIE['ke'])) {
    $keep = $_COOKIE['ke'];
    
    try {
        $conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM sessions WHERE (hash = '$keep') ");
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result['user_id'];
            $stmt2 = $conn->prepare("SELECT * FROM users WHERE ( id ='$id'  )");
            $stmt2->execute();
            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION = $result2;
            $conn = null;
        } else {
            return;
        }
    } catch (PDOException $e) {
        echo "error occured connecting ".$e->getMessage();
    }
    session_regenerate_id(true);
    
    //echo $_SESSION['expire'];
  */  
  if($level == '1'){

  
    echo <<<EOD


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
    Log out</a>
</li>



EOD;
    }elseif($level == '0'){
        echo <<<EOD
    
<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/logout.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Log out</a>
</li>



EOD;
    }elseif($level == ""){
           echo <<<EOD
    
<li class="">
    <a title="Information" id="nav_menu_info" href="http://localhost:8080/post/login.php" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Log in</a>
</li>



EOD;
    
    }
/*} else {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), "", time()-3600, $params['path'], $params['domain'], $params['secure'], $params['httponly'] );

    setcookie("ke", "", time()-3600, "/", "", 0, 1 );
    session_destroy();
}*/
?>

                                        <li><a title="About" href="http://localhost:8080/post/about.php">About</a></li>
                    <li class="">
                        <a title="contact" href="http://localhost:8080/post/contact.php" id="nav_menu_security" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
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
    $stmt = $conn->prepare("SELECT * FROM posts ");
    $stmt->execute();

    while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $results['id'] ;
        $title = htmlspecialchars($results['title']);
        $bio = htmlspecialchars($results['bio']);
        $createdAt = $results['created_at'];

        echo <<<EOD
        <div class='blog-post'>
        
        <a href='http://localhost:8080/post/post.php?id=$id'><h2 class='blog-post-title'> $title</h2></a>
        <p class='blog-post-meta'>$createdAt by <a href='http://localhost:8080/post/about.php'>Moody</a></p>
        <p>$bio</p>
</div>
EOD;
    $conn = null;
    }
} catch (PDOException $e) {
    echo "error occured" . $e->getMessage();
}


        ?>

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
