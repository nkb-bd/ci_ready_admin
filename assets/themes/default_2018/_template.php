<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title> 
        <?php if (empty($page_title)): ?>
            <?php echo  $this->settings->site_name; ?>  
        <?php elseif (!empty($page_title)): ?>
            <?php echo  $page_title; ?>
        <?php endif ?>
  </title>
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>assets/themes/default/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/themes/default/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
  <meta name="description" content="<?php echo $this->settings->meta_description; ?>">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url()?>assets/themes/default/css/material-kit.css?v=2.0.5" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url()?>assets/themes/default/demo/demo.css" rel="stylesheet" />
  <script src="<?php echo base_url()?>assets/themes/default/js/core/jquery.min.js" type="text/javascript"></script>
  
</head>

<body class="index-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand " href="<?=base_url()?>">
          Home
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item <?php echo (uri_string() == 'components') ? 'active' : ''; ?>">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">apps</i> Components
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="<?=base_url()?>components" class="dropdown-item">
                <i class="material-icons">layers</i> All Components
              </a>
              <a href="https://demos.creative-tim.com/material-kit/docs/2.1/getting-started/introduction.html" class="dropdown-item">
                <i class="material-icons">content_paste</i> Documentation
              </a>
            </div>
          </li>
         
          <?php if (!empty($dynamic_pages)): ?>

          <li class="dropdown nav-item <?php echo ($this->uri->segment(1) == 'pages') ? 'active' : ''; ?>">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
               Pages 
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <?php foreach ($dynamic_pages as $page): ?>
                
                   <a href="<?=base_url()?>pages/<?php echo $page['slug'] ?>" class="dropdown-item">
                     <?php echo $page['title'] ?>
                  </a>
                  
              <?php endforeach ?>
           
            </div>
          </li>

            
          <?php endif ?>
    


        
           <?php if ($this->session->userdata('logged_in')) : ?>
                <?php if ($this->user['is_admin']) : ?>
                    <li class="nav-item ">
                        <a  class="nav-link " href="<?php echo base_url('admin'); ?>"><?php echo lang('core button admin'); ?></a>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?php echo (uri_string() == 'profile') ? 'active' : ''; ?> ">
                   <a  class="nav-link"  href="<?php echo base_url('/profile'); ?>"><?php echo lang('core button profile'); ?></a>
                </li>
           
                <li class="nav-item ">
                    <a  class="nav-link" href="<?php echo base_url('logout'); ?>"> <i class="fa fa-sign-out"></i><?php echo lang('core button logout'); ?></a>
                </li>
            <?php else : ?>
             

                  <li class="nav-item ">
                    <a href="<?=base_url()?>login" class="nav-link" >
                      <i class="fa fa-sign-in"></i> Login
                    </a>
                  </li>

            <?php endif; ?>



          <?php if (!empty($this->settings->twitter)): ?>
                            
            <li class="nav-item">
              <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
                            
          <?php endif ?>   
          
          <?php if (!empty($this->settings->facebook)): ?>
        
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank" data-original-title="Like us on Facebook">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>

          <?php endif ?>   

          <?php if (!empty($this->settings->instagram)): ?>


          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank" data-original-title="Follow us on Instagram">
              <i class="fa fa-instagram"></i>
            </a>
          </li>

          <?php endif ?>   

        </ul>
      </div>
    </div>
  </nav>

 
  <?=$content?>
  
   <div class="">


    
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
  </div>
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://creative-tim.com/presentation">
              About Us
            </a>
          </li>
          <li>
            <a href="http://blog.creative-tim.com">
              Blog
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/license">
              Licenses
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url()?>assets/themes/default/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>assets/themes/default/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>assets/themes/default/js/plugins/moment.min.js"></script>
  <!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?php echo base_url()?>assets/themes/default/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url()?>assets/themes/default/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url()?>assets/themes/default/js/material-kit.js?v=2.0.5" type="text/javascript"></script>

   <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Plugin for Sharrre btn -->
  <script src="<?php echo base_url()?>assets/themes/default/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }


    $(document).ready(function() {

      $('#facebook').sharrre({
        share: {
          facebook: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('facebook');
        },
        template: '<i class="fab fa-facebook-f"></i> Facebook',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });

      $('#googlePlus').sharrre({
        share: {
          googlePlus: true
        },
        enableCounter: false,
        enableHover: false,
        enableTracking: true,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('googlePlus');
        },
        template: '<i class="fab fa-google-plus"></i> Google',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });

      $('#twitter').sharrre({
        share: {
          twitter: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        buttons: {
          twitter: {
            via: 'CreativeTim'
          }
        },
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('twitter');
        },
        template: '<i class="fab fa-twitter"></i> Twitter',
        url: 'https://demos.creative-tim.com/material-kit/index.html'
      });

    });
  </script>
</body>

</html>