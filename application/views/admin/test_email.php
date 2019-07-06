    <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-body">

<form action="<?=base_url()?>admin/dashboard/test_email" method="get">

  

    <div class="row">
        <?php // email ?>
        <div class="form-group col-md-3<?php echo form_error('email') ? ' has-error' : ''; ?>">
            <label for="    ">Email</label>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // first name ?>
        <div class="form-group col-md-3<?php echo form_error('name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Name', 'name', array('class'=>'control-label')); ?>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($user['name']) ? $user['name'] : '')), 'class'=>'form-control')); ?>
        </div>

    </div>


  

    <?php // buttons ?>
    <div class="row">
         <div class="col-md-3">&nbsp;</div>
        
        <button type="submit" name="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Send</button>
    </div>

<?php echo form_close(); ?>

</div>