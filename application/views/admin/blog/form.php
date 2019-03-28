    <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card card-body">

<?php echo form_open_multipart('', array('role'=>'form')); ?>

    <?php // hidden id ?>
    <?php if (isset($user_id)) : ?>
        <?php echo form_hidden('id', $user_id); ?>
    <?php endif; ?>

    <div class="row">
        <?php // title ?>
        <div class="form-group col-md-3<?php echo form_error('username') ? ' has-error' : ''; ?>">
            <?php echo form_label('Title', 'title', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'title', 'value'=>set_value('title', (isset($user['title']) ? $user['title'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // exerpt ?>
        <div class="form-group col-md-3<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Excerpt', 'excerpt', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'excerpt', 'value'=>set_value('excerpt', (isset($user['excerpt']) ? $user['excerpt'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // last name ?>
    </div>
    <div class="row">    
        <div class="form-group col-md-3<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Slug', 'slug', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'slug', 'value'=>set_value('slug', (isset($user['slug']) ? $user['slug'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // img ?>

        <div class="form-group col-md-3">
            <?php echo form_label('Chnage Cover Image', 'image', array('class'=>'control-label')); ?>
        </div>
        <div class="col-md-6">
            <input type="file" name="image" class="control-label"  alt="image">
            
        </div>
        

   
    </div>
    <div class="row form-group">   

        <?php if (!empty($user['image'])) { ?>

         <div class="form-group col-md-3">
            <?php echo form_label(' Cover Image', 'image', array('class'=>'control-label')); ?>
        </div>
            
            <div class="col-md-6">

            
                    <img width="320px" class="img-resposive" src=" <?php echo base_url() ?><?php echo $user['image'] ?>">
                 </div>
            <?php } ?>
            
    </div>

<?php 
 function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
  }

  $bodyData = utf8_urldecode(isset($user['body']) ? $user['body'] : '');
?>
    <div class="row">    
        <div class="form-group col-md-3<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Meta Keywords', 'meta_keywords', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'meta_keywords', 'value'=>set_value('meta_keywords', (isset($user['meta_keywords']) ? $user['meta_keywords'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">    
        <div class="form-group col-md-3<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Meta Description', 'meta_description', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
              <?php echo form_input(array('name'=>'meta_description', 'value'=>set_value('meta_description', (isset($user['meta_description']) ? $user['meta_description'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>


    <div class="row">    
        <div class="form-group col-md-3<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label('Page Body', 'meta_description', array('class'=>'control-label')); ?>
            <span class="required">*</span>
          
        </div>
        <div class="col-md-6">
             
              <textarea name="body" id="body-editor"  class="form-control editor" cols="30" rows="10">
                  <?php echo $bodyData ?>
              </textarea>
        </div>
    </div>






    <div class="row">
         <div class="col-md-3">&nbsp;</div>
        <div class="form-group col-md-3<?php echo form_error('status') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input status'), '', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($user['status']) OR (isset($user['status']) && (int)$user['status'] == 1) OR $user['id'] == 1) ? 'checked' : FALSE))); ?>
                    Active
                </label>
            </div>
            <?php if ( ! $user['id'] OR $user['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-2', 'value'=>'0', 'checked'=>((isset($user['status']) && (int)$user['status'] == 0) ? 'checked' : FALSE))); ?>
                       Inactive
                    </label>
                </div>
            <?php endif; ?>
        </div>


        <?php // body ?>
        
    </div>

  

    <?php // buttons ?>
    <div class="row">
         <div class="col-md-3">&nbsp;</div>
        
        <a class="btn btn-link" href="<?php echo $cancel_url; ?>">Cancel</a>
        <button type="submit"  class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
    </div>

<?php echo form_close(); ?>

</div>

<script>

    $('.editor').on('summernote.paste', function(e, ne) {
 

  //your other options here...
        onpaste: function(e) {
            var thisNote = $(this);
            var updatePastedText = function(someNote){
                var original = someNote.code();
                var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
            };
            setTimeout(function () {
                //this kinda sucks, but if you don't do a setTimeout, 
                //the function is called before the text is really pasted.
                updatePastedText(thisNote);
            }, 10);


        }
});
</script>