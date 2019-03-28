<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="<?php echo base_url()?>assets/themes/default/js/core/jquery.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/themes/admin/js/fileinput.js"></script>
  <style>
      .btn-file {
      width: 100%;
      overflow: hidden;
  }
  </style>
<div class="card card-body">
  <form action="<?php echo base_url(); ?>admin/Images/add" method="post"  id="form-upload" enctype="multipart/form-data">

  <div class="row">
    <div class="form-group col-xs-12 col-sm-6 col-md-6">
      <input maxlength="40 " type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
    </div>
  </div>

  <?php // hidden id ?>
  <?php if (isset($user_id)) : ?>
  <?php echo form_hidden('id', $user_id); ?>
  <?php endif; ?>


  <div class="row">
    <div class="form-group col-md-3<?php echo form_error('description') ? ' has-error' : ''; ?>">
      <?php echo form_label('Notes', 'description', array('class'=>'control-label')); ?>
    </div>
    <div class="col-md-6">
      <?php echo form_textarea(array('name'=>'notes','rows'=>'4', 'value'=>set_value('description', (isset($user['description']) ? $user['description'] : '')), 'class'=>'form-control')); ?>
    </div>
  </div>
  
  <div class="row  m-t-20">


    <?php // first name ?>
    <div class="form-group col-md-3<?php echo form_error('description') ? ' has-error' : ''; ?>">
      Images
    </div>
    <div class="col-md-6">

      <div class="file-loadings"> 
        <input id="file-3" name="images[]" required="" type="file" data-msg-placeholder="Select {files} for upload..." multiple>
  </div>
      <!-- <input id="file-3"  multiple="" name="userfile" type="file"> -->
      <div class="progress m-t-10" style="display:none;">
        <div id="progress-bar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
          20%
        </div>
      </div>
    </div>
    <?php // last name ?>
  </div>
  

  <br>
  
  <?php // buttons ?>
  <div class="row">
    <div class="col-md-3">&nbsp;</div>
    <a class="btn btn-link" href="<?php echo $cancel_url; ?>">Back</a>
    <button type="submit"  class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Save</button>
  </div>
  <?php echo form_close(); ?>
  <br>
  <div class="row m-t-20">
    <div class="col-md-3">&nbsp;</div>
    <div class="col-md-6">
      <?php if ($user): ?>
      <p class="text-custom">  Created &nbsp;&nbsp;: <?php echo date('d - M - Y  h:i',strtotime($user['created'])) ?> </p>
      <p class="text-info"> Updated &nbsp;: <?php echo date('d - M - Y  h:i:s',strtotime($user['updated'])) ?></p>
      <?php endif ?>
    </div>
  </div>
</div>
<script>
  $("#file-3").fileinput({

    rtl: true,
        dropZoneEnabled: false,
        allowedFileExtensions: ["jpg", "png", "gif"],
      showUpload: false,
      showRemove: true,
      showCaption: false,
      browseClass: "btn btn-primary btn-md"
  
  });
  
  $(function () {
      var inputFile = $('input[name=userfile');
      var uploadURI = $('#form-upload').attr('action');
      var progressBar = $('#progress-bar');
      var inputFile = $('#file-3').prop('files');
  
      $("form#form-upload").submit(function () {
          event.preventDefault();
          var fileToUpload = inputFile;
          // make sure there is file to upload
          if (fileToUpload != 'undefined') {
              // provide the form data
              // that would be sent to sever through ajax
              var formData = new FormData($(this)[0]);
              // now upload the file using $.ajax
              $.ajax({
                  url: uploadURI,
                  type: 'post',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function (data) {
                        
                      console.log(data)
                      if (data.result == '1') {
  
                          
                     var alert = '<div class="alert alert-success "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close-line-circled text-white"></i></button>  '+data.message+' </div>';
                       

                    // add the alert div to top of alerts-container, use append() to add to bottom
                    $(".card-body").prepend(alert);


                      } else {
                        var alert = '<div class="alert alert-danger "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close-line-circled text-white"></i></button>  '+data.message+' </div>';
                       
                           $(".card-body").prepend(alert);
                      }
  
                      $('.progress').fadeOut('slow');
                      progressBar.text("");

                      $('#form-upload').get(0).reset();
                      // progressBar.css({width: "0%"});
                       
                  },
                  xhr: function () {
                      var xhr = new XMLHttpRequest();
                      xhr.upload.addEventListener("progress", function (event) {
                          if (event.lengthComputable) {
                              var percentComplete = Math.round((event.loaded / event.total) * 100);
                              // console.log(percentComplete);
  
                              $('.progress').fadeIn('400');
                              progressBar.css({width: percentComplete + "%"});
                              progressBar.text(percentComplete + '%');
                          }
                          
                      }, false);
                      return xhr;
                  }
              });
          }
      });
      // $('body').on('change.bs.fileinput', function (e) {
      //     $('.progress').hide();
      //     progressBar.text("0%");
      //     progressBar.css({width: "0%"});
      // });
  
  
      //album create
  
  });
  
</script>