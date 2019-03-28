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
                    <?php echo form_open('',array('role'=>'form','id'=>'form-upload')) ?>
                           

                                <div class="form-group ">
                                   Select Table
                                    <select onchange="this.form.submit()" class="form-control-lg col-md-12" name="tbl" id="">
                                        
                                        <option value="-1" selected="" disabled="">Select Table</option>

                                        <?php    
                                        $tables = $this->db->list_tables();
                                        
                                        foreach($tables as $table) : ?>
                                            
                                            
                                            <option <?php if($table==$tbl_selected){echo 'selected';} ?> value="<?=$table?>"><?=$table?></option>


                                            
                                        <?php   endforeach; ?>
                                    
                                       
                                    </select>

                                </div>
                    <?php echo form_close() ?>

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
                   <?php echo   ucfirst($tbl_field[1]) ?>
                </td>
                <td>
                   <?php echo   ucfirst($tbl_field[2]) ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=image&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">
                          <?php echo ucfirst($tbl_field[3]); ?>
                    </a>
                    <?php if ($sort == 'image') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
           
                <td>
                    <a href="<?php echo current_url(); ?>?sort=status&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">

                       Deleted
                    </a>
                    <?php if ($sort == 'status') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
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
                        <td<?php echo (($sort == 'heading') ? ' class="sorted"' : ''); ?>>
                            <?php  echo substr($data[$tbl_field[1]], 0, 25); ?>
                        </td>
                        <td<?php echo (($sort == 'sub_heading') ? ' class="sorted"' : ''); ?>>
                            <?php  echo substr($data[$tbl_field[2]], 0, 25); ?>
                        </td>
                        <td<?php echo (($sort == 'path') ? ' class="sorted"' : ''); ?>>

                             <?php  echo substr($data[$tbl_field[2]], 0, 25); ?>
                        </td>
                    
                        <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                          
                          
                            <?php echo  time_elapsed_string($data['updated']); ?>

                        </td>
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                  
                                        <a href="#modal-<?php echo $data['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs" id="<?php echo ('admin button delete'); ?>">Delete Permanently <span class="fa fa-trash"></span></a>
                                  

                                    <a href="<?php echo $this_url ?>/restore_single/<?=$tbl_selected?>/<?php echo $data['id']; ?>" class="btn btn-warning btn-xs bttn_loader" id="<?php echo ('admin button edit'); ?>">Restore <span class="fa fa-check"></span></a>
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
                        <option value="10"<?php echo ($limit == 10 OR ($limit != 10 && $limit != 25 && $limit != 50 && $limit != 75 && $limit != 100)) ? ' selected' : ''; ?>>10 <?php echo ('admin input items_per_page'); ?></option>
                        <option value="25"<?php echo ($limit == 25) ? ' selected' : ''; ?>>25 <?php echo ('admin input items_per_page'); ?></option>
                        <option value="50"<?php echo ($limit == 50) ? ' selected' : ''; ?>>50 <?php echo ('admin input items_per_page'); ?></option>
                        <option value="75"<?php echo ($limit == 75) ? ' selected' : ''; ?>>75 <?php echo ('admin input items_per_page'); ?></option>
                        <option value="100"<?php echo ($limit == 100) ? ' selected' : ''; ?>>100 <?php echo ('admin input items_per_page'); ?></option>
                    </select>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php echo $pagination; ?>
            </div>
            <div class="col-md-2 text-right">
                <?php if ($total) : ?>
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" id="<?php echo (' Csv Export'); ?>"><span class="fa fa-export"></span> <?php echo ('admin button csv_export'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php // delete modal ?>
<?php if ($total) : ?>
    <?php foreach ($page_data as $data) : ?>
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
                        <a  class="btn btn-danger btn-delete-user" href="<?php echo $this_url ?>/del_single/<?=$tbl_selected?>/<?php echo $data['id']; ?>">delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<script>    
$(function(){
    
    var bttn_loader = document.querySelector('.bttn_loader');
    
    bttn_loader.addEventListener("click", function() {
        bttn_loader.innerHTML = "Signing In";
        bttn_loader.classList.add('spinning');
        
      setTimeout( 
            function  (){  
                bttn_loader.classList.remove('spinning');
                bttn_loader.innerHTML = "Sign In";
                
            }, 6000);
    }, false);
    
});