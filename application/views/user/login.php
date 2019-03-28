<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>




<div class="page-header header-filter" style="background-image: url('https://source.unsplash.com/featured/?digital'); background-size: cover; background-position: top center;">
      

         <?php if ($this->settings->template!='default'): ?>
     <?php  //fix ingstyle ?> <!--  -->
          
          <style>
            .fix-login{
              min-height: 40vh;
              margin-top: 200px;
            }
          </style>
      <?php endif ?>

    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 ml-auto mr-auto  fix-login">
          <div class="card card-login">
                <?php echo form_open('', array('class'=>'form', 'autocomplete'=>"off")); ?>
              <div class="card-header  animated fadeInDown card-header-info text-center">
                <h4 class="card-title">Login</h4>
                <div class="social-line">
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-facebook-square"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="fa fa-google-plus"></i>
                  </a>
                </div>
              </div>
              
              <!-- <p class="description text-center">Or Be Classical</p> -->
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    
                  </div>
                  <input type="text" name="username" class="form-control" placeholder="User Name /Email" onfocus="this.removeAttribute('readonly');" readonly>
                </div>
              <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    
                  </div>
                  <input type="password" name="password"   class="form-control" placeholder="Password..." onfocus="this.removeAttribute('readonly');" readonly>
                </div>
              </div>
              <div class="footer text-center">
                <button class="btn btn-success  btn-custom  btn-lg">Get Started</button>
              </div>

               <!-- fo forget pass -->
                <!-- <p class="text-center"><br /><a class="btn btn-link" href="<?php echo base_url('user/forgot'); ?>"><?php echo lang('users link forgot_password'); ?></a></p> -->
                <!-- <p  class="text-center"><a class=" btn-link btn-block"  href="<?php echo base_url('user/register'); ?>"><?php echo lang('users link register_account'); ?></a></p> -->
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>

     <br>
        <br>
        <br>
</div>

