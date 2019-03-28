      <div class="carousel-slider owl-carousel"> 
                

                <?php if (isset($slider_data)): ?>
               

                  <?php foreach ($slider_data as $data): ?>

                       <div class="hero-wrap js-fullheight " style="background-image: url('<?php echo base_url("/{$data['path']}")?>');" data-stellar-background-ratio="0.5">
                          <div class="overlay"></div>
                          <div class="container ">
                            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
                              <div class="col-md-10 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                                <h1 class="mb-0"><?=$data['heading']?></h1>
                                <h3 class="subheading mb-4 pb-1"><?=$data['sub_heading']?></h3>
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
                    
                  <?php endforeach ?>
                  
                <?php endif ?>
            
       
      </div>

    
    <section class="ftco-intro py-5" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/bg_4.jpg);">
      <div class="overlay" style=" width:  100%;"></div>
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-md-6 ftco-animate">
            <h2 class="subheading"><span class="icon-calendar"></span> Upcoming Events</h2>
            <!-- <h2><a href="#">"The Law Demands, but Grace Supplies" &mdash; Pastor John Doe </a></h2> -->
          </div>
          <div class="col-md-6 pl-md-5 ftco-animate">
            <div id="timer" data-time = "21 December 2019 9:56:00 GMT+01:00" class="d-flex mb-3">
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
            <span class="icon-anchor"></span>
            <h3 class="ftco-animate">
              <?=$this->settings->meta_description?>
            </h3>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section ftco-animate">
            <h2 class="mb-2"><span class="px-4">Our Services</span></h2>
            <!-- <span class="subheading">Church Services</span> -->
          </div>
        </div>
        <div class="row">

           <!-- services -->
            <?php if (count( $services_data)>0): 

                 $len = count( $services_data);
                $firsthalf = array_slice($services_data, 0, $len / 2);
                $secondhalf = array_slice($services_data, $len / 2);

              
              ?>
                

              
       

            


          <div class="col-lg-6">
              <?php foreach ($firsthalf as $data): ?>
                  <div class="d-flex services ftco-animate text-lg-right">
                    <div class="icon order-lg-last d-flex align-items-center justify-content-center">
                       <?php if (!empty($data['path'])): ?>
                           <img src="<?=base_url()?><?=$data['path']?>" alt="T<?=$data['heading']?>" class="img-raised user-img  img-fluid">
                        <?php endif ?>
                    </div>
                    <div class="media-body pr-lg-5">
                      <h3 class="heading mb-3"><?=$data['heading']?></h3>
                        <p><?=$data['sub_heading']?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>


          <div class="col-lg-6">
               <?php foreach ($secondhalf as $data): ?>
                  <div class="d-flex services ftco-animate text-lg-right">
                    <div class="icon order-lg-last d-flex align-items-center justify-content-center">
                       <?php if (!empty($data['path'])): ?>
                           <img src="<?=base_url()?><?=$data['path']?>" alt="T<?=$data['heading']?>" class="img-raised user-img  img-fluid">
                        <?php endif ?>
                    </div>
                    <div class="media-body pr-lg-5">
                      <h3 class="heading mb-3"><?=$data['heading']?></h3>
                        <p><?=$data['sub_heading']?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
          </div>
        </div>

        <?php endif ?>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section heading-section-light ftco-animate">
            <h2 class="mb-2"><span class="px-4">Have a project in mind?</span></h2>
            <span class="subheading">You can reach us by email!</span>
          </div>
        </div>
        <div class="row d-flex sermon-wrap">
          <div class="col-md-6 d-flex align-items-stretch ftco-animate">
            <div class="img" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/get_in_touch.jpeg);"></div>
          </div>
          <div class="col-md-6 py-4 text ftco-animate">
            <h2 class="mb-4"><a href="sermon.html"><?=str_replace("|"," ",$this->settings->site_name);?></a></h2>
            <div class="meta">
            <?=$this->settings->welcome_message;?>
            </div>
            <p class="mt-4 btn-customize">
              <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="icon-play"></span> Demo</a> 
              <a href="#" class="btn btn-black px-4 py-3 ml-lg-2"><span class="icon-message"></span> Get In Touch</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <?php if ( !empty($portfolio_data) ): ?>
      
    <section class="ftco-counter" id="section-counter">
      <div class="container">
        <div class="row d-flex">
        
          <div class="col-md-12 px-5 py-5">

            <!-- portfolio -->

            <style>
button svg {
  display: none;
}

button.loading-start svg {
  display: inline-block;

  opacity: 1;
}
.single-content-holder{
  position:   relative;

}
.single-content :hover .p-desc{
  opacity: 1;

}.hovereffect {
  width: 100%;
  height: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: default;
}

.hovereffect .overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
}

.hovereffect img {
  display: block;
  position: relative;
  -webkit-transition: all 0.4s ease-in;
  transition: all 0.4s ease-in;
}

.hovereffect:hover img {
  filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feColorMatrix type="matrix" color-interpolation-filters="sRGB" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0" /><feGaussianBlur stdDeviation="3" /></filter></svg>#filter');
  filter: grayscale(1) blur(3px);
  -webkit-filter: grayscale(1) blur(3px);
  -webkit-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}

.hovereffect h2 {
  text-transform: uppercase;
  text-align: center;
  position: relative;
  font-size: 17px;
  padding: 10px;
  background: rgba(0, 0, 0, 0.6);
}

.hovereffect a.info {
  display: inline-block;
  text-decoration: none;
  padding: 7px 14px;
  border: 1px solid #fff;
  margin: 50px 0 0 0;
  background-color: transparent;
}

.hovereffect a.info:hover {
  box-shadow: 0 0 5px #fff;
}

.hovereffect a.info, .hovereffect h2 {
  -webkit-transform: scale(0.7);
  -ms-transform: scale(0.7);
  transform: scale(0.7);
  -webkit-transition: all 0.4s ease-in;
  transition: all 0.4s ease-in;
  opacity: 0;
  filter: alpha(opacity=0);
  color: #fff;
  text-transform: uppercase;
}

.hovereffect:hover a.info, .hovereffect:hover h2 {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}           </style>
              <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-12 text-center heading-section  ftco-animate">
                  <h2 class="mb-2"><span class="px-4">Our Potfolio</span></h2>
                  <span class="subheading">You can have a quick look!</span>
                </div>
              </div>

                <div class="filters filter-button-group">
                  <ul><h4>
                    <li class="active" data-filter="*">All</li>

                    <?php if ($portfolio_types): ?>
                      
                      <?php foreach ($portfolio_types as $data): ?>
  
                        <li data-filter=" .<?php echo  str_replace(' ', '_', $data['type']) ?>"> <?php echo $data['type'];  ?> </li>
                        
                      <?php endforeach ?>
                    
                    <?php endif ?>
                  </h4></ul>
                </div>

                <div class="content grid">


                  <?php if (count($portfolio_data)>0): ?>

                      <?php foreach ($portfolio_data as $data): ?>
                                <div class="single-content brand   <?php echo  str_replace(' ', '_', $data['type']) ?> grid-item  " style="margin:10px;">
                                    <div class="hovereffect">
                                        <img class="img-responsive" src="<?= $data['path']?>" alt="<?= $data['url']?>">
                                        <div class="overlay">
                                           <h2><?= $data['name']?></h2>
                                           <a class="info" href="<?= $data['url']?>" target="_blank">Open</a>
                                        </div>
                                    </div>
                                </div>
                      <?php endforeach ?>
                    
                  <?php endif ?>
             

                        
                    
                    </div>
          </div>
        </div>
      </div>
    </section>
    <!-- portfolio -->
   <?php endif ?>
    
    <?php if ( !empty($team_data) ): ?>
    <!-- team -->
      
    <section class="ftco-section testimony-section" style="background-image: url(<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/bg_3.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-2">Our Team</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
            

                  <?php foreach ($team_data as $data): ?>
                               <div class="item">
                                <div class="testimony-wrap text-center py-4 pb-5">
                                  <div class="user-img mb-4" style="background-image: url(<?php echo base_url("/{$data['path']}")?>)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                      <i class="icon-code"></i>
                                    </span>
                                  </div>
                                  <div class="text p-3">
                                    <p class="name"><?= $data['name']?></p>
                                    <span class="position"><?= $data['designation']?></span>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><?php echo !empty($data['fb_link']) ? '<a href="'.$data['fb_link'].'" target="_blank" ><span class="icon-facebook"></span></a> ': '' ?> </li>
                                        <li class="list-inline-item"><?php echo !empty($data['twitter_link']) ? '<a href="'.$data['twitter_link'].'" target="_blank" ><span class="icon-twitter"></span></a> ': '' ?> </li>
                                       
                                      </ul>
                                  </div>
                                </div>
                              </div>
                      <?php endforeach ?>
          
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- team -->
    <?php endif ?>
    

    <!-- testimony -->
    <section class="ftco-section ftco-no-pt ftco-no-pb">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 py-5 ">
             <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-12 text-center heading-section  ftco-animate">
                  <h2 class="mb-2"><span class="px-4">Testimony</span></h2>
                  <span class="subheading">Our Happy Clients</span>
                </div>
              </div>
          
            <div class="  owl-carousel   carousel-clients">
              
              <div class="col-lg-8  offset-2 d-flex ftco-animate " >
                <div class="text-center">
                    <img src="https://www.dmsholidays.com/img/DMS-Holidays-logo.png" style="max-width: 180px; display: inline-block;" class="img-responsive rounded" alt="">
                 
                  <div class="text d-flex  d-block " >
                   
                    <div class=" p-4 text-center">
                      <p>Rick Lim</p>
                        <span class="quote d-flex align-items-center justify-content-center">
                          <i class="icon-quote-left"></i>
                        </span>
                      <h3 class="heading mt-2"><a href="#">Awesome service, seller takes the time to fully understand my requirements and manage to deliver what i want, Talented man. Would definitely come back to him for more of his services.</a></h3>
                    
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-lg-8  offset-2 d-flex ftco-animate " >
                <div class="text-center">
                    <img src="<?php echo base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/image_1.jpg" style="max-width: 180px;display: inline-block;" class="img-responsive rounded" alt="">
               
                  <div class="text d-flex float-right d-block " >
                   
                    <div class=" p-4 text-center">
                      <p>Mack Winston</p>
                        <span class="quote d-flex align-items-center justify-content-center">
                          <i class="icon-quote-left"></i>
                        </span>
                      <h3 class="heading mt-2"><a href="#">Don’t just take our words for it. Our clients are our biggest supporters</a></h3>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        
        </div>
      </div>
    </section>
    <!-- testimony -->
    

    <!-- partners -->
    <!--  <section class="ftco-section bg-light">

        <div class="container">
          <div class="col-md-12">
            <div class="owl-carousel   carousel-partners">
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
                 <div class="col-md-12">
                    <a class="social-icon text-xs-center" target="_blank" href="#">
                      <img src="<?=base_url("{$this->settings->themes_folder}/{$this->settings->theme}/")?>images/07.png" class="img-responsive" style="max-width: 150px;" alt="">
                   </a>
                 </div>
                 
               
              </div>
          </div>
        </div>
     </section> -->
    <!-- partners -->
      

    <?php if (  !empty($blog_data)): ?>
        
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section heading-section-light    ftco-animate">
            <h2 class="mb-2"><span class="px-4">Recent Blog</span></h2>
            <span class="subheading">Our Blog</span>
          </div>
        </div>
        <div class="row d-flex">

          <?php foreach ($blog_data   as $data): ?>
             <div class="col-lg-4 d-flex ftco-animate">
            <div class="blog-entry justify-content-end">
              <a href="<?=base_url()?>blog/<?=$data['slug']?>" class="block-20" style="background-image: url('<?php echo base_url("/{$data['image']}")?>');">
              </a>
              <div class="text d-flex float-right d-block">
                <div class="topper text-center pt-4 px-3">
                  <span class="day"><?php echo  date("d",strtotime($data['created'])) ?></span>
                  <span class="mos"><?php echo  date("M",strtotime($data['created'])) ?></span>
                  <span class="yr"><?php echo  date("Y",strtotime($data['created'])) ?></span>
                </div>
                <div class="desc p-4">
                  <h3 class="heading mt-2"><a href="<?=base_url()?>blog/<?=$data['slug']?>"><?php echo   $data['title'] ?></a></h3>
                  <p><?php echo   $data['excerpt'] ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
         
        </div>
      </div>
    </section>

    <?php endif ?>  

    
    <section class="ftco-section ftco-gallery ">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 text-center heading-section  ftco-animate">
            <h2 class="mb-2"><span class="px-4">Contact</span></h2>
            <!-- <span class="subheading">Our Blog</span> -->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="row no-gutters">
              <form class="contact-form row ajax-form" method="POST" action="<?=base_url()?>contact/send">
                  <div class="form-field form-group col col-md-6">
                     <input id="name" class="input-text form-control" type="text" placeholder="Name" required name="name">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                  </div>
                  <div class="form-field  form-group col col-md-6">
                     <input id="email" class="input-text js-input  form-control"  placeholder="Email" type="email"  name="email" required>
                  </div>
                  <div class="form-field  form-group col-md-12">
                     <textarea rows="6" cols="50" class="input-text js-input  form-control"  type="text"  name="message"  required></textarea>
                  </div>
                  <div class="form-field   col-md-12 align-center">
                    <button class="btn btn-primary px-4 py-3 mr-md-2 col-md-12  "><span class="icon-chat"></span> Send
                       <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                           width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                        <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                        <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                            C22.32,8.481,24.301,9.057,26.013,10.047z">
                          <animateTransform attributeType="xml"
                              attributeName="transform"
                              type="rotate"
                              from="0 20 20"
                              to="360 20 20"
                              dur="0.5s"
                              repeatCount="indefinite"/>
                        </path>
                      </svg>
                  </button>
                  </div>
                  <div id="success" class="col-md-12 align-center">  

                  </div>
               </form>
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

<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
 