




    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 col-md-4 col-sm-6 col-xs-12 ">
               

                    <?php echo form_open('', array('class'=>'form', 'autocomplete'=>"off")); ?>
                    <div class="  animated fadeIn  text-center">

                        <div class="text-center js-tilt" data-tilt>
                          <h1><?=$this->settings->site_name?></h1>
                        </div>
                        <h4 class="card-title">
                            Forgot Password
                        </h4>
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
                    <!-- <p class="description text-center">Or Be Classical</p> -->
                    <div class="card-body">
                        <br>
                 


                          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''?>" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                          </div>
                    </div>
                    <div class="footer text-center">
                        <br><br>
                        <button class="btn btn-info  ">Submit
                        </button>
                         <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                    </div>

                    <p class="text-center">
                        <br><br>
                       
                        <br>
                        <a class=" btn btn-primary"  href="<?php echo base_url('user/login'); ?>">
                       Login
                        </a>
                    </p>

                       <div class="text-center p-t-12">
           
                        <a class="btn btn-primary " href="<?php echo base_url(''); ?>">
                         Back to  Home 
                        </a>
                      </div>
                    <?php echo form_close(); ?>

                    </div>
        </div>
    </div>