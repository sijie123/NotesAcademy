<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>NotesAcademy | Sign Up</title>
		<meta name="description" content="The Project a Bootstrap-based, Responsive HTML5 Template">
		<meta name="author" content="htmlcoder.me">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="css/animations.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="plugins/hover/hover-min.css" rel="stylesheet">		

		<!-- the project core CSS file -->
		<link href="css/style.css" rel="stylesheet" >

		<!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
		<link href="css/skins/light_blue.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
		
<script>
	function signup() {
		if ($("#pass").val() != $("#pass2").val()) {
			$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> Your passwords don't match. Please try again.</div>");
		
			return false;
		}
		if (!$("#check").is(":checked")) {
			$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> You need to accept our terms of use...</div>");
			return false;		
		}
		$.ajax({
        url: "signprocess.php",
        type: "POST",
        data: $("#contr").serialize(),
        success: function( data ) {
        	var arr =jQuery.parseJSON(data);
        	//var arr = data.split('/');
        	
            if (arr.code == 1) {
            	//Handle
            	$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> Please ensure that you fill in all required fields and try again.</div>");
            }
            else if (arr.code == 2) {
            	$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> Username already exists. Please try another one.</div>");
            }
            else if (arr.code == 3) {
            	$("#replace").html("<div class='alert alert-warning object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> Passwords don't match. Please check and try again.</div>");
            }
            else if (arr.code == 0) {
            	$("#m").html("<div class='alert alert-success object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> Thank you for being part of the team! We're really excited that you're here, but before you can start using NotesAcademy, you need to activate your account with the code in your email. We hope to see you soon! </div>");
            //	$("#contr").reset();
            	
            }
            else if (arr.code == 4) {
            	$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> There is an error with the server. Please <a href='contact.php' class='alert-link'>contact us</a> or try again later.</div>");

            }
            else if (arr.code == 5) {
            	$("#replace").html("<div class='alert alert-danger object-non-visible animated object-visible' data-animation-effect='zoomIn' data-effect-delay='1000' role='alert'> For security reaons, your registration cannot be accepted. If you think this was in error, please <a href='contact.php' class='alert-link'>contact us</a></div>");
            }
        }
    });
    	return false;
	}
</script>
	</head>

	<!-- body classes:  -->
	<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
	<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
	<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
	<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
	<body class="no-trans   ">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<!-- header-container start -->
			<?php
			$m = "signup";
			include "mysql.php";
			include "menu.php";
			?>
			<!-- breadcrumb start -->
			<!-- ================ -->
			<div class="breadcrumb-container">
				<div class="container">
					<ol class="breadcrumb">
						<li><i class="fa fa-home pr-10"></i><a href="index.html">Home</a></li>
						<li class="active">Page Sign Up</li>
					</ol>
				</div>
			</div>
			<!-- breadcrumb end -->

			<!-- main-container start -->
			<!-- ================ -->
			<div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div class="form-block center-block p-30 light-gray-bg border-clear" name="m" id="m">
								<h2 class="title">Sign Up</h2>
								<div class="m" name="m">
								<form enctype="multipart/form-data" name="contr" class="form-horizontal" id="contr" onsubmit="return signup();">
									<div name="replace" id="replace"></div>
									<div class="form-group has-feedback">
										<label for="name" class="col-sm-3 control-label">First Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
								<label for="sch" class="col-sm-3 control-label">School <span class="text-danger small">*</span></label>
								<div class="col-sm-8">
								<select name="sch" id="sch" class="form-control" required>
									<?php
									$q = $conn->query("SELECT id,value FROM meta WHERE type='school' ORDER BY value ASC");
									while ($r = mysqli_fetch_assoc($q)) {
										echo "<option value='" . $r['id'] . "'>" . $r['value'] . "</option>";
									}
									?>
								</select>
						<!--		<i class="fa fa-graduation-cap form-control-feedback"></i> -->
								</div>
								</div>
									<div class="form-group has-feedback">
										<label for="lvl" class="col-sm-3 control-label">Level <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<select name="level" id="level" class="form-control" required>
											<?php
											$q = $conn->query("SELECT id,value FROM meta WHERE type='level' ORDER BY value ASC");
											while ($r = mysqli_fetch_assoc($q)) {
												echo "<option value='" . $r['id'] . "'>" . $r['value'] . "</option>";
											}
											?>
										</select>
						<!--					<i class="fa fa-child form-control-feedback"></i> -->
										</div>
									</div>
								<!--	<div class="form-group has-feedback">
										<label for="inputUserName" class="col-sm-3 control-label">Username <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputUserName" name="inputUserName" placeholder="Username" required>
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									-->
									<div class="form-group has-feedback">
										<label for="email" class="col-sm-3 control-label">Email <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" id="email" name="email" placeholder="No spam, we promise." required>
											<i class="fa fa-envelope form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="user" class="col-sm-3 control-label">Username <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="user" name="user" placeholder="Username" required>
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="pass" class="col-sm-3 control-label">Password <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="pass" name="pass" placeholder="Your most secure password please." required>
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="pass2" class="col-sm-3 control-label">Password Again<span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="pass2" name="pass2" placeholder="One more time, just to confirm." required>
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="check" id="check" required>Didn't read but I'll accept your <a href="#">Terms of Use</a>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<button class="btn btn-group btn-default btn-animated">Sign Up <i class="fa fa-check"></i></button>
										</div>
									</div>
								</form>
								</div>
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			<!-- main-container end -->
			
			<!-- footer top start -->
			<!-- ================ -->
			<div class="dark-bg  default-hovered footer-top animated-text">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action text-center">
								<div class="row">
									<div class="col-sm-8">
										<h2>Powerful Bootstrap Template</h2>
										<h2>Waste no more time</h2>
									</div>
									<div class="col-sm-4">
										<p class="mt-10"><a href="#" class="btn btn-animated btn-lg btn-gray-transparent ">Purchase<i class="fa fa-cart-arrow-down pl-20"></i></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer top end -->
			
			<!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
			<!-- ================ -->
			<footer id="footer" class="clearfix ">

				<!-- .footer start -->
				<!-- ================ -->
				<div class="footer">
					<div class="container">
						<div class="footer-inner">
							<div class="row">
								<div class="col-md-3">
									<div class="footer-content">
										<div class="logo-footer"><img id="logo-footer" src="images/logo_light_blue.png" alt=""></div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus illo vel dolorum soluta consectetur doloribus sit. Delectus non tenetur odit dicta vitae debitis suscipit doloribus. Ipsa, aut voluptas quaerat... <a href="page-about.html">Learn More<i class="fa fa-long-arrow-right pl-5"></i></a></p>
										<div class="separator-2"></div>
										<nav>
											<ul class="nav nav-pills nav-stacked">
												<li><a target="_blank" href="http://htmlcoder.me/support">Support</a></li>
												<li><a href="#">Privacy</a></li>
												<li><a href="#">Terms</a></li>
												<li><a href="page-about.html">About</a></li>
											</ul>
										</nav>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">Latest From Blog</h2>
										<div class="separator-2"></div>
										<div class="media margin-clear">
											<div class="media-left">
												<div class="overlay-container">
													<img class="media-object" src="images/blog-thumb-1.jpg" alt="blog-thumb">
													<a href="blog-post.html" class="overlay-link small"><i class="fa fa-link"></i></a>
												</div>
											</div>
											<div class="media-body">
												<h6 class="media-heading"><a href="blog-post.html">Lorem ipsum dolor sit amet...</a></h6>
												<p class="small margin-clear"><i class="fa fa-calendar pr-10"></i>Mar 23, 2015</p>
											</div>
											<hr>
										</div>
										<div class="media margin-clear">
											<div class="media-left">
												<div class="overlay-container">
													<img class="media-object" src="images/blog-thumb-2.jpg" alt="blog-thumb">
													<a href="blog-post.html" class="overlay-link small"><i class="fa fa-link"></i></a>
												</div>
											</div>
											<div class="media-body">
												<h6 class="media-heading"><a href="blog-post.html">Lorem ipsum dolor sit amet...</a></h6>
												<p class="small margin-clear"><i class="fa fa-calendar pr-10"></i>Mar 22, 2015</p>
											</div>
											<hr>
										</div>
										<div class="media margin-clear">
											<div class="media-left">
												<div class="overlay-container">
													<img class="media-object" src="images/blog-thumb-3.jpg" alt="blog-thumb">
													<a href="blog-post.html" class="overlay-link small"><i class="fa fa-link"></i></a>
												</div>
											</div>
											<div class="media-body">
												<h6 class="media-heading"><a href="blog-post.html">Lorem ipsum dolor sit amet...</a></h6>
												<p class="small margin-clear"><i class="fa fa-calendar pr-10"></i>Mar 21, 2015</p>
											</div>
											<hr>
										</div>
										<div class="media margin-clear">
											<div class="media-left">
												<div class="overlay-container">
													<img class="media-object" src="images/blog-thumb-4.jpg" alt="blog-thumb">
													<a href="blog-post.html" class="overlay-link small"><i class="fa fa-link"></i></a>
												</div>
											</div>
											<div class="media-body">
												<h6 class="media-heading"><a href="blog-post.html">Lorem ipsum dolor sit amet...</a></h6>
												<p class="small margin-clear"><i class="fa fa-calendar pr-10"></i>Mar 21, 2015</p>
											</div>
										</div>
										<div class="text-right space-top">
											<a href="blog-large-image-right-sidebar.html" class="link-dark"><i class="fa fa-plus-circle pl-5 pr-5"></i>More</a>	
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">Portfolio Gallery</h2>
										<div class="separator-2"></div>
										<div class="row grid-space-10">
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-1.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-2.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-3.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-4.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-5.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-4 col-md-6">
												<div class="overlay-container mb-10">
													<img src="images/gallery-6.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="text-right space-top">
											<a href="portfolio-grid-2-3-col.html" class="link-dark"><i class="fa fa-plus-circle pl-5 pr-5"></i>More</a>	
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">Find Us</h2>
										<div class="separator-2"></div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium odio voluptatem necessitatibus illo vel dolorum soluta.</p>
										<ul class="social-links circle animated-effect-1">
											<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
											<li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
											<li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
											<li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
											<li class="xing"><a target="_blank" href="http://www.xing.com"><i class="fa fa-xing"></i></a></li>
										</ul>
										<div class="separator-2"></div>
										<ul class="list-icons">
											<li><i class="fa fa-map-marker pr-10 text-default"></i> One infinity loop, 54100</li>
											<li><i class="fa fa-phone pr-10 text-default"></i> +00 1234567890</li>
											<li><a href="mailto:info@theproject.com"><i class="fa fa-envelope-o pr-10"></i>info@theproject.com</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .footer end -->

				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="subfooter-inner">
							<div class="row">
								<div class="col-md-12">
									<p class="text-center">Copyright © 2015 The Project by <a target="_blank" href="http://htmlcoder.me">HtmlCoder</a>. All Rights Reserved</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->
			
		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		
		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>
		
		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="plugins/jquery.validate.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
		
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="plugins/jquery.browser.js"></script>
		<script type="text/javascript" src="plugins/SmoothScroll.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>
	</body>
</html>
