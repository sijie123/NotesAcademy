<?php
include "common.php";
if (!isset($_GET['id'])) {
    header("Location: index.php");
    die();
}
$id = $conn->real_escape_string($_GET['id']);
$q = $conn->query("SELECT * FROM notes LEFT JOIN meta AS a ON notes.sch=a.id LEFT JOIN meta AS b ON notes.level = b.id WHERE notes.id = $id");
if ($q->num_rows == 0) {
    header("Location: 404.php");
}
else {
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>The Project | Page About Me</title>
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
    function pass() {
        var px = $("#passw").val();
        var ix = $('#id').val();
		$.ajax({
        url: "verifypass.php",
        type: "POST",
        data: { pass: px, id: ix },
        success: function( data ) {
            var arr = JSON.parse(data);
        	if (arr != 'ERR') {
        	    
        	    $('#pass').html("<iframe src='http://docs.google.com/gview?url=http://dev.sijie123.xyz/"+arr+"&embedded=true' style='width:100%; height:600px;' frameborder='0'></iframe>");
        	    $('#dl').html("<a href='dl.php?id="+ix+"&p="+px+"' class='btn btn-animated btn-lg btn-primary'>Download<i class='fa fa-download pl-20'></i></a>");
        	    console.log("test");
        	}
        	else {
        	    $('#prot').html("<h5>This file is password protected. Please try again.</h5>")
        	    console.log("tes2t");
        	}
        }
    });
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
		
			<?php
			$m = "view";
			include "menu.php";
			?>


			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title"><?php $r = $q->fetch_assoc(); echo $r['title'];?></h1>
							<div class="separator-2"></div>
							<?php if ($r['password'] != "") { echo "<div id='prot'><h5>This file is password protected.</h5></div>"; } ?>
							<!-- page-title end -->
							<div class="row">
							    <div class="col-lg-8 col-sm-12">
							        			
<?php
    
    if ($r['password'] != "") {
        echo "<div id='pass'>";
        echo "<input type='hidden' id='id' name='id' value='".$id."'></input>";
        echo "<input type='text' class='form-control' id='passw' name='passw' placeholder='Please enter password' required></input>";
        echo "<button class='btn btn-default' onclick='pass()'>Submit</button>";
        echo "</div>";
    }
    else {
        $url = $r['servername'];
        echo "<iframe src='http://docs.google.com/gview?url=http://dev.sijie123.xyz/test.pdf&embedded=true' style='width:100%; height:600px;' frameborder='0'></iframe>";
//        echo "<iframe src='http://docs.google.com/gview?url=http://www.notesacademy.org/uploads/".$url."' style='width:100%; height:600px;' frameborder='0'></iframe>";
    }
}
?>
							    </div>
								<div class="col-lg-4">
								    <?php
								    echo "Date Uploaded: " . $r['dateul'] . "<br>";
								    if ($r['a.type'] == "school" && $r['b.type'] == "level") {
								    	echo "School: " . $r['a.value'] . " " . $r['b.value'] . "<br>";
								    }
								    else {
								    	
								    }
								    
								    echo "Downloads: ". $r['dl'] . "<br>";
								    if ($r['password'] == "") {
								        echo "<div id='dl'><a href='dl.php?id=".$id."&p=' class='btn btn-animated btn-lg btn-primary'>Download<i class='fa fa-download pl-20'></i></a></div>";
								    }
								    else {
								        echo "<div id='dl'><a href='#' class='btn btn-lg btn-warning'>Protected<i class='fa fa-times pl-20'></i></a></div>";
								    }
							 ?>
								</div>
						<!--		<div class="col-lg-4 col-sm-5">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus nam, vitae autem quis, deserunt pariatur! At, atque inventore.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam esse laudantium maiores aperiam illo fugit laboriosam velit repellendus quod cumque ea vero vitae quo enim fugiat itaque harum assumenda aut quis, dolore. Sit reiciendis eligendi, recusandae eaque est optio reprehenderit!</p>
									<div class="progress style-2 dark">
										<span class="text"></span>
										<div class="progress-bar progress-bar-white" role="progressbar" data-animate-width="95%">
											<span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">CSS</span>
										</div>
									</div>
									<div class="progress style-2 dark">
										<span class="text"></span>
										<div class="progress-bar progress-bar-white" role="progressbar" data-animate-width="85%">
											<span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">HTML5</span>
										</div>
									</div>
									<div class="progress style-2 dark">
										<span class="text"></span>
										<div class="progress-bar progress-bar-white" role="progressbar" data-animate-width="95%">
											<span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">Design</span>
										</div>
									</div>
									<div class="progress style-2 dark">
										<span class="text"></span>
										<div class="progress-bar progress-bar-white" role="progressbar" data-animate-width="80%">
											<span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">PHP</span>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-lg-offset-1">
									<h3 class="title">Contact Me</h3>
									<ul class="list-icons">
										<li><i class="fa fa-phone pr-10 text-default"></i> +00 1234567890</li>
										<li><i class="fa fa-mobile pr-10 text-default"></i> +00 1234567890</li>
										<li><a href="mailto:info@janedoe.com"><i class="fa fa-envelope-o pr-10"></i>info@janedoe.com</a></li>
									</ul>
									<h3>Follow Me</h3>
									<div class="separator-2"></div>
									<a target="_blank" href="https://www.linkedin.com" class="btn btn-animated linkedin btn-sm">Linkedin<i class="pl-10 fa fa-linkedin"></i></a>
									<a target="_blank" href="https://www.xing.com/" class="btn btn-animated xing btn-sm">Xing<i class="fa fa-xing"></i></a>
									<h3>See My Portfolio</h3>
									<a class="btn btn-gray collapsed btn-animated" data-toggle="collapse" href="#collapseContent" aria-expanded="false" aria-controls="collapseContent">Click Me <i class="fa fa-plus"></i></a>
								</div>
							</div>-->

						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->

			<!-- section start -->
			<!-- ================ -->
			<section id="collapseContent" class="collapse pv-20 light-gray-bg clearfix">
				<div class="container">
					<h3>Latest <strong>Projects</strong></h3>
					<div class="separator-2 mb-20"></div>
					<div class="image-box style-3-b">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<div class="overlay-container">
									<img src="images/portfolio-1.jpg" alt="">
									<div class="overlay-to-top">
										<p class="small margin-clear"><em>Some info <br> Lorem ipsum dolor sit</em></p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-9">
								<div class="body">
									<h3 class="title">Project Title</h3>
									<p class="small mb-10"><i class="icon-calendar"></i> Feb, 2015 <i class="pl-10 icon-tag-1"></i> Web Design</p>
									<div class="separator-2"></div>
									<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam atque ipsam nihialal. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam laudantium, provident culpa saepe.</p>
									<a href="#" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Read More<i class="fa fa-arrow-right pl-10"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="image-box style-3-b">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<div class="overlay-container">
									<img src="images/portfolio-2.jpg" alt="">
									<div class="overlay-to-top">
										<p class="small margin-clear"><em>Some info <br> Lorem ipsum dolor sit</em></p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-9">
								<div class="body">
									<h3 class="title">Project Title</h3>
									<p class="small mb-10"><i class="icon-calendar"></i> Feb, 2015 <i class="pl-10 icon-tag-1"></i> Web Design</p>
									<div class="separator-2"></div>
									<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam atque ipsam nihialal. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam laudantium, provident culpa saepe.</p>
									<a href="#" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Read More<i class="fa fa-arrow-right pl-10"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="image-box style-3-b">
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<div class="overlay-container">
									<img src="images/portfolio-3.jpg" alt="">
									<div class="overlay-to-top">
										<p class="small margin-clear"><em>Some info <br> Lorem ipsum dolor sit</em></p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-9">
								<div class="body">
									<h3 class="title">Project Title</h3>
									<p class="small mb-10"><i class="icon-calendar"></i> Feb, 2015 <i class="pl-10 icon-tag-1"></i> Web Design</p>
									<div class="separator-2"></div>
									<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam atque ipsam nihialal. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam laudantium, provident culpa saepe.</p>
									<a href="#" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Read More<i class="fa fa-arrow-right pl-10"></i></a>
								</div>
							</div>
						</div>
					</div>
					<nav>
						<ul class="pagination">
							<li><a href="#" aria-label="Previous"><i class="fa fa-angle-left"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</nav>

				</div>
			</section>
			<!-- section end -->
			
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

