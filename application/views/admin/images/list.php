<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default card card-body">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title"><?php $page_header; ?></h3>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary tooltips" href="<?php echo $this_url ?>/add" title="Add new " data-toggle="tooltip"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover-warning">
        <thead>

            <?php // sortable headers ?>
            <tr>
                <td>
                    
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=name&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Daterange</a>
                    <?php if ($sort == 'Daterange') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
             
                <td class="pull-right">
                    Actions
                </td>
            </tr>

            <?php // search filters ?>
            <tr>
                <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                    <th>
                    </th>
                    <th<?php echo ((isset($filters['daterange'])) ? ' class="has-success"' : ''); ?>>
                        <!-- <?php echo form_input(array('name'=>'name', 'id'=>'name', 'class'=>'form-control input-sm', 'placeholder'=>('users input name'), 'value'=>set_value('name', ((isset($filters['name'])) ? $filters['name'] : '')))); ?> -->

                       <input id="daterangepicker" name="date" class="form-control block">
                    </th>
                   
                    
                    <th colspan="3">
                        <div class="text-right">
                            <a href="<?php echo $this_url; ?>" class="btn btn-danger btn-sm tooltips" data-toggle="tooltip" name="<?php echo ('admin tooltip filter_reset'); ?>"><span class="fa fa-refresh"></span> Reset Filter</a>

                            <button type="submit" name="submit" value="<?php echo ('core button filter'); ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" name="<?php echo ('admin tooltip filter'); ?>"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                    </th>
                <?php echo form_close(); ?>
            </tr>

        </thead>
        <tbody>

        </tbody>
    </table>
            <div class="row">
            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($page_data as $data) : ?>
                            <div  class="col-sm-4 col-md-2 ">
                                <a href="#"  class="" data-toggle="modal" data-target="#myModal<?php echo $data['id']?>">
                                  

                                
                                <img src="<?php echo base_url() ?><?php echo $data['path']; ?>"  class="img-fluid rounded " alt="<?php echo $data['name']; ?>">

                                </a>
                            
                            </div>

                   
                <?php endforeach; ?>
            <?php else : ?>
              
            <?php endif; ?>

            </div>

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
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" name="<?php echo ('admin tooltip csv_export'); ?>"><span class="fa fa-export"></span> <?php echo ('csv export'); ?></a>
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
                    <div class="modal-header">
                        <h4 id="modal-label-<?php echo $data['id']; ?>">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Confirm Delete <b class="text-pink"> <?php echo $data['name'] ?> </b class="text-pink">?</p>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                        <a  class="btn btn-danger btn-delete-user" href="<?php echo base_url() ?>admin/gallery/delete/<?php echo $data['id']; ?>">delete</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <!-- img details Modal -->
            <div class="modal fade" id="myModal<?php echo $data['id']?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title"><?php echo $data['name']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                                <img src="<?php echo base_url() ?><?php echo $data['path']; ?>"  class="img-fluid " alt="<?php echo $data['name']; ?>">

                                <div class="card">
                                <div class="card-header">
                                <h5>Img Url</h5>
                                </div>
                                <div class="card-block">
                                <p><?php echo $data['path']; ?></p>
                                </div>
                                </div>
                   
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                   <p class="pull-left"> Uploaded :  <?php echo my_date($data['created']); ?>  </p>
                        <a  class="btn btn-danger btn-delete-user" href="<?php echo base_url() ?>admin/images/delete/<?php echo $data['id']; ?>">delete</a>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

                </div>
              </div>
            </div>

    <?php endforeach; ?>
<?php endif; ?>

<script>    
<?php $this->load->view('admin/inc/daterangepicker')  ?>
</script>
