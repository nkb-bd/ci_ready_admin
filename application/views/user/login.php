


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 col-md-4 col-sm-6 col-xs-12 ">

                  

                  <?php echo form_open('', 'class="login100-form validate-form"'); ?>


                <div class="text-center js-tilt" data-tilt>
                  <h1><?=$this->settings->site_name?></h1>
                </div>

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
                            <span class="login100-form-title">
                               Login
                            </span>

                            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                              <input class="input100" type="text" name="username" placeholder="Email">
                              <span class="focus-input100"></span>
                              <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                              </span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                              <input class="input100" type="password" name="password" placeholder="Password">
                              <span class="focus-input100"></span>
                              <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                              </span>
                            </div>
                            
                            <div class="container-login100-form-btn">
                              <button class="login100-form-btn">
                                Login
                              </button>
                            </div>

                            <div class="text-center p-t-12">
                              <span class="txt1">
                                Forgot
                              </span>
                              <a class="txt2" href="<?php echo base_url('user/forgot'); ?>">
                                Username / Password?
                              </a>
                            </div>

                            <div class="text-center p-t-12">
                             
                              <a class="btn btn-primary " href="<?php echo base_url(''); ?>">
                               Back to  Home 
                              </a>
                            </div>

                            
                          </form>

                    </div>
        </div>
    </div>