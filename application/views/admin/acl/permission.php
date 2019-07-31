<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



    <?php echo form_open_multipart('admin/acl/add_permission/', array('role'=>'form','id'=>'form-upload')); ?>

    <div class="card ">
        <div class="card-body">
            
                    <div class="form-group">
                        <label for="sub_heading">Module </label>
                        <input type="text"  name="module"  value="" class="form-control" id="sub_heading">
                    </div>
                    <div class="form-group">
                        <label for="sub_heading">Information </label>
                        <input type="text"  name="info"  value="" class="form-control" id="sub_heading">
                    </div>
                   
                    <div class="form-group">
                        <label for="sub_heading">Permission Key </label>
                        <input type="text"  name="perm_key"  value="" class="form-control" id="sub_heading">
                    </div>
                   

               

                      
                    
                    <button type="submit" class="btn btn-primary ">Submit</button>
           
        </div>

            <ul class="list-group col-md-10 col-md-offset-1">
            
              
                <?php if ($all_perm): ?>
                            
                        <div class="row">
                            <div class="col-md-3 list-group-item">
                                <strong>Module Name</strong>
                            </div>
                            <div class="col-md-3 list-group-item">
                                <strong>Permission</strong>
                                
                            </div>
                            <div class="col-md-6 list-group-item">
                                <strong>Key</strong>
                                
                            </div>
                        </div>
                    <?php foreach ($all_perm as $key => $value): ?>
                         <div class="row">
                            <div class="col-md-3 list-group-item">
                                <?php echo $value['module_name'] ?>
                            </div>
                            <div class="col-md-3 list-group-item">
                                <?php echo $value['key'] ?>
                                
                            </div>
                            <div class="col-md-6 list-group-item">
                                <?php echo $value['key'] ?>
                                
                            </div>
                        </div>
                    <?php endforeach ?>
                    
                <?php endif ?>
               
        </ul>
    </div>


    <?php echo form_close(); ?>

<div class="clearfix"></div>

