<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>NotesAcademy | Home</title>
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
		<link href="plugins/rs-plugin/css/settings.css" rel="stylesheet">
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
	function search() {
		$.ajax({
        url: "search.php",
        type: "POST",
        data: {q:$("#q").val(), sch:$("#sch").val(), subj:$("#subj").val(), lvl:$("#lvl").val()},
        success: function( data ) {
        	if (data == "No Notes Here") {
        		$("#contt").html(":( There's no notes. Pls contribute some!");
        	}
        	else {
	        	console.log(data);
	        	var arr = JSON.parse(data);
	        	var cont = "";
	        	for (var i = 0; i < arr.length; i++) {
	        		cont += "<div class='col-md-3'><a href='viewer.php?id="+arr[i]['id']+"'><div class='pv-20 feature-box bordered shadow text-center' data-animation-effect='fadeInDownSmall' data-effect-delay='100'><div class='col-md-6 col-md-offset-3'><img src='data:image/png;base64,"+arr[i]['preview']+"' alt='preview' style='width: 100%''></i></div><h4>"+arr[i]['title']+"</h4></a></div></div>";
	        	}
	        	console.log(cont);
	        	$("#contt").html(cont);
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
	<body class="no-trans front-page transparent-header  ">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
			<?php
			$m = "index";
			include "mysql.php";
			include "menu.php";
			?>
			
			<div id="page-start"></div>

			<!-- section start -->
			<!-- ================ -->
			<section class="light-gray-bg pv-10 clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">Our <strong>Notes</strong></h2>
									<div class="form-group has-feedback">
											<input type="text" class="form-control" id="q" name="q" placeholder="Search for notes" onkeyup='search()'>
											<i class="fa fa-search form-control-feedback"></i>
									</div>
							<div class="separator"></div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
									<div class="form-group has-feedback">
										<label for="school" class="col-sm-3 control-label">School</label>
										<select name="sch" id="sch" class="form-control" required onchange='search()'>
									<option value="0">All Schools</option>
									<?php
									$q = $conn->query("SELECT id,value FROM meta WHERE type='school' ORDER BY value ASC");
									while ($r = mysqli_fetch_assoc($q)) {
										echo "<option value='" . $r['id'] . "'>" . $r['value'] . "</option>";
									}
									?>
								</select>
									</div>

									<div class="form-group has-feedback">
										<label for="subj" class="col-sm-3 control-label">Subject</label>
										<select name="subj" id='subj' class="form-control" required>
									<option value="0">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
								</select>
									</div>

									<div class="form-group has-feedback">
										<label for="school" class="col-sm-3 control-label">Level</label>
										<select name="lvl" id='lvl' class="form-control" required>
									<option value="0">All levels</option>
									<?php
									$q = $conn->query("SELECT id,value FROM meta WHERE type='level' ORDER BY value ASC");
									while ($r = mysqli_fetch_assoc($q)) {
										echo "<option value='" . $r['id'] . "'>" . $r['value'] . "</option>";
									}
									?>
								</select>
									</div>
						</div>
						<div class="col-md-10" id="contt">
							<div class="col-md-12">
							<div class="col-md-3 ">
							<!-- pv-x means padding vertical (top and bottom), ph-x means padding horizontal (left and right) by x pixels) -->
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/pdf.jpg" style="width: 100%"></i></div>
									<h4>Biology (H1)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/docx.png" style="width: 100%"></i></div>
									<h4>Chemistry (H2)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/pdf.jpg" style="width: 100%"></i></div>
									<h4>English (O)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/xls.png" style="width: 100%"></i></div>
									<h4>Mathematics (Sec 3)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							</div>
							<div class="col-md-12">
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/doc.png" style="width: 100%"></i></div>
									<h4>History (H2)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/mp3.jpg" style="width: 100%"></i></div>
									<h4>Chinese (Sec 3)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/pptx.png" style="width: 100%"></i></div>
									<h4>Physics (H3)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							<div class="col-md-3 ">
								<a href="test.php"><div class="pv-20 feature-box bordered shadow text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
									<div class="col-md-6 col-md-offset-3"><img src="images/xls.png" style="width: 100%"></i></div>
									<h4>Mathematics (Sec 3)</h4></a>
					<!--				<a href="page-services.html">Read More <i class="pl-5 fa fa-angle-double-right"></i></a> -->
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- section end -->
			
			
			<div class="dark-bg  default-hovered footer-top animated-text">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action text-center">
								<div class="row">
									<div class="col-sm-8">
										<h2>Contribute back to the community!</h2>
										<h2>Upload your notes now!</h2>
									</div>
									<div class="col-sm-4">
										<p class="mt-10"><a href="#" class="btn btn-animated btn-lg btn-gray-transparent ">Contribute<i class="fa fa-upload pl-20"></i></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			

			<!-- section start -->
			<!-- ================ 
			<section class="section default-bg clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action text-center">
								<div class="row">
									<div class="col-sm-8">
										<h1 class="title">Don't Miss Out Our Offers</h1>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem quasi explicabo consequatur consectetur, a atque voluptate officiis eligendi nostrum.</p>
									</div>
									<div class="col-sm-4">
										<br>
										<p><a href="#" class="btn btn-lg btn-gray-transparent btn-animated">Join Now<i class="fa fa-arrow-right pl-20"></i></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>-->
			<!-- section end -->

			<!-- section -->
			<!-- ================ -->
			<section class="pv-30">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">Why <strong>Choose</strong> Us</h2>
							<div class="separator"></div>
							<p class="large text-center">Atque ducimus velit, earum quidem, iusto dolorem. Ex ipsam totam quas blanditiis, pariatur maxime ipsa iste, doloremque neque doloribus, error. Corrupti, tenetur.</p>
							<br>
						</div>
					</div>
				</div>
				<div class="owl-carousel content-slider-with-large-controls">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<img src="images/section-image-1.png" alt="">
							</div>
							<div class="col-md-6">
								<p class="space-top">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At provident modi nobis dolores ratione, maiores beatae vel iste illo incidunt officia sed id cupiditate quasi excepturi</p>
								<div class="media">
									<div class="media-left pr-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-eye"></i> </span>
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Extremely Flexible</h4>
										Cras sit amet nibh libero, in gravida nulla. Sollicitudin.
									</div>
								</div>
								<div class="media">
									<div class="media-left pr-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-trophy"></i> </span>
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Packed Full Of Features</h4>
										Cras sit amet nibh libero. Nulla vel metus scelerisque.
									</div>
								</div>
								<div class="media">
									<div class="media-left pr-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-lifebuoy"></i> </span>
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">24/7 Support</h4>
										Cras sit amet nibh libero. Nulla vel metus scelerisque.
									</div>
								</div>
								<p><a href="page-services.html" class="btn btn-default-transparent btn-animated">Learn More <i class="fa fa-arrow-right pl-10"></i></a></p>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-6 text-right">
								<p class="space-top">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At provident modi nobis dolores ratione, maiores beatae vel iste illo incidunt officia sed id cupiditate quasi excepturi</p>
								<div class="media">
									<div class="media-body">
										<h4 class="media-heading">Extremely Flexible</h4>
										Cras sit amet nibh libero, in gravida nulla. Sollicitudin.
									</div>
									<div class="media-right pl-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-eye"></i> </span>
										</a>
									</div>
								</div>
								<div class="media">
									<div class="media-body">
										<h4 class="media-heading">Packed Full Of Features</h4>
										Cras sit amet nibh libero. Nulla vel metus scelerisque.
									</div>
									<div class="media-right pl-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-trophy"></i> </span>
										</a>
									</div>
								</div>
								<div class="media">
									<div class="media-body">
										<h4 class="media-heading">24/7 Support</h4>
										Cras sit amet nibh libero. Nulla vel metus scelerisque.
									</div>
									<div class="media-right pl-20">
										<a href="#">
											<span class="icon circle small default-bg"><i class="icon-lifebuoy"></i> </span>
										</a>
									</div>
								</div>
								<p><a href="page-services.html" class="btn btn-default-transparent btn-animated">Learn More <i class="fa fa-arrow-right pl-10"></i></a></p>
							</div>
							<div class="col-md-6">
								<img src="images/section-image-2.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			<section class="light-gray-bg pv-20">
			</section>
			<!-- section end -->

			<!-- section -->
			<!-- ================ -->
			<section class="pv-30">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h2>What We <strong>Offer</strong></h2>
							<div class="separator-2"></div>
							<p>Lorem ipsum dolor sit amet, lotrem <span class="text-default">some colored text</span>. Nulla explicabo <strong>attention to this</strong> blanditiis, ex cupiditate ipsam debitis rem.</p>
							<ul class="list-icons">
								<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100"><i class="icon-check-1"></i> 18 Predifined Home Pages</li>
								<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="150"><i class="icon-check-1"></i> 12 Header Options</li>
								<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200"><i class="icon-check-1"></i> 6 Footer Options</li>
								<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="250"><i class="icon-check-1"></i> 170 HTML files</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <strong>Some bold text</strong>, unde voluptatum quidem explicabo et eius aut nisi dolore ut.</p>
							<a href="page-about.html" class="btn btn-default btn-hvr hvr-shutter-out-horizontal btn-lg"><i class="icon-users-1 pr-10"></i>Learn More</a>
						</div>
						<div class="col-md-6">
							<br>
							<div role="tabpanel">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs style-1" role="tablist">
									<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="icon-heart pr-10"></i>We Love</a></li>
									<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">What</a></li>
									<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">We Do</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="home">
										<div class="overlay-container overlay-visible">
											<img src="images/section-image-3.jpg" alt="">
											<a href="#" class="overlay-link"><i class="fa fa-link"></i></a>
											<div class="overlay-bottom hidden-xs">
												<div class="text">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt nobis sunt, quae alias impedit ea molestias recusandae.
												</div>
											</div>
										</div>										
									</div>
									<div role="tabpanel" class="tab-pane fade" id="profile">
										<div class="embed-responsive embed-responsive-16by9">
											<iframe class="embed-responsive-item" src="//player.vimeo.com/video/29198414?byline=0&amp;portrait=0"></iframe>
											<p><a href="http://vimeo.com/29198414">Introducing Vimeo Music Store</a> from <a href="http://vimeo.com/staff">Vimeo Staff</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="messages">
										<h3>Lorem ipsum dolor sit amet</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium voluptas excepturi hic eveniet deleniti, voluptate fugit quod sapiente ut nulla voluptates neque a rerum! Sed dolores enim veniam, dolor minus.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui quos quidem amet sapiente praesentium unde, vel corrupti, vero dicta velit fuga ut at accusantium expedita inventore fugit perferendis non reprehenderit.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente tempore ipsam tenetur molestias eligendi provident! Itaque sapiente neque esse expedita voluptatibus qui officia, fuga a tempora! Alias voluptate pariatur quo.</p>
									</div>
								</div>
							</div>					
						</div>
					</div>
				</div>
				<br>
			</section>
			<!-- section end -->

			<!-- section -->
			<!-- ================ -->
			<section class="pv-30 light-gray-bg padding-bottom-clear">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">Our <strong>Portfolio</strong></h2>
							<div class="separator"></div>
							<p class="large text-center">Atque ducimus velit, earum quidem, iusto dolorem. Ex ipsam totam quas blanditiis, pariatur maxime ipsa iste, doloremque neque doloribus, error. Corrupti, tenetur.</p>
							<br>
						</div>
					</div>
				</div>
				<div class="space-bottom">
					<div class="owl-carousel carousel">
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-1.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-2.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-3.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-4.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-5.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="image-box shadow text-center">
							<div class="overlay-container">
								<img src="images/portfolio-6.jpg" alt="">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="portfolio-item.html">Project Title</a></h3>
										<p class="small">Lorem ipsum dolor sit amet.</p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="portfolio-item.html" class="btn btn-gray-transparent btn-animated">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="owl-carousel content-slider">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<div class="testimonial text-center">
										<div class="testimonial-image">
											<img src="images/testimonial-1.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle">
										</div>
										<h3>Just Perfect!</h3>
										<div class="separator"></div>
										<div class="testimonial-body">
											<blockquote>
												<p>Sed ut perspiciatis unde omnis iste natu error sit voluptatem accusan tium dolore laud antium, totam rem dolor sit amet tristique pulvinar, turpis arcu rutrum nunc, ac laoreet turpis augue a justo.</p>
											</blockquote>
											<div class="testimonial-info-1">- Jane Doe</div>
											<div class="testimonial-info-2">By Company</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<div class="testimonial text-center">
										<div class="testimonial-image">
											<img src="images/testimonial-2.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle">
										</div>
										<h3>Amazing!</h3>
										<div class="separator"></div>
										<div class="testimonial-body">
											<blockquote>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et cupiditate deleniti ratione in. Expedita nemo, quisquam, fuga adipisci omnis ad mollitia libero culpa nostrum est quia eos esse vel!</p>
											</blockquote>
											<div class="testimonial-info-1">- Jane Doe</div>
											<div class="testimonial-info-2">By Company</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="clients-container">
							<div class="clients">
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
									<a href="#"><img src="images/client-1.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="200">
									<a href="#"><img src="images/client-2.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
									<a href="#"><img src="images/client-3.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="400">
									<a href="#"><img src="images/client-4.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="500">
									<a href="#"><img src="images/client-5.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="600">
									<a href="#"><img src="images/client-6.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="700">
									<a href="#"><img src="images/client-7.png" alt=""></a>
								</div>
								<div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="800">
									<a href="#"><img src="images/client-8.png" alt=""></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			<section class="pv-40 stats padding-bottom-clear dark-translucent-bg hovered background-img-7" style="background-position: 50% 50%;">
				<div class="clearfix">
					<div class="col-md-3 col-xs-6 text-center">
						<div class="feature-box object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
							<span class="icon dark-bg large circle"><i class="fa fa-diamond"></i></span>
							<h3><strong>Projects</strong></h3>
							<span class="counter" data-to="1525" data-speed="5000">0</span>
						</div>
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<div class="feature-box object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
							<span class="icon dark-bg large circle"><i class="fa fa-users"></i></span>
							<h3><strong>Clients</strong></h3>
							<span class="counter" data-to="1225" data-speed="5000">0</span>
						</div>
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<div class="feature-box object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
							<span class="icon dark-bg large circle"><i class="fa fa-cloud-download"></i></span>
							<h3><strong>Downloads</strong></h3>
							<span class="counter" data-to="12235" data-speed="5000">0</span>
						</div>
					</div>
					<div class="col-md-3 col-xs-6 text-center">
						<div class="feature-box object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
							<span class="icon dark-bg large circle"><i class="fa fa-share"></i></span>
							<h3><strong>Shares</strong></h3>
							<span class="counter" data-to="15002" data-speed="5000">0</span>
						</div>
					</div>
				</div>
				<!-- footer top start -->
				<!-- ================ -->
				<div class="footer-top animated-text" style="background-color:rgba(0,0,0,0.3);">
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
											<p class="mt-10"><a href="#" class="btn btn-animated btn-lg btn-gray-transparent">Purchase<i class="fa fa-cart-arrow-down pl-20"></i></a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- footer top end -->
			</section>
			<!-- section end -->
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

		<!-- jQuery Revolution Slider  -->
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		
		

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>
		
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

		<!-- Background Video -->
		<script src="plugins/vide/jquery.vide.js"></script>

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
