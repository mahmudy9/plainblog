<?php
session_start();

//check cookie activated
$level = "" ;
setcookie('test' , '12345' , 3600+time() , "/", "" , false , false);
if(! isset($_COOKIE['test'])){
$cookie = "0";
}


//check user level is 1
 if (isset($_SESSION['id']) && isset($_COOKIE['ke']) ){
    $id = $_SESSION['id'];
    try{

        $conn = new PDO("mysql:host=localhost;dbname=test" , "root" , "123456");
        $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare(" SELECT * FROM users WHERE (id = '$id' ) ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result['level'] == 1){
                $level = "1";
            }elseif($result['level']== 0){
                $level = "0";
            }
    }catch(PDOException $e){
        echo "error occured" . $e->getMessage();
    }
    $conn = null;
}
 elseif (isset($_COOKIE['ke'])) {
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
            if($result2['level'] == 1){
                $level = "1";
            }elseif($result['level']== 0){
                $level = "0";
            }
		}
		}
	} catch (PDOException $e) {
		echo "error occured".$e->getMessage();
    }
    		$conn = null;

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

                    <!--li class="">
                        <a title="Services" href="&&**blog#" id="nav_menu_services" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Bloggers
                        </a>
                    </li-->

<?php
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
        <h2>About Paragon Initiative Enterprises</h2>
        <h4>"Technology should support your ambitions, not hinder them"</h4>
    </div>
    </div>
</div>

    <!-- Intro Content -->
    <div id="commitment" class="row fathead featurette expborder">
        <div class="col-md-6 exptext">
            <h2>What We Can Do For Your Business</h2>
            <p class="lead">
                Your customers trust you. Let our team help protect
                them, and your reputation from online threats.
            </p>
            <p>
                Paragon Initiative Enterprises is the home of leading
                industry experts in <strong>secure PHP development</strong>.
            </p>
            <p>
                Our specialties include applied cryptography and web 
                application security.
            </p>
            <p>
                Paragon Initiative Enterprises offers dependable and <a href="https://paragonie.com/service/web-development">secure
                web-based business solutions</a> to help your business prevent 
                <a href="https://paragonie.com/white-paper/2015-why-invest-application-security">costly
                data breaches</a>.
            </p>
            <p>
                In addition to code review and penetration testing services, we
                leverage our unique access to security and cryptography talent to
                develop robust, defensible solutions to real world business challenges.
            </p>
        </div>
        <div class="col-md-6">
            <img class="img-responsive exptext" src="img/secure_php.png" alt="">
        </div>
    </div>
    
    <hr class="featurette-divider">
    

    <!-- Intro Content -->
    <div id="commitment" class="row fathead featurette expborder">
        <div class="col-md-6">
            <img class="img-responsive exptext" src="img/apps.jpg" alt="">
        </div>
        <div class="col-md-6 exptext">
            <h2>Our Commitment</h2>
            <p>
                We are committed to building platforms that are efficient,
                <em>secure</em>, easy-to-use, and maintainable. We build upon
                the excellence and resilience of open source software and
                contribute <a href="https://paragonie.com/projects">our innovations back to the
                community</a>.
            </p>
            <p>
                <strong>We pursue excellence</strong> in every facet of
                technology and business. We tackle hard problems and create
                <em>simple solutions</em> to save your business time and
                money while reducing the cognitive load for your team.
            </p>
            <p>
                We believe that <strong>technology should serve your interests</strong>,
                not hinder your company's growth or introduce unnecessary risk.
                We develop software with attention to <a href="https://paragonie.com/service/appsec">security 
                above and beyond compliance</a>.
            </p>
        </div>
    </div>
    
    <hr class="featurette-divider">
    
    <div id="who" class="row fathead featurette expborder">
        <div class="col-md-6 exptext">
            <h2>Who We Are</h2>
            <p>
                Paragon Initiative Enterprises is a Florida-based technology
                company that specializes in software development, application
                security, cryptographic engineering, and business consulting.
            </p>
            <p>
                Our <a href="https://paragonie.com/service/technology-consulting">technology consultants</a>
                have an extensive history of innovative security research and 
                professional software development. We have worked with clients
                in the telecommunications, health care,
                and consumer electronics industries.
            </p>
            <p>
                We offer a plethora of professional services, ranging from
                <a href="https://paragonie.com/service/web-development">web development</a> and
                <a href="https://paragonie.com/service/app-dev">mobile/desktop application development</a>
                to <a href="https://paragonie.com/service/code-review">source code auditing</a> and
                building custom <a href="https://paragonie.com/service/business-intelligence">
                business intelligence solutions</a>.
            </p>
        </div>
        <div class="col-md-6">
            <img class="img-responsive exptext" src="img/picode.png" alt="">
        </div>
    </div>
    
<hr class="pagebreak">
    <div class="row row-centered">
    <div class="col-md-2 col-centered">
        <a class="btn btn-success btn-block" href="https://paragonie.com/experience/">Our Experience</a>
    </div>
    <div class="col-md-2 col-centered">
        <a class="btn btn-warning btn-block" href="https://paragonie.com/contact/">Contact Us Today</a>
    </div>
</div>
        
</div>

    <div class="row">
        <div class="col-sm-8">
          
        
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