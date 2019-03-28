<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="<?php echo base_url()?>assets/themes/default/js/core/jquery.min.js" type="text/javascript"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>assets/themes/admin/js/fileinput.js"></script>
  <style>
      .btn-file {
      width: 100%;
      overflow: hidden;
  }
    .hide{
    display: none;
  }
  </style>

<?php if (isset($page_data['id'])): ?>
    <?php echo form_open_multipart('admin/services/edit/'.$page_data['id'], array('role'=>'form','id'=>'form-upload')); ?>

                <input type="hidden" value="<?php echo $page_data['id'] ?>" name="id">

    
<?php endif ?>
<?php if (!isset($page_data['id'])): ?>
    <?php echo form_open_multipart('admin/services/add', array('role'=>'form','id'=>'form-upload')); ?>
    
<?php endif ?>

<div class="card ">
    <div class="card-body">
        
                <div class="form-group">
                    <label for="sub_heading">Title </label>
                    <input type="text"  name="sub_heading"  value="<?php echo isset($page_data['sub_heading']) ? $page_data['sub_heading']: '' ?>" class="form-control" id="sub_heading">
                </div>
                <div class="form-group">
                    <label for="main_heading">Details</label>
                    <input type="text" required="" name="heading" value="<?php echo isset($page_data['heading']) ? $page_data['heading']: '' ?>" class="form-control" id="main_heading">
                </div>

             
                <?php if (!empty($page_data['path'])): ?>
                    <img src="<?php echo base_url() ?><?php echo $page_data['path'] ?>" class="img-resposive" style="max-width: 350px;" alt="">
                <?php endif ?>

          
                  <div class="row  m-t-20">


                    <?php // first name ?>
                    <div class="form-group col-md-3<?php echo form_error('images') ? ' has-error' : ''; ?>">
                        <?php echo isset($page_data['path']) ? 'Change': '' ?>
                      Image
                    </div>
                    <div class="col-md-6">

                      <div class="file-loadings"> 
                        <input id="file-3" name="images" <?php echo isset($page_data['path']) ?'': 'required' ?> type="file" data-msg-placeholder="Select {files} for upload..." single>
                  </div>
                      <!-- <input id="file-3"  multiple="" name="userfile" type="file"> -->
                      <div class="progress m-t-10" style="display:none;">
                        <div id="progress-bar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                        </div>
                      </div>
                    </div>
                    <?php // last name ?>
                  </div>
                  
                
                <button type="submit" class="btn btn-info ">Submit</button>
                <a href="<?php echo base_url() ?>admin/services"  class="btn btn-default">Back</a>
       
    </div>
</div>


<?php echo form_close(); ?>



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
                      $('.progress').hide();
    
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
  
                          
                     var alert = '<div class="alert alert-success "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times text-white"></i></button>  '+data.message+' </div>';
                       

                    // add the alert div to top of alerts-container, use append() to add to bottom
                    $(".card-body").prepend(alert);


                      } else {
                        var alert = '<div class="alert alert-danger "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times text-white"></i></button>  '+data.message+' </div>';
                       
                           $(".card-body").prepend(alert);
                      }
  
                      $('.progress').fadeOut('slow');
                      progressBar.text("");

                      $('#form-upload').get(0).reset();

                      <?php if (isset($page_data['id'])) : ?>
                       location.reload();
                      <?php endif; ?>
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