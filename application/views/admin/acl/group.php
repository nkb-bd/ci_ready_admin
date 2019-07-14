<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


 <div class="card sale-card">
          <div class="card-header">
           
                             <button  href="#new" data-toggle="modal"   class="btn btn-primary ">Add New</button>
            
          </div>
          <div class="card-block">
      
                <?php if ($all_perm): ?>
                            
                        <div class="row">
                            <div class="col-md-3 list-group-item">
                                <strong> Name</strong>
                            </div>
                           
                            <div class="col-md-3 list-group-item">
                                <strong> Action</strong>
                            </div>
                           
                          
                        </div>

                    <?php foreach ($all_perm as $key => $value): ?>

                         <div class="row">
                            <div class="col-md-3 list-group-item">
                                <?php echo $value['groupName'] ?>
                            </div>
                            <div class="col-md-3 list-group-item">
                               <button  href="#edit<?php echo $key; ?>" data-toggle="modal"   class="btn btn-primary btn-xs">Edit</button>

                               <button href="#del<?php echo $key; ?>" data-toggle="modal"    class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </div>
                            
                        </div>

                    <?php endforeach ?>
                    
                <?php endif ?>
               
          </div>
     </div>

<div class="clearfix"></div>




 <?php foreach ($all_perm as $key => $value): ?>

      
<!-- edit Modal -->
<div id="edit<?php echo $key; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Group</h4>
      </div>
      <div class="modal-body">
        
		    <?php echo form_open_multipart('admin/acl/groups/', array('role'=>'form')); ?>

		    <div class="card ">
		        <div class="card-body">
		            		<div class="card-title">Edit Group</div>	
		                    <div class="form-group">
		                        <label for="sub_heading">Name </label>
		                        <input type="text"  name="name"  value="<?php echo $value['groupName'] ?>" class="form-control" id="sub_heading">

		                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
		                    </div>
		                      
		                    
		                    <button type="submit" class="btn btn-primary ">Submit</button>
		                    <a href="<?php echo $cancel_url ?>"  class="btn btn-default">Back</a>
		           
		        </div>
		    </div>



		    <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
     
<!-- delete Modal -->
<div id="del<?php echo $key; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Group</h4>
      </div>
      		<div class="modal-body">

                    <p>Confirm Delete <b class="text-pink"><?php echo $value['groupName'] ?></b class="text-pink">?</p>
            
            </div>
            <div class="modal-footer">
                        
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                    <a   class="btn btn-danger btn-delete-user" href="<?php echo $this_url ?>/delete_group/<?php echo $value	['id']; ?>">delete</a>
             </div>

    
    </div>

  </div>
</div>

<?php endforeach ?>

<!-- new Modal -->
<div id="new" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Group</h4>
      </div>
      		<div class="modal-body">

                 

			    <?php echo form_open_multipart('admin/acl/groups/', array('role'=>'form')); ?>

			    <div class="card ">
			        <div class="card-body">
			            		<div class="card-title">New Group</div>	
			                    <div class="form-group">
			                        <label for="sub_heading">Name </label>
			                        <input type="text"  name="name"  value="" class="form-control" id="sub_heading">
			                    </div>
			                      
			                    
			                    <button type="submit" class="btn btn-primary ">Submit</button>
			                    <a href="<?php echo $cancel_url ?>"  class="btn btn-default">Back</a>
			           
			        </div>
			    </div>



			    <?php echo form_close(); ?>
            
            </div>
         

    
    </div>

  </div>
</div>
