<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- main body -->
<div class="row ">
   <div class="col-sm-12">
      <div class="card text-white card-info">
         <div class="card-header">
            Welcome to dashboard;
            lang :<?php echo  $this->session->language ; ?>
         </div>
        
      </div>
   </div>
   <!-- cards -->


   <!-- bkup -->
   <div class="col-sm-6 col-md-4 ">
      <div class="card"  style="height: 260px;overflow: auto">
         <div class="card-header">
            <div class="card-header-left">
               <h5>Database</h5>
            </div>
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
            <p><a href="<?=base_url()?>admin/dashboard/backup_db" class="btn btn-inverse waves-effect waves-light">Download Backup</a></p>
         </div>
      </div>
   </div>
   <!--bkup -->

   <!-- login history -->
   <div class="col-xl-4 col-md-12">
      <div class="card latest-update-card"  style="height: 260px;overflow: auto">
         <div class="card-header">
            <h5>Recent Login </h5>
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
            <div class="latest-update-box">
               <?php if (!empty($login_logs)): ?>
               <?php foreach ($login_logs as $value):
                  if(isset($value['username'])){
                  
                  	$timestamp = $value['time'];
                  	$date = date('d-M-Y h:i', $timestamp); 
                  ?>
               <div class="row p-t-20 p-b-30">
                  <div class="col-auto text-right update-meta p-r-0">
                     <i class="feather icon-zap f-w-600 bg-c-blue update-icon"></i>
                  </div>
                  <div class="col p-l-5">
                     <a href="<?php echo base_url() ?>admin/users/edit/<?php echo $value['id'] ?>">
                        <h6><?php echo $value['username'] ?></h6>
                     </a>
                     <p>Name : <?php echo $value['first_name']. '  '.$value['last_name'] ?> </p>
                     <p>Email : <?php echo $value['email'] ?> </p>
                     <p>Time : <?php echo $date; ?></p>
                     <!-- <p class="text-muted m-b-0"><?php print_r($value) ?></p> -->
                  </div>
               </div>
               <?php } endforeach ?>
               <?php endif ?>
            </div>
         </div>
      </div>
   </div>
   <!--login history -->
   <!-- login history -->
   <div class="col-xl-4 col-md-12">
      <div class="card latest-update-card" style="min-height:260px ;max-height: 260px;  overflow: auto">
         <div class="card-header">
            <h5>Failed Login Attempsts </h5>
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
            <div class="latest-update-box">
               <?php if (!empty($login_attempts)): ?>
               <?php foreach ($login_attempts as $value):
                  if(isset($value['ip'])){
                  
                  	$date = strtotime($value['attempt'])
                  ?>
               <div class="row p-t-20 p-b-30">
                  <div class="col-auto text-right update-meta p-r-0">
                     <i class="feather icon-alert-circle f-w-600 bg-c-red update-icon"></i>
                  </div>
                  <div class="col p-l-5">
                     <h6>
                        IP : 
                        <?php if ($value['ip']=='::1'): ?>
                        localhost
                        <?php endif ?><?php echo $value['ip'] ?>
                     </h6>
                     <p>Time : <?php echo date('d-M-y',$date) ; ?></p>
                     <!-- <p class="text-muted m-b-0"><?php print_r($value) ?></p> -->
                  </div>
               </div>
               <?php } endforeach ?>
               <?php endif ?>
            </div>
         </div>
      </div>
   </div>
   <!--login history -->
</div>
