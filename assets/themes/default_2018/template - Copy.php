<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Spring - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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

  </head>
  <body>
    
	  <nav class="navbar navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-stretch">
	    		<div class="col-3 d-flex align-items-center">
			      <a class="navbar-brand" href="index.html">Spring<span>Church</span></a>
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
	          <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="ministry.html" class="nav-link">Ministries</a></li>
	          <li class="nav-item"><a href="sermons.html" class="nav-link">Sermons</a></li>
	          <li class="nav-item"><a href="events.html" class="nav-link">Upcoming Events</a></li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-10 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
          	<h1 class="mb-0">Helping Grow Your Faith</h1>
          	<h3 class="subheading mb-4 pb-1">Submit your presence to the creator of the universe</h3>
          	<p><a href="#" class="btn btn-primary py-3 px-4">New here!</a> <a href="#" class="btn btn-white py-3 px-4"><span class="icon-play-circle"></span> Live Stream</a></p>
            <div class="mouse">
							<a href="#" class="mouse-icon">
								<div class="mouse-wheel"><span class="ion-ios-arrow-down"></span></div>
							</a>
						</div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-intro py-5" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/bg_4.jpg);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row d-flex align-items-center">
    			<div class="col-md-6 ftco-animate">
    				<h2 class="subheading"><span class="icon-calendar"></span> Upcoming Events</h2>
    				<h2><a href="#">"The Law Demands, but Grace Supplies" &mdash; Pastor John Doe </a></h2>
    			</div>
    			<div class="col-md-6 pl-md-5 ftco-animate">
    				<div id="timer" class="d-flex mb-3">
						  <div class="time" id="days"></div>
						  <div class="time pl-4" id="hours"></div>
						  <div class="time pl-4" id="minutes"></div>
						  <div class="time pl-4" id="seconds"></div>
						</div>
						<p><a href="#" class="btn btn-primary px-4 py-2">Join our event</a></p>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-daily-verse bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 daily-verse text-center p-5">
    				<span class="flaticon-bible"></span>
    				<h3 class="ftco-animate">"16 For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life."</h3>
    				<h4 class="h5 mt-4 font-weight-bold ftco-animate">&mdash; John 3:16 KJV</h4>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section ftco-animate">
            <h2 class="mb-2"><span class="px-4">Spring Church Services</span></h2>
            <span class="subheading">Church Services</span>
          </div>
        </div>
    		<div class="row">
    			<div class="col-lg-6">
    				<div class="d-flex services ftco-animate text-lg-right">
	            <div class="icon order-lg-last d-flex align-items-center justify-content-center"><span class="flaticon-praying"></span></div>
	            <div class="media-body pr-lg-5">
	              <h3 class="heading mb-3">Daily Prayers</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
	          <div class="d-flex services ftco-animate text-lg-right">
	            <div class="icon order-lg-last d-flex align-items-center justify-content-center"><span class="flaticon-church"></span></div>
	            <div class="media-body pr-lg-5">
	              <h3 class="heading mb-3">Church Community</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
	          <div class="d-flex services ftco-animate text-lg-right">
	            <div class="icon order-lg-last d-flex align-items-center justify-content-center"><span class="flaticon-bible"></span></div>
	            <div class="media-body pr-lg-5">
	              <h3 class="heading mb-3">Teaching</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
    			</div>

    			<div class="col-lg-6">
    				<div class="d-flex services ftco-animate text-lg-left">
	            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-social-care"></span></div>
	            <div class="media-body pl-lg-5">
	              <h3 class="heading mb-3">Helpers</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
	          <div class="d-flex services ftco-animate text-lg-left">
	            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rings"></span></div>
	            <div class="media-body pl-lg-5">
	              <h3 class="heading mb-3">Wedding</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
	          <div class="d-flex services ftco-animate text-lg-left">
	            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-promotion"></span></div>
	            <div class="media-body pl-lg-5">
	              <h3 class="heading mb-3">Events</h3>
	              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	            </div>
	          </div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section heading-section-light ftco-animate">
            <h2 class="mb-2"><span class="px-4">Sermon for Today</span></h2>
            <span class="subheading">Experience God's Presence</span>
          </div>
        </div>
    		<div class="row d-flex sermon-wrap">
  				<div class="col-md-6 d-flex align-items-stretch ftco-animate">
  					<div class="img" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/sermon-1.jpg);"></div>
  				</div>
  				<div class="col-md-6 py-4 text ftco-animate">
  					<h2 class="mb-4"><a href="sermon.html">Lord is Sufficient for all of our needs</a></h2>
  					<div class="meta">
  						<p>
	  						<span>Sermon from: <a href="#" class="ptr">Felix Gonner</a></span>
	  						<span>Categories: <a href="#">God</a>, <a href="#">Pray</a></span>
	  						<span><a href="#">On Sunday 13 Jan, 2019</a></span>
  						</p>
  					</div>
						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
						<p class="mt-4 btn-customize">
							<a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="icon-play"></span> Watch Sermons</a> <a href="#" class="btn btn-black px-4 py-3 ml-lg-2"><span class="icon-download"></span> Download Sermons</a>
						</p>
  				</div>
    		</div>
    	</div>
    </section>

   	
    <section class="ftco-counter" id="section-counter">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 order-last d-flex flex-column align-items-stretch">
    				<div class="img d-flex align-self-stretch align-items-center justify-content-center" style="background-image:url( <?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/about.jpg);">
    					<div class="desc">
    						<h3><a href="#" class="p-2">Sunday Services</a></h3>
    					</div>
    				</div>
    				<div class="img d-flex align-self-stretch align-items-center justify-content-center" style="background-image:url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/about-2.jpg);">
    					<div class="desc">
    						<h3><a href="#" class="p-2">Announcement</a></h3>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 px-5 py-5">
    				<div class="row justify-content-start pt-3 pb-3">
		          <div class="col-md-12 heading-section heading-section-no-line ftco-animate">
		            <h2 class="mb-4">About Spring Church</h2>
		            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
		          </div>
		        </div>
		    		<div class="row">
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-4 bg-light mb-4">
		              <div class="text">
		              	<div class="icon d-flex justify-content-center align-items-center">
		              		<span class="flaticon-bible"></span>
		              	</div>
		                <strong class="number" data-number="70000">0</strong>
		                <span>Members</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-4 bg-light mb-4">
		              <div class="text">
		              	<div class="icon d-flex justify-content-center align-items-center">
		              		<span class="flaticon-bible"></span>
		              	</div>
		                <strong class="number" data-number="1000">0</strong>
		                <span>Pastors</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-4 bg-light mb-4">
		              <div class="text">
		              	<div class="icon d-flex justify-content-center align-items-center">
		              		<span class="flaticon-bible"></span>
		              	</div>
		                <strong class="number" data-number="100000">0</strong>
		                <span>Donation</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-4 bg-light mb-4">
		              <div class="text">
		              	<div class="icon d-flex justify-content-center align-items-center">
		              		<span class="flaticon-bible"></span>
		              	</div>
		                <strong class="number" data-number="100">0</strong>
		                <span>Churches</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>


    <section class="ftco-section testimony-section" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/bg_3.jpg);">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-2">Inspirational Testimony</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Arthur Browner</p>
                    <span class="position">Member</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/person_2.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Arthur Browner</p>
                    <span class="position">Member</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Arthur Browner</p>
                    <span class="position">Member</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/person_4.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Arthur Browner</p>
                    <span class="position">Member</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text p-3">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Arthur Browner</p>
                    <span class="position">Member</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-8 py-5">
    				<div class="heading-section heading-section-no-line ftco-animate mb-5">
	            <h2 class="mb-2">Upcoming Events</h2>
	            <span class="subheading">Experience God's Presence</span>
	          </div>
	          <div class="event-wrap d-md-flex ftco-animate">
	          	<div class="img"style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/sermon-1.jpg);"></div>
	          	<div class="text pl-md-5">
	          		<h2 class="mb-3"><a href="sermons.html">Know Jesus Christ Better Through Lines</a></h2>
	          		<div class="meta">
		  						<p>
			  						<span><i class="icon-calendar mr-2"></i> Monday, 8:00 Am - Tuesday, 8:00 Pm</span>
			  						<span><i class="icon-my_location mr-2"></i> <a href="#">Spring Church</a></span>
			  						<span><i class="icon-location_city mr-2"></i> 203 Fake St. Mountain View, San Francisco, California, USA</span>
		  						</p>
		  					</div>
		  					<p><a href="sermons.html" class="btn btn-primary">Read more</a></p>
	          	</div>
	          </div>
	          <div class="event-wrap d-md-flex ftco-animate">
	          	<div class="img"style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/sermon-2.jpg);"></div>
	          	<div class="text pl-md-5">
	          		<h2 class="mb-3"><a href="sermons.html">Know Jesus Christ Better Through Lines</a></h2>
	          		<div class="meta">
		  						<p>
			  						<span><i class="icon-calendar mr-2"></i> Monday, 8:00 Am - Tuesday, 8:00 Pm</span>
			  						<span><i class="icon-my_location mr-2"></i> <a href="#">Spring Church</a></span>
			  						<span><i class="icon-location_city mr-2"></i> 203 Fake St. Mountain View, San Francisco, California, USA</span>
		  						</p>
		  					</div>
		  					<p><a href="sermons.html" class="btn btn-primary">Read more</a></p>
	          	</div>
	          </div>

    			</div>
    			<div class="col-lg-4 d-flex align-items-stretch">
    				<div class="subsermon p-5">
    					<h2 class="heading mb-5 ftco-animate">Recent Sermons</h2>
    					<div class="sermon-wrap mb-4 ftco-animate">
	    					<a href="sermons.html" class="img mb-3" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/event-1.jpg);"></a>
	    					<div class="text">
	    						<h2 class="mb-4"><a href="sermon.html">Lord is Sufficient for all of our needs</a></h2>
			  					<div class="meta">
			  						<p>
				  						<span>Sermon from: <a href="#" class="ptr">Felix Gonner</a></span>
				  						<span>Categories: <a href="#">God</a>, <a href="#">Pray</a></span>
				  						<span><a href="#">On Sunday 13 Jan, 2019</a></span>
			  						</p>
			  					</div>
									<p class="mt-4">
										<a href="https://vimeo.com/45830194" class="btn-custom  p-2 text-center popup-vimeo"><span class="icon-play"></span> Watch Sermons</a>
									</p>
									<p class="mt-4">
										<a href="#" class="btn-custom  p-2 text-center"><span class="icon-download"></span> Download Sermons</a>
									</p>
	    					</div>
    					</div>
    					<a href="sermons.html" class="sermon-wrap sermon-wrap-2 d-flex align-items-start py-3 ftco-animate">
    						<div class="icon">
	    						<span class="icon-play"></span>
    						</div>
    						<div class="desc">
	    						<h3>Fruit of the Spirit</h3>
	    						<span class="time">20:30 mins</span>
    						</div>
    					</a>
    					<a href="sermons.html" class="sermon-wrap sermon-wrap-2 d-flex align-items-start py-3 ftco-animate">
    						<div class="icon">
	    						<span class="icon-play"></span>
    						</div>
    						<div class="desc">
	    						<h3>Fruit of the Spirit</h3>
	    						<span class="time">20:30 mins</span>
    						</div>
    					</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section heading-section-light ftco-animate">
            <h2 class="mb-2"><span class="px-4">Recent Blog</span></h2>
            <span class="subheading">Our Blog</span>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-lg-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_1.jpg');">
              </a>
              <div class="text d-flex float-right d-block">
              	<div class="topper text-center pt-4 px-3">
            			<span class="day">18</span>
            			<span class="mos">January</span>
            			<span class="yr">2019</span>
              	</div>
              	<div class="desc p-4">
	                <h3 class="heading mt-2"><a href="#">All you want to know about Bible</a></h3>
	                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="blog-single.html" class="block-20" style="background-image: url('<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_2.jpg');">
              </a>
              <div class="text d-flex float-right d-block">
              	<div class="topper text-center pt-4 px-3">
            			<span class="day">15</span>
            			<span class="mos">January</span>
            			<span class="yr">2019</span>
              	</div>
              	<div class="desc p-4">
	                <h3 class="heading mt-2"><a href="#">All you want to know about Bible</a></h3>
	                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 d-flex ftco-animate">
          	<div class="blog-entry">
              <a href="blog-single.html" class="block-20" style="background-image: url('<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_3.jpg');">
              </a>
              <div class="text d-flex float-right d-block">
              	<div class="topper text-center pt-4 px-3">
            			<span class="day">14</span>
            			<span class="mos">January</span>
            			<span class="yr">2019</span>
              	</div>
              	<div class="desc p-4">
	                <h3 class="heading mt-2"><a href="#">All you want to know about Bible</a></h3>
	                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section ftco-gallery">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="row no-gutters">
							<div class="col-md-6 ftco-animate">
								<a href="images/image_1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_1.jpg);">
									<div class="icon mb-4 d-flex align-items-center justify-content-center">
		    						<span class="icon-instagram"></span>
		    					</div>
								</a>
							</div>
							<div class="col-md-6 ftco-animate">
								<a href="images/image_2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_2.jpg);">
									<div class="icon mb-4 d-flex align-items-center justify-content-center">
		    						<span class="icon-instagram"></span>
		    					</div>
								</a>
							</div>
							<div class="col-md-6 ftco-animate">
								<a href="images/image_3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_3.jpg);">
									<div class="icon mb-4 d-flex align-items-center justify-content-center">
		    						<span class="icon-instagram"></span>
		    					</div>
								</a>
							</div>
							<div class="col-md-6 ftco-animate">
								<a href="images/image_4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_4.jpg);">
									<div class="icon mb-4 d-flex align-items-center justify-content-center">
		    						<span class="icon-instagram"></span>
		    					</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-stretch">
						<div id="map"></div>
					</div>
				</div>
			</div>
		</section>



    <section class="ftco-section ftco-section-parallax bg-secondary ftco-no-pb">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white heading-section-no-line ftco-animate">
              <h2>Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Spring Church</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
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
          </div>
          <div class="col-md">
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
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/jquery.min.js"></script>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/google-map.js"></script>
  <script src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>js/main.js"></script>
    
  </body>
</html>