<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
   <!-- Added by HTTrack -->
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <title>
          <?php if (empty($page_title)): ?>
            <?php echo  $this->settings->site_name; ?>  
        <?php elseif (!empty($page_title)): ?>
            <?php echo  $this->settings->site_name; ?> - <?php echo  $page_title; ?>
        <?php endif ?>
      </title>
      <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <meta charset="utf-8">
      <META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="colorlib" />
      <link rel="icon" href="<?=base_url()?>favicon.ico" type="image/x-icon">
      <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>favicon.ico">

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_asset/bower_components/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>admin_asset/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_asset/assets/icon/feather/css/feather.css">
      <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_asset/assets/css/font-awesome-n.min.css"> -->
      <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_asset/assets/css/widget.css"> -->
      <?php // CSS files ?>
        <?php if (isset($css_files) && is_array($css_files)) : ?>
            <?php foreach ($css_files as $css) : ?>
                <?php if ( ! is_null($css)) : ?>
                    <?php $separator = (strstr($css, '?')) ? '&' : '?'; ?>
                    <link rel="stylesheet" href="<?php echo $css; ?><?php echo $separator; ?>v=<?php echo $this->settings->site_version; ?>"><?php echo "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/themes/admin/css/custom.css">
      
      <script type="text/javascript" src="<?=base_url()?>admin_asset/bower_components/jquery/js/jquery.min.js"></script>

             <?php // Javascript files ?>
    <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php $separator = (strstr($js, '?')) ? '&' : '?'; ?>
                <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?><?php echo $separator; ?>v=<?php echo $this->settings->site_version; ?>"></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
      
   </head>
   <body>
      <div class="loader-bg">
         <div class="loader-bar"></div>
      </div>
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                  <div class="navbar-logo">
                     <a href="<?=base_url()?>admin">
                           <?php echo $this->settings->site_name; ?>
                     </a>
                     <a class="mobile-menu" id="mobile-collapse" href="#!">
                     <i class="feather icon-menu icon-toggle-right"></i>
                     </a>
                     <a class="mobile-options waves-effect waves-light">
                     <i class="feather icon-more-horizontal"></i>
                     </a>
                  </div>
                  <div class="navbar-container container-fluid">
                     <ul class="nav-left">
                        <li class="header-search">
                           <div class="main-search morphsearch-search">
                              <div class="input-group">
                                 <span class="input-group-prepend search-close">
                                 <i class="feather icon-x input-group-text"></i>
                                 </span>
                                 <input type="text" class="form-control" placeholder="Enter Keyword">
                                 <span class="input-group-append search-btn">
                                 <i class="feather icon-search input-group-text"></i>
                                 </span>
                              </div>
                           </div>
                        </li>
                        <li>
                           <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                           <i class="full-screen feather icon-maximize"></i>
                           </a>
                        </li>
                     </ul>
                     <ul class="nav-right">
                        <li class="header-notification">
                           <div class="dropdown-primary dropdown">
                              <!-- <div class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="feather icon-bell"></i>
                                 <span class="badge bg-c-red">5</span>
                              </div> -->
                              <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <li>
                                    <h6>Notifications</h6>
                                    <label class="label label-danger">New</label>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="img-radius" data-cfsrc="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" alt="Generic placeholder image" style="display:none;visibility:hidden;">
                                       <noscript><img class="img-radius" src="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" alt="Generic placeholder image"></noscript>
                                       <div class="media-body">
                                          <h5 class="notification-user">John Doe</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="img-radius" data-cfsrc="<?=base_url()?>admin_asset/assets/images/avatar-3.jpg" alt="Generic placeholder image" style="display:none;visibility:hidden;">
                                       <noscript><img class="img-radius" src="<?=base_url()?>admin_asset/assets/images/avatar-3.jpg" alt="Generic placeholder image"></noscript>
                                       <div class="media-body">
                                          <h5 class="notification-user">Joseph William</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="media">
                                       <img class="img-radius" data-cfsrc="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" alt="Generic placeholder image" style="display:none;visibility:hidden;">
                                       <noscript><img class="img-radius" src="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" alt="Generic placeholder image"></noscript>
                                       <div class="media-body">
                                          <h5 class="notification-user">Sara Soudein</h5>
                                          <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                          <span class="notification-time">30 minutes ago</span>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </li>
                        <li class="user-profile header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <img data-cfsrc="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image" style="display:none;visibility:hidden;">
                                 <noscript><img src="<?=base_url()?>admin_asset/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image"></noscript>
                                 <span>
                                       <?php  echo  $this->session->logged_in['email'] ;  ?>
                                 </span>
                                 <i class="feather icon-chevron-down"></i>
                              </div>
                              <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 
                                 <li>
                                    <a href="<?=base_url()?>admin/users/edit/<?= $this->session->logged_in['id']?>">
                                    <i class="feather icon-user"></i> Profile
                                    </a>
                                 </li>
                               
                                 <li>
                                    <a href="<?php echo base_url('logout'); ?>">
                                    <i class="feather icon-log-out"></i> Logout
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <div class="pcoded-main-container">
               <div class="pcoded-wrapper">
                  <nav class="pcoded-navbar">
                     <div class="nav-list">
                         <?php include('assets/themes/admin/sidebar.php'); ?>
                     </div>
                  </nav>
                  <div class="pcoded-content">
                     <div class="page-header card">
                        <div class="row align-items-end">
                           <div class="col-xl-12 col-md-12">
                              
                                 <!-- system msg -->
                                 <?php // System messages ?>
                                 <?php if ($this->session->flashdata('message')) : ?>
                                 <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('message'); ?>
                                 </div>
                                 <?php elseif ($this->session->flashdata('error')) : ?>
                                 <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('error'); ?>
                                 </div>
                                 <?php elseif (validation_errors()) : ?>
                                 <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo validation_errors(); ?>
                                 </div>
                                 <?php elseif ($this->error) : ?>
                                 <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->error; ?>
                                 </div>
                                 <?php endif; ?>


                           </div>
                           <div class="col-lg-8">
                              <div class="page-header-title">
                                 <i class="feather  icon-activity bg-c-blue"></i>
                                 <div class="d-inline">
                                    <h5><?php if (isset($page_title)): ?>
                                       <?php echo $page_title; ?>
                                    <?php endif ?></h5>
                                    <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="page-header-breadcrumb">
                                 <ul class=" breadcrumb breadcrumb-title">
                                    <li class="breadcrumb-item">
                                       <a href="<?=base_url()?>admin"><i class="feather icon-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       <?php if($this->uri->segment(1)){
                                          $url=$this->uri->segment(1);
                                       ?>
                                       <a href="<?=base_url().$url?>"><?php echo $url; ?>/</a>
                                        <?php  }?>


                                       <?php if(!empty($this->uri->segment(2))){
                                          $url2=$this->uri->segment(2);
                                       ?>
                                       <a href="<?=base_url().$url2?>"><?php echo $url2; ?>/</a>
                                        <?php }  ?>


                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="pcoded-inner-content">
                        <div class="main-body">
                           <div class="page-wrapper">
                              <div class="page-body ">
                                 <?php // Main content ?>
                                 <?php echo $content; ?>
                              </div>
                              </div>
                              
                           </div>
                        </div>
                     </div>

                  </div>
                  <div id="styleSelector"></div>
               </div>
            </div>
         </div>
      </div>
      <!--[if lt IE 10]>
      <div class="ie-warning">
         <h1>Warning!!</h1>
         <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
         </p>
         <div class="iew-container">
            <ul class="iew-download">
               <li>
                  <a href="http://www.google.com/chrome/">
                     <img src="<?=base_url()?>admin_asset/assets/images/browser/chrome.png" alt="Chrome">
                     <div>Chrome</div>
                  </a>
               </li>
               <li>
                  <a href="https://www.mozilla.org/en-US/firefox/new/">
                     <img src="<?=base_url()?>admin_asset/assets/images/browser/firefox.png" alt="Firefox">
                     <div>Firefox</div>
                  </a>
               </li>
               <li>
                  <a href="http://www.opera.com">
                     <img src="<?=base_url()?>admin_asset/assets/images/browser/opera.png" alt="Opera">
                     <div>Opera</div>
                  </a>
               </li>
               <li>
                  <a href="https://www.apple.com/safari/">
                     <img src="<?=base_url()?>admin_asset/assets/images/browser/safari.png" alt="Safari">
                     <div>Safari</div>
                  </a>
               </li>
               <li>
                  <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                     <img src="<?=base_url()?>admin_asset/assets/images/browser/ie.png" alt="">
                     <div>IE (9 & above)</div>
                  </a>
               </li>
            </ul>
         </div>
         <p>Sorry for the inconvenience!</p>
      </div>
      <![endif]-->
      <script type="text/javascript" src="<?=base_url()?>admin_asset/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>admin_asset/bower_components/popper.js/js/popper.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>admin_asset/bower_components/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?=base_url()?>admin_asset/assets/pages/waves/js/waves.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>admin_asset/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
      <script src="<?=base_url()?>admin_asset/assets/js/pcoded.min.js"></script>
      <script src="<?=base_url()?>admin_asset/assets/js/vertical/vertical-layout.min.js"></script>
 
      <script type="text/javascript" src="<?=base_url()?>admin_asset/assets/js/script.min.js"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'UA-23581568-13');
      </script>
   </body>
</html>