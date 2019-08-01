<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- daterange picker -->

<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/themes/admin/vendor/daterange/daterangepicker.css">


<!-- main body -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card sale-card">
            <div class="card-header">
                <h5>
                   
                   Demo forms
                 
                    
                </h5>

                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="feather icon-trash close-card"></i></li>
                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                    </ul>
                </div>
            </div>

            <div class="card-block">

                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                        <label for="username" class="control-label">Label</label>
                      
                    </div>

                    <div class="col-md-8">
                          <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($user['name']) ? $user['name'] : '')), 'class'=>'form-control')); ?>
                    </div>

                </div>
                
                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                       <label class="control-label">Date range button:</label>
                    </div>

                    <div class="col-md-8">
                         <div class="input-group">
                            <button type="button" class="btn btn-primary float-right" id="daterange-btn">
                              <i class="far fa-calendar-alt"></i> Select Date range 
                              <i class="fas fa-caret-down"></i>
                            </button>
                          </div>
                    </div>

                </div>

                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                       <label class="control-label">Date range :</label>
                    </div>

                    <div class="col-md-8">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation">
                          </div>
                    </div>

                </div>

                <div class="row">
                    <?php // name = name ?>
                    <div class="form-group col-md-3 <?php echo form_error('name') ? ' has-error' : ''; ?>">

                       <label class="control-label">Editor</label>
                    </div>

                    <div class="col-md-8">

                          <textarea name="editor1" id="editor1"  rows="10" cols="80">
                              This is my textarea to be replaced with CKEditor.
                          </textarea>

                    </div>

                </div>



            </div>
        </div>
    </div>

    
</div>

<script type="" src="<?php echo     admin_assets('vendor/daterange/moment.min.js') ?>"></script>
<script type="" src="<?php echo     admin_assets('vendor/daterange/daterangepicker.js') ?>"></script>
<script type="" src="<?php echo     admin_assets('vendor/ckeditor/ckeditor.js') ?>"></script>
<script type="">
    
    ClassicEditor
        .create( document.querySelector( '#editor1' ) , {
              height: 300
        })
        .catch( error => {
            console.error( error );
        } );
    
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
     //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
</script>