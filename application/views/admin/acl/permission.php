<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



    <?php echo form_open_multipart('admin/acl/add_permission/', array('role'=>'form','id'=>'form-upload')); ?>
    

<div class="panel panel-default card card-body">

    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title">Permission Type List </h3>
                <p> (for developers to check with controllers and methods)</p>
            </div>
            <div class="col-md-6 text-right">
                

            </div>
        </div>
    </div>

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
                   

               

                      
                    
                    <button type="submit" class="btn btn-primary ">Add New</button>
           
        </div>
        </div>
        <div>

            <ul class="list-group container">
            
              
                <?php if ($all_perm): ?>
                            
                        <div class="row">
                            <div class="col-md-3 list-group-item">
                                 <h4>   Module Name</h4>
                            </div>
                            <div class="col-md-3 list-group-item">
                                <h4>Permission</h4></strong>
                                
                            </div>
                            <div class="col-md-6 list-group-item">
                                <h4> Key</h4>
                                
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

</div>