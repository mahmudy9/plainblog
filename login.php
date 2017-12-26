<?php
setcookie('test' , '12345' , 3600+time() , "/", "" , false , false);
session_start();
if ( isset($_SESSION['level'])) {
	header("location: index.php");
	exit();
} elseif (isset($_COOKIE['ke'])) {
	$keep = $_COOKIE['ke'];
	try {
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare(" SELECT * FROM sessions WHERE (hash = :hash) ");
		$stmt->bindParam(':hash' , $keep , PDO::PARAM_STR);
		$stmt->execute();
		$conn= null;
		if ($stmt->rowCount() == 1) {
			header("location: index.php");
			exit();
		}
	} catch (PDOException $e) {
		echo "error occured".$e->getMessage();
	}
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
	<style>
		label{
			display: inline-block;
			width: 150px;
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
		<div class="blog-post">
<?php
		$site_key = "Mttgk7+qKW[7b]}t_{Jm}qHu3`;u>/$6{n\A8#m8#wm['RgAbdjkN_fv;_~;`A^)L?C[}9D5%[?<HNG5gTW5:#r5jgY*a<49D[^3WLmH4d?_P\K/g6,VbZ&A\%6.T";
	   
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
		   
			$errors = array();
			if(!isset($_COOKIE['test'])){
			$errors[] = "please enable cookies";
 }
			if (!empty(trim($_POST['email'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$email = trim($_POST['email']);
			} else {
				$errors[] = "Email is missing";
			}
			if (!empty(trim($_POST['password']))) {
				$password = $_POST['password'];
			} else {
				$errors[] = "Password is missing";
			}
			if (isset($_POST['keepme'])) {
				$keep = $_POST['keepme'];
			}
			
			if (empty($errors)) {
				try {
					$conn = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare(" SELECT * FROM users WHERE (email = '$email') ");
					$stmt->execute();
					if ($stmt->rowCount() == 1) {
						$result = $stmt->fetch(PDO::FETCH_ASSOC);

						if (password_verify( $password, $result['password'])) {
							$agent = $_SERVER['HTTP_USER_AGENT'];
							$ip = $_SERVER['REMOTE_ADDR'];
							$stmt3 = $conn->prepare("DELETE FROM sessions WHERE (agent = '$agent' AND ip = '$ip' )");
							$stmt3->execute();
						
								$_SESSION = $result;
								$_SESSION['hash'] = hash('sha512', $site_key.session_id().microtime());
								$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
								$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
							if (isset($keep) && $keep == 1) {
								$_SESSION['expire'] = date("Y-m-d H:i:s", strtotime('+14 days'));
							}

								$stmt4 = $conn->prepare("INSERT INTO sessions(user_id, hash, ip, agent, expire) VALUES(:user_id , :hash , :ip, :agent, :expire) ");
								$stmt4->bindParam(":user_id", $_SESSION['id'], PDO::PARAM_INT);
								$stmt4->bindParam(":hash", $_SESSION['hash'], PDO::PARAM_STR);
								$stmt4->bindParam(":ip", $_SESSION['ip'], PDO::PARAM_STR);
								$stmt4->bindParam(":agent", $_SESSION['agent'], PDO::PARAM_STR);
								$stmt4->bindParam(":expire", $_SESSION['expire'], PDO::PARAM_STR);
								$stmt4->execute();
								$conn = null;
							if ($stmt4) {
									$expire = strtotime($_SESSION['expire']);
									setcookie("ke", $_SESSION['hash'], $expire, "/", "", 0, 1);
								header("location: index.php");
								exit();
							} else {
								$errors[] = "error occured";
							}
						} else {
							$errors[] = "password or email is wrong";
						} 
					}else {
						$errors[] = "password or email is wrong";
					}
				} catch (PDOException $e) {
					echo "error connecting ". $e->getMessage();
				}
			}
		}
		

		if (!empty($errors)) {
			echo "Errors:";
			foreach ($errors as $error) {
				# code...
				echo "<br>- ".$error;
			}
		}
	//print_r($result);
?>

		  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" >
							<p>
							<label for="email" >Email: </label>
							<input type="text" name="email" size="40" value="<?php if (isset($_POST['email'])) {
								echo $_POST['email'];
} ?>" />
							</p>
							<p>
							<label for="password">Password: </label>
							<input type="password" size="40" name="password" />
							</p>
						   <p><label for="keepme" >Keep me logged in:</label> 
						   <input type="checkbox" name="keepme" value="1" />
						   </p>
							<p>
							<label for="submit" ></label>
							<input type="submit" style="width:120px" name="submit" value="Log in" />
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
   