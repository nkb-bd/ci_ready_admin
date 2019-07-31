<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css" />
<!-- css fix -->
<style>
  .icheckbox_flat-green {
    position: relative;
    float: right;
}
</style>

<div class="panel panel-info  card card-body">
    <div class="panel-heading">
        <div class="row">

        


          <!-- user group list -->

          <?php echo form_open_multipart('admin/acl/', array('role'=>'form','class'=>'col-md-12')); ?>

  
          <div class="card ">
              <div class="card-body">
                      <div class="col-md-12 ">Select a user Group</div> 


                          <div class="form-group col-md-12">
                              <label for="sub_heading">Group </label>
                              <select name="groupID" class="  form-control" id="grp_perm">

                                <?php if ($all_grp): ?>
                                  <?php foreach ($all_grp as $key => $value): 

                                     if ($this->session->flashdata('grp_id')){
                                      $groupID = $this->session->flashdata('grp_id');
                                     }

                                    ?>
                                      
                                      <option <?php echo ($groupID == $value['id'])?'selected':'' ?> value="<?php echo $value['id'] ?>"><?php echo $value['groupName'] ?></option>
                                    
                                  <?php endforeach ?>
                                <?php endif ?>
                              </select>
                          </div>
                          <input type="hidden" name="view_permission" value="0">
                      
                          <div class="form-group col-md-12">
                            
                            <button type="submit" class="btn btn-primary ">Show</button>

                            <a  href="#new" data-toggle="modal"   class="btn btn-primary ">Add New Permission</a>
                          </div>
                 
              </div>
          </div>



          <?php echo form_close(); ?>
      </div>
    </div>
</div>

<!-- permission list -->
<div class="card">
            
    <div class="card-body ">
               
 
              <?php if ($grp_permission_list): ?>

              <h4>Permission List of user group : <?php echo $grp_permission_list[0]['groupName'] ?>   </h4>
                  <ul class="list-group">

                     <li class="list-group-item "   > 

                        <strong> ALl Module  <span class="pull-right">
                          
                           <?php  #if ($this->user['user_type']!=1):?> 
                           <?php if (true):?> 
                           
                            <input type="checkbox" id="checkAll" class="flat-red checkAll " ></span> 

                          <?php endif; ?>

                        </strong>

                       </li>
                    <?php 
                    $temp ='';
                    foreach ($grp_permission_list as $key => $value):

                       if($temp != $value['module_name'] ){

                        $temp = $value['module_name'];
                    ?>
                    </div>
                    </li>
                       <li class="list-group-item list-group-item-info"  > 

                        <strong> <?php echo $temp ?></strong>

                       </li>
                       <li class="list-group-item" style="min-height: 70px;"  > 
                        <div class="row"> 

                    <?php

                    }

                     ?>

                      
                        <div class="col-md-3"> 
                            <strong  style="margin-left: 10px;"> 
                              <?php echo $value['name'] ?>
                            </strong>
                            <!-- hidden key( key  :  <?php echo $value['key'] ?>)   -->

                            <?php if (($value['key']=='acl_view')||($value['key']=='acl_update')||($value['key']=='dashboard_view')&&($this->user['user_type']==1)&&($groupID==1)): ?>

                                  <i class="fa fa-check pull-left"> </i>
                                  *can not be modified

                            <?php else: ?>
                             <input type="checkbox" <?php echo( $value['status']==1?'checked':'') ?> class=" flat-red flat-red-ajax" data-permid="<?php echo $value['permission_id'] ?>" data-grpid="<?php echo $value['groupID'] ?>">

                              <?php endif ?>
                        </div>
                      
                      
                  <?php 
                  endforeach ?>
                   </ul> 
                    
              <?php else: ?>
                  
                  <p>No permission set for this user group ! </p>

              <?php endif ?>

    </div>

</div>




<!-- new permission Modal -->
<div id="new" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Permission</h4>
      </div>
          <div class="modal-body">

                 
        <?php echo form_open_multipart('admin/acl/', array('role'=>'form')); ?>

  
          <div class="card ">
              <div class="card-body">
                      <div class="">Assign permission to group</div> 


                          <div class="form-group ">
                              <label for="sub_heading">Group </label>
                              <select name="groupID" class="form-control" id="">

                                <?php if ($all_grp): ?>
                                  <?php foreach ($all_grp as $key => $value): ?>
                                      
                                      <option value="<?php echo $value['id'] ?>"><?php echo $value['groupName'] ?></option>
                                    
                                  <?php endforeach ?>
                                <?php endif ?>
                              </select>
                          </div>
                            
                          <div class="form-group ">
                              <label for="sub_heading">Permission </label>
                              <select name="permissionID" class="form-control" id="">
                                
                                <?php if ($all_perm): ?>
                                  <?php foreach ($all_perm as $key => $value): ?>
                                      
                                      <option value="<?php echo $value['id'] ?>"><?php echo $value['permission'] ?> <span class=" strong"> ( Module :   <?php echo $value['module_name'] ?>)</span>
                                      </option>
                                    
                                  <?php endforeach ?>
                                <?php endif ?>
                              </select>
                          </div>
                            
                          <div class="form-group ">
                            
                            <button type="submit" class="btn btn-primary ">Add</button>
                            <a href="<?php echo $cancel_url ?>"  class="btn btn-default">Back</a>
                          </div>
                 
              </div>
          </div>



          <?php echo form_close(); ?>
            
            </div>
         

    
    </div>

  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>


    
<script>
  
 jQuery(document).ready(function($) {


   $('#checkAll').on('ifChanged', function(event){

      var checked = $(this).is(":checked");

      if(checked){
        checked = 1;
        $('.flat-red-ajax').iCheck('check');
      }else{
         checked = 0;
         $('.flat-red-ajax').iCheck('uncheck');

      }


   });

  // on chnage submit
  $('#grp_perm').change(
    function(){
         $(this).closest('form').trigger('submit');
        
    });

   //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue pull-left',
      radioClass   : 'iradio_flat-blue'
    })



    $('.flat-red-ajax').on('ifChanged', function(event){

      console.log('x')

      var checked = $(this).is(":checked");
      var perm_id = $(this).data('permid');
      var grp_id  = $(this).data('grpid');

      if(checked){
        checked = 1;
      }else{
         checked = 0;

      }

     

      // approve


      $.ajaxSetup({
          data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          }
      });

      $.ajax({
        url: '<?php echo base_url() ?>admin/acl/set_active',
        type:'post',
        dataType: 'json',
        data: {grp_id: grp_id, checked:checked, perm_id : perm_id },
      })
      .done(function(data) {

        if(data==true){

          $.notify('Permission Updated','info');

          // if same as current user then reload page for security

          if(grp_id === <?php echo $this->user['user_type'] ?>){

          
            // setTimeout(function(){    location.reload();; }, 1000);

          }

        }else{

          $.notify('Error','error');
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
      });
      

    });


 });


</script>

