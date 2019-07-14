<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style> 
.bttn_loader.spinning {
    background-color: @base;
    padding-right: 40px;
}
.bttn_loader.spinning:after {
    content: '';
    position: absolute;
    right: 6px;
    top: 50%;
    width: 0;
    height: 0;
    box-shadow: 0px 0px 0 1px darken(@base,10%);
    position: absolute;
    border-radius: 50%;
    animation: rotate360 .5s infinite linear, exist .1s forwards ease;
}

.bttn_loader.spinning:before {
    content: "";
    width: 0px;
    height: 0px;
    border-radius: 50%;
    right: 6px;
    top: 50%;
    position: absolute;
    border: 2px solid darken(@base,40%);
    border-right: 3px solid @accent;
    animation: rotate360 .5s infinite linear, exist .1s forwards ease ;
    
}



@keyframes rotate360 { 
    100% {
        transform: rotate(360deg);
    }
}
@keyframes exist { 
    100% {
        width: 15px;
        height: 15px;
        margin: -8px 5px 0 0;
    }
}
</style>
<div class="panel panel-default card card-body">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <?php 
  
                    $tbl_field = $this->db->list_fields($tbl_selected);

                          


                ?>

               <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">New Category</button>
                 

            </div>
        </div>
    </div>

    <table class="table table-striped table-hover-warning">
        <thead>

            <?php // sortable headers ?>
            <tr>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Id</a>
                    <?php if ($sort == 'id') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    Name
                </td>
                <td>

                    Parent Category
                </td>
                <td>

                     <a href="<?php echo current_url(); ?>?sort=cat2.price&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">

                       Price
                    </a>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=cat2.created&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">
                          Created
                    </a>
                    <?php if ($sort == 'image') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
           
             
                <td class="pull-right">
                    Actions
                </td>
            </tr>

            <?php // search filters ?>
           

        </thead>
        <tbody>

            <?php // data rows ?>
            <?php if ($total) : ?>

                <?php foreach ($page_data as $data) : 

                    ?>

                    <tr>
                        <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['id']; ?>
                        </td>
                        <td<?php echo (($sort == 'name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['name'] ?>
                        </td>
                        <td<?php echo (($sort == 'parent_name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['parent_name'] ?>

                        </td>
                        <td<?php echo (($sort == 'parent_name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['price'] ?>

                        </td>
                        <td<?php echo (($sort == 'path') ? ' class="sorted"' : ''); ?>>

                             <?php  echo my_date($data['created']); ?>
                        </td>
                    
                       
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                  
                                        <a href="#modal-<?php echo $data['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs" title="<?php echo lang('admin button delete'); ?>"><span class="fa fa-trash"></span></a>
                                  

                                    <a  href="#modal-delete-<?php echo $data['id']; ?>" data-toggle="modal"  class="btn btn-warning btn-xs bttn_loader" id="<?php echo ('admin button edit'); ?>">Edit <span class="fa fa-check"></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">
                       No Result
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

    <?php // list tools ?>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-2 text-left f-w-600">
                <label> <?php echo $total ?> Row(s)  </label>
            </div>
            <div class="col-md-2 text-left">
                <?php if ($total > 10) : ?>
                    <select id="limit" class="form-control">
                        <option value="10"<?php echo ($limit == 10 OR ($limit != 10 && $limit != 25 && $limit != 50 && $limit != 75 && $limit != 100)) ? ' selected' : ''; ?>>10 Per Page</option>
                        <option value="25"<?php echo ($limit == 25) ? ' selected' : ''; ?>>25  Per Page</option>
                        <option value="50"<?php echo ($limit == 50) ? ' selected' : ''; ?>>50  Per Page</option>
                        <option value="75"<?php echo ($limit == 75) ? ' selected' : ''; ?>>75  Per Page</option>
                        <option value="100"<?php echo ($limit == 100) ? ' selected' : ''; ?>>100  Per Page</option>
                    </select>
                <?php endif; ?>
            </div>
            <div class="col-md-6">

                <?php echo $pagination; ?>

            </div>
            <div class="col-md-2 text-right">
                <?php if ($total) : ?>
                    <!-- <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" id="<?php echo (' Csv Export'); ?>"><span class="fa fa-export"></span> CSV EXPORT</a> -->
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php // delete modal ?>
<?php if ($total) : ?>
    <?php foreach ($page_data as $data) : ?>

        <!-- delete confirm -->
        <div class="modal fade" id="modal-<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $data['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  card-red">
                        <h4  class="text-white" style="z-index:2" id="modal-label-<?php echo $data['id']; ?>">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm Delete <b class="text-pink"> <?php echo $data[$tbl_field[1]] ?> </b class="text-pink">?</p>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                        <a  class="btn btn-danger btn-delete-user" href="<?php echo $this_url ?>/delete/<?php echo $data['id']; ?>">delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit  -->
        <div class="modal fade" id="modal-delete-<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $data['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit</h4>
                      </div>
                      <div class="modal-body">
                        <?php echo  form_open('admin/category/edit/'.$data['id']); ?>
                        
                                <div class="form-group">
                                    <label for="main_heading">Name</label>
                                    <input type="text" required="" name="name" value="<?php echo $data['name']; ?>" class="form-control" >
                                </div>
                                
                                <div class="form-group">

                                    <label for="main_heading">Price</label>
                                    <input type="number" name="price" required="" min="0" max="99999999999999999999" value="<?php echo $data['price']; ?>" class="form-control" >
                                
                                </div>
                                <div class="form-group">

                                    <label for="main_heading">Sort Order</label>
                                    <input type="number" name="sort" min="0" max="99999999999999999999" value="<?php echo $data['sort_order']; ?>" class="form-control" >
                                
                                </div>

                                <?php if (isset($page_data)): ?>

                                <div class="form-group">

                                    <label for="main_heading">Parent Category </label>

                                    <select class="form-control" name="parent_category" id="">
                                            <option selected="" value="-1">None</option>
                                        
                                        
                                            
                                            <?php 
                                            $selected='';

                                       
                                                foreach ($page_data as $data2) : 
                                                $selected='';

                                                if ( $data2['id']==$data['id']) {

                                                    continue;
                                                }
                                                if ( $data2['id']==$data['parent_id']) {
                                                    $selected='selected';
                                                }
                                                else{

                                                    $selected='';
                                                }


                                            ?>
                                               


                                             <option  <?php echo $selected; ?> value="<?php echo $data2['id'] ?>"><?php echo $data2['name'] ?>

                                                       
                                                </option>
                                            <?php   endforeach; ?>


                                    </select>

                                </div>
                                <?php endif  ?>

                                <div class="form-group">
                                   <button type="submit" class="btn btn-success">Update</button>
                      
                                </div>


                        <?php echo  form_close(); ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>



    <!-- create new category -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Category</h4>
          </div>
          <div class="modal-body">
            <?php echo  form_open_multipart('admin/category/add'); ?>
            
                    <div class="form-group">

                        <label for="main_heading">Name</label>
                        <input type="text" required="" name="name" value="" class="form-control" >
                    
                    </div>


                    <div class="form-group">

                        <label for="main_heading">Price</label>
                        <input type="number" name="price" required="" min="0" max="99999999999999999999" value="" class="form-control" >
                    
                    </div>
                        
                    <div class="form-group">

                        <label for="main_heading">Sort Order</label>
                        <input type="number" name="sort" min="0" max="99999999999999999999" value="<?php echo $data['sort_order']; ?>" class="form-control" >
                    
                    </div>
                    <?php if (isset($page_data)): ?>

                    <div class="form-group">

                        <label for="main_heading">Parent Category</label>

                        <select class="form-control" name="parent_category" id="">
                            
                            
                                    <option selected="" value="-1">None</option>
                                
                                <?php foreach ($page_data as $data) : 

                                ?>
                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>

                                <?php   endforeach; ?>


                        </select>

                    </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="main_heading">Image</label>
                        <input type="file" required="" name="image" value="" class="form-control" >
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-success">Save</button>
          
                    </div>


            <?php echo  form_close(); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>




