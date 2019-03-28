<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card card-body">

<?php echo form_open_multipart('', array('role'=>'form')); ?>

    <?php // hidden id ?>
    <?php if (isset($user_id)) : ?>
        <?php echo form_hidden('id', $user_id); ?>
    <?php endif; ?>

    <div class="row">
        <?php // name ?>
        <div class="form-group col-md-3<?php echo form_error('name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Name', 'name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($user['name']) ? $user['name'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // first name ?>
        <div class="form-group col-md-3<?php echo form_error('slug') ? ' has-error' : ''; ?>">
            <?php echo form_label('Slug', 'slug', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'slug', 'value'=>set_value('slug', (isset($user['slug']) ? $user['slug'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // last name ?>
    </div>
    <div class="row">    
        <div class="form-group col-md-3<?php echo form_error('description') ? ' has-error' : ''; ?>">
            <?php echo form_label('Description', 'description', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_textarea(array('name'=>'description', 'value'=>set_value('description', (isset($user['description']) ? $user['description'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>







    <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="form-group col-md-3<?php echo form_error('status') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input status'), '', array('class'=>'control-label')); ?>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($user['status']) OR (isset($user['status']) && (int)$user['status'] == 1) ) ? 'checked' : FALSE))); ?>
                    Active
                </label>
                <label>
                    <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-2', 'value'=>'0', 'checked'=>(( ! isset($user['status']) OR (isset($user['status']) && (int)$user['status'] == 0) ) ? 'checked' : FALSE))); ?>
                    Inactive
                </label>
            </div>
          <!--  -->
        </div>


        <?php // body ?>
        
    </div>


  

    <?php // buttons ?>
    <div class="row">
         <div class="col-md-3">&nbsp;</div>

        <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit"  class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>

    <div class="row m-t-20">

         <div class="col-md-3">&nbsp;</div>

        <div class="col-md-6">
            <?php if ($user): ?>
               <p class="text-custom">  Created &nbsp;&nbsp;: <?php echo date('d - M - Y  h:i',strtotime($user['created'])) ?> </p>
               <p class="text-info"> Updated &nbsp;: <?php echo date('d - M - Y  h:i:s',strtotime($user['updated'])) ?></p>

               
            <?php endif ?>
        </div>
    </div>


</div>