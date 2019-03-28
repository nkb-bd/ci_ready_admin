<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default card card-body">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title"><?php $page_header; ?></h3>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary tooltips" href="<?php echo base_url('admin/pages/add'); ?>" title="Add new " data-toggle="tooltip"><i class="fa fa-plus"></i>Add New</a>
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
                    <a href="<?php echo current_url(); ?>?sort=title&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Title</a>
                    <?php if ($sort == 'title') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=slug&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Slug</a>
                    <?php if ($sort == 'slug') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=image&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Image</a>
                    <?php if ($sort == 'image') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
           
                <td>
                    <a href="<?php echo current_url(); ?>?sort=status&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>">Status</a>
                    <?php if ($sort == 'status') : ?><span class="fa fa-toggle-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
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
                    <th<?php echo ((isset($filters['title'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'title', 'id'=>'title', 'class'=>'form-control input-sm', 'placeholder'=>('users input title'), 'value'=>set_value('title', ((isset($filters['title'])) ? $filters['title'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['slug'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'slug', 'id'=>'slug', 'class'=>'form-control input-sm', 'placeholder'=>('users input slug'), 'value'=>set_value('slug', ((isset($filters['slug'])) ? $filters['slug'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['image'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'image', 'id'=>'title', 'class'=>'form-control input-sm', 'placeholder'=>('users input image'), 'value'=>set_value('image', ((isset($filters['image'])) ? $filters['image'] : '')))); ?>
                    </th>
                    <th colspan="3">
                        <div class="text-right">
                            <a href="<?php echo $this_url; ?>" class="btn btn-danger btn-sm tooltips" data-toggle="tooltip" title="<?php echo ('admin tooltip filter_reset'); ?>"><span class="fa fa-refresh"></span> Reset Filter</a>
                            <button type="submit" name="submit" value="<?php echo ('core button filter'); ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" title="<?php echo ('admin tooltip filter'); ?>"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                    </th>
                <?php echo form_close(); ?>
            </tr>

        </thead>
        <tbody>

            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($page_data as $data) : ?>
                    <tr>
                        <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['id']; ?>
                        </td>
                        <td<?php echo (($sort == 'title') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['title']; ?>
                        </td>
                        <td<?php echo (($sort == 'slug') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['slug']; ?>
                        </td>
                        <td<?php echo (($sort == 'image') ? ' class="sorted"' : ''); ?>>
                            <?php echo $data['image']; ?>
                        </td>
                    
                        <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                            <?php echo ($data['status']) ?  "Active" : "InActive"; ?>
                        </td>
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                  
                                        <a href="#modal-<?php echo $data['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs" title="<?php echo ('admin button delete'); ?>"><span class="fa fa-trash"></span></a>
                                  

                                    <a href="<?php echo $this_url; ?>/edit/<?php echo $data['id']; ?>" class="btn btn-warning btn-xs" title="<?php echo ('admin button edit'); ?>"><span class="fa fa-edit"></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">
                        <?php echo ('core error no_results'); ?>
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
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-primary btn-sm tooltips" data-toggle="tooltip" title="<?php echo ('admin tooltip csv_export'); ?>"><span class="fa fa-export"></span> <?php echo ('admin button csv_export'); ?></a>
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
                        <p>Confirm Delete <b class="text-pink"> <?php echo $data['title'] ?> </b class="text-pink">?</p>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                        <a  class="btn btn-danger btn-delete-user" href="<?php echo base_url() ?>admin/pages/delete/<?php echo $data['id']; ?>">delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

