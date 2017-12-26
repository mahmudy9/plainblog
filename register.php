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
   <style>
    label{
        display:inline-block;
        width : 150px;
        text-align: right;
    }
   </style>
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
        <div class='blog-post'>

        <h1>Register Page</h1>
                                              
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = array();
            if (!empty(trim($_POST['name'])) && is_string($_POST['name']) && strlen($_POST['name']) >= 6) {
                $name = trim($_POST['name']);
            } else {
                $errors[] = "Name is missing";
            }
            if (!empty(trim($_POST['email'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = trim($_POST['email']);
            } else {
                $errors[] = "Email is missing";
            }
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if ($password1 == $password2) {
                if (!empty(trim($password1))) {
                    if (strlen($password1) >= 6) {
                        $password = password_hash($password1, PASSWORD_DEFAULT );
                    } else {
                        $errors[] = "Your password is less than 10 charachters";
                    }
                } else {
                    $errors[] = "Password is missing";
                }
            } else {
                $errors[] = "the passwords don't match";
            }
            try {
                $conn2 = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
                $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt2 = $conn2->prepare("SELECT * FROM users WHERE email = '$email' ");
                $stmt2->execute();
                $result = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    $errors[] = "Sorry error occured please try again";
                }
            } catch (PDOException $e) {
                echo "error connecting ". $e->getMessage();
            }


            if (!empty($errors)) {
                echo "Errors : <br>";
                foreach ($errors as $error) {
                    echo "- ".$error."<br>";
                }
            } else {
                try {
                    $conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("INSERT INTO users(name , email , password) VALUES(:name , :email , :password)");
                    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $password, PDO::PARAM_STR);
                    $stmt->execute();
                    if ($stmt) {
                        echo "user registered";
                    }
                } catch (PDOException $e) {
                    echo "error connecting ". $e->getMessage();
                }
            }
        }
    ?>

          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" >
          <p>
                            <label for="name" >Name: </label>
                            <input type="text" name="name" value="<?php if (isset($_POST['name'])) {
                                echo $_POST['name'];
} ?>" />
                            </p>
                            <p>
                            <label for="email" >Email: </label>
                            <input type="text" name="email" value="<?php if (isset($_POST['email'])) {
                                echo $_POST['email'];
} ?>" />
                            </p>
                            <p>
                            <label for="password1">Password: </label>
                            <input type="password" name="password1" />
                            </p>
                            <p>
                            <label for="password2">Repeat Password: </label>
                            <input type="password" name="password2" />
                            </p>
                           
                            <p>
                            <label for="submit" ></label>
                            <input type="submit" name="submit" value="Register" />
                            </p>
          </form>
      
        </div>
        <!-- /.blog-main -->
        </div>

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
   