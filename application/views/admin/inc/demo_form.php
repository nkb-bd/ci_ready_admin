<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- main body -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card sale-card">
            <div class="card-header">
                <h5>
                   
                   Demo forms
                    
                </h5>

                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="feather icon-trash close-card"></i></li>
                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                    </ul>
                </div>
            </div>

            <div class="card-block">

                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                        <label for="username" class="control-label">Label</label>
                      
                    </div>

                    <div class="col-md-8">
                          <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($user['name']) ? $user['name'] : '')), 'class'=>'form-control')); ?>
                    </div>

                </div>
                
                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                       <label class="control-label">Date range button:</label>
                    </div>

                    <div class="col-md-8">
                         <div class="input-group">
                            <button type="button" class="btn btn-default float-right" id="daterange-btn">
                              <i class="far fa-calendar-alt"></i> Date range picker
                              <i class="fas fa-caret-down"></i>
                            </button>
                          </div>
                    </div>

                </div>



            </div>
        </div>
    </div>

    
</div>
