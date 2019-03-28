<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header header-filter" style="background-image: url('https://source.unsplash.com/featured/?digital'); background-size: cover; background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="card card-login">
                    <?php echo form_open('', array('class'=>'form', 'autocomplete'=>"off")); ?>
                    <div class="card-header  animated fadeInDown card-header-info text-center">
                        <h4 class="card-title">Forgot Password
                        </h4>
                    </div>
                    <!-- <p class="description text-center">Or Be Classical</p> -->
                    <div class="card-body">
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="material-icons">email
                                </i>
                                </span>
                            </div>
                            <?php echo form_input(array('placeholder'=>'Your Email','name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <br><br>
                        <button class="btn   btn-custom  ">Submit
                        </button>
                         <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                    </div>

                    <p class="text-center">
                        <br><br>
                        <a class=""  href="<?php echo base_url('user/register'); ?>">
                        <?php echo lang('users link register_account'); ?>
                        </a>
                        <br>
                        <a class=" btn btn-info"  href="<?php echo base_url('user/login'); ?>">
                       Login
                        </a>
                    </p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>