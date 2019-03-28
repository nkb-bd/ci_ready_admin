<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=str_replace("|"," ",$this->settings->site_name);?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
  <meta name="description" content="<?php echo $this->settings->meta_description; ?>">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i" rel="stylesheet">

    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/animate.css">
    
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/owl.carousel.min.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/owl.theme.default.min.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/magnific-popup.css">

    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/aos.css">

    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/ionicons.min.css">

    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/bootstrap-datepicker.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/jquery.timepicker.css">

    
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/flaticon.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/icomoon.css">
    <link rel="stylesheet"  href="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>css/style.css">

  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.min.js"></script>


  </head>
  <body>
    
	  <nav class="navbar navbar-dark ftco_navbar  ftco-navbar-light bg-dark" id="ftco-navbar">
	    <div class="container d-flex align-items-stretch">
	    		<div class="col-3 d-flex align-items-center">

            <?php 
            $title = explode("|", $this->settings->site_name);
            $title1=  $title[0]; // piece1
            
            if(isset($title[1])){
             
              $title2=  $title[1]; // piece1

             }else{
               $title2='';
             }

             ?>
            <img src="<?=base_url()?><?=$this->settings->logo1?>" width="40px" alt="">


			      <a class="navbar-brand" href="index.html"><?=$title1?><span><?=$title2?></span></a>
			    </div>
					<div class="col-9 d-flex align-items-center text-right">
		      	<ul class="ftco-social mt-2 mr-3">
		          <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
		          <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
		          <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
		        </ul>

			      <button class="navbar-toggler d-flex align-items-center" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="pt-1 mr-1">Menu</span> <span class="oi oi-menu"></span>
			      </button>
		      </div>


	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="<?=base_url()?>" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	         
               <?php if (!empty($dynamic_pages)): ?>

          <li class="dropdown nav-item <?php echo ($this->uri->segment(1) == 'pages') ? 'active' : ''; ?>">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
               Pages 
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <?php foreach ($dynamic_pages as $page): ?>
                
                   <a href="<?=base_url()?>pages/<?php echo $page['slug'] ?>" class="dropdown-item nav-item">
                     <?php echo $page['title'] ?>
                  </a>
                <div class="dropdown-divider"></div>

                  
              <?php endforeach ?>
           
            </div>
          </li>



            
          <?php endif ?>
    
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

 

        <!-- system msg -->
      <?php // System messages ?>
      <?php if ($this->session->flashdata('message')) : ?>
          <div class="alert alert-success alert-dismissable text-center">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('message'); ?>
          </div>
      <?php elseif ($this->session->flashdata('error')) : ?>
          <div class="alert animated shake alert-danger text-center alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->session->flashdata('error'); ?>
          </div>
      <?php elseif (validation_errors()) : ?>
          <div class="alert animated shake  text-center alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo validation_errors(); ?>
          </div>
      <?php elseif ($this->error) : ?>
          <div class="alert  animated shake text-center alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $this->error; ?>
          </div>
      <?php endif; ?>

      <?=$content?>


    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md text-center">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><?=$this->settings->site_name?></h2>
              <p><?=$this->settings->meta_description?></p>
              <ul class="ftco-footer-social list-unstyled float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
         <!--  <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">About</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Staff</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Beliefs</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>History</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Mission</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Wedding &amp; Funerals</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Jobs &amp; Internship</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Fellowships</a></li>

              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Connect</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Home Groups</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Recovery Groups</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Memberships</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Children &amp; Students</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Volunteer</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Counseling</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Assistance</a></li>
              </ul>
            </div>
          </div> -->
          <!-- <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Service Hours</h2>
              <div class="opening-hours">
              	<h4>Services Hours</h4>
              	<p class="pl-3">
              		<span class="mb-3">Saturday Prayer Meeting &mdash; 10:00 am to 11:30 am</span>
              		<span>Sunday Service &mdash; 8:30 am to 11:30 am</span>
              	</p>
              </div>
            </div>
          </div> -->
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 <?=$this->settings->footer?>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/popper.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/aos.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.timepicker.min.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/scrollax.min.js"></script>
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhMqGnt6JqRyudxYl-tGU5wA9RwyPWINM&sensor=false&libraries=adsense"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/google-map.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/main.js"></script>
    
  </body>
</html>