<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

     <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 col-md-4 col-sm-6 col-xs-12 ">
               

                    <?php echo form_open('', array('class'=>'form', 'autocomplete'=>"off")); ?>
                    <div class="  animated fadeIn  text-center">

                        <div class="text-center js-tilt" data-tilt>
                          <h1><?=$this->settings->site_name?></h1>
                        </div>
                        <h4 class="card-title">
                            Register
                        </h4>
                    </div>



                    <?php echo form_open('', array('role'=>'form','autocomplete'=>'off')); ?>
                    

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


                    <div class="">
                        <?php // username ?>
                        <div class="form-group  <?php echo form_error('username') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input username'), 'username', array('class'=>'bmd-label-floating control-label  ')); ?>
                            
                            <?php echo form_input(array('name'=>'username', 'value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control')); ?>
                        </div>
                    </div>

                    <div class="">
                        <?php // first name ?>
                        <div class="form-group <?php echo form_error('first_name') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input first_name'), 'first_name', array('class'=>'bmd-label-floating control-label ')); ?>
                            
                            <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
                        </div>

                        <?php // last name ?>
                        <div class="form-group <?php echo form_error('last_name') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input last_name'), 'last_name', array('class'=>'bmd-label-floating control-label ')); ?>
                            
                            <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control')); ?>
                        </div>
                    </div>

                    <div class="">
                        <?php // email ?>
                        <div class="form-group <?php echo form_error('email') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input email'), 'email', array('class'=>'bmd-label-floating control-label ')); ?>
                            
                            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                        </div>
                    </div>
                    <div class="">
                        <?php // email ?>
                        <div class="form-group <?php echo form_error('mobile') ? ' has-error' : ''; ?>">
                            <?php echo form_label('Mobile', 'mobile', array('class'=>'bmd-label-floating control-label ')); ?>
                            
                            <?php echo form_input(array('name'=>'mobile', 'value'=>set_value('mobile', (isset($user['mobile']) ? $user['mobile'] : '')), 'class'=>'form-control', 'type'=>'mobile')); ?>
                        </div>
                    </div>
                    <input type="hidden" name="language" value="english">
                 

                    <div class="">
                        <?php // password ?>
                        <div class="form-group <?php echo form_error('password') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input password'), 'password', array('class'=>'bmd-label-floating control-label ')); ?>
                            <?php if ($password_required) : ?><?php endif; ?>
                            <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                        </div>

                        <?php // password repeat ?>
                        <div class="form-group <?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('users input password_repeat'), 'password_repeat', array('class'=>'bmd-label-floating control-label ')); ?>
                            <?php if ($password_required) : ?><?php endif; ?>
                            <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                        </div>
                        <?php if ( ! $password_required) : ?>
                            <span class="help-block"><br /><?php echo lang('users help passwords'); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php // buttons ?>
                    <div class="">

                        <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                        <?php if ($this->session->userdata('logged_in')) : ?>
                            <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-save"></span> Submit</button>
                        <?php else : ?>
                            <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span> <?php echo lang('users button register'); ?></button>
                        <?php endif; ?>
                        
                        <?php if (!$user['username']) :?>
                            <a class=" btn btn-link"  href="<?php echo base_url('user/login'); ?>"> <u> Login </u></a>

                        <?php endif;?>
                       <p class="text-center">
                       </p>

                    </div>

                <?php echo form_close(); ?>


            </div>
        </div>
    </div>