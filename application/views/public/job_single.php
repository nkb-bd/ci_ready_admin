<!--Main Start-->
<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
   <div class="">
      <!-- User Listing Start-->
      <div class="container">
         <div class="row">
            <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 float-left">
                  <div class="wt-proposalholder wt-userlistingholdvtwo">
                     <div class="wt-proposalhead">
                        <?php if (!empty($msg)): ?>
                        <div class="alert alert-success alert-dismissible">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <?php echo 	$msg ?>
                        </div>
                        <?php endif ?>
                        <!-- system msg -->
                        <?php // System messages ?>
                        <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert animated  fadeIn alert-success alert-dismissable text-center">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <?php echo $this->session->flashdata('message'); ?>
                        </div>
                        <?php elseif ($this->session->flashdata('error')) : ?>
                        <div class="alert animated  fadeIn animated shake alert-danger text-center alert-dismissable">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                           <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>
                        <h2>
                           <?php echo 	$project_data['title'] ?>
                        </h2>
                        <ul class="wt-userlisting-breadcrumb">
                           <li>
                              <span><i class="fa fa-gbp  text-primary"></i> 
                              Budget : <?php echo 	$project_data['budget'] ?>
                              </span>
                           </li>
                           <li>	<span><i class="fa fa-map-marker wt-viewjobclock"></i> 
                              Location :  <?php echo 	$project_data['location'] ?></span>
                           </li>
                           <li>
                              <span><i class="fa fa-tag wt-viewjobdollar"></i> 
                              Category : 
                              <?php echo 	$project_data['cat_name'] ?>
                              </span>
                           </li>
                           <li>
                              <span><i class="fa fa-dot-circle wt-viewjobtag"></i> 
                              Sub Category : 
                              <?php echo 	$project_data['sub_cat_name'] ?>
                              </span>
                           </li>
                           <li>
                              <span>
                              <i class="far fa-clock text-info"></i> 
                              Posted: 
                              <?php echo 	my_date($project_data['created']) ?>
                              </span>
                           </li>
                        </ul>
                        <div class="echk box">
                           <br>
                           <?php
                              switch ($lead_status) {
                                  case 'add_payment':
                                  // payment method not added show alert
                              ?>
                           <small>* To contact the user you need to buy this lead	</small> <br>	
                           <button data-toggle="modal" data-target="#addPayment" class="wt-btn ">
                           Buy
                           </button>
                           <?php 
                              break;
                              case 'login_first':
                              ?>
                           <small>* To contact the user you need to buy this lead	</small> <br>	
                           <button data-toggle="modal" data-target="#loginFirst" class="wt-btn ">
                           Buy
                           </button>
                           <?php
                              break;
                                 case 'buy_lead_paypal':
                                 // payment method added
                              ?>
                           <?php 	
                              // <!-- check the  lead price is global or custom -->
                              // global
                              //from category
                              if($this->settings->lead_price==='custom'){
                              
                              		$price = $project_data['price'];
                              
                              }elseif($this->settings->lead_price==='global'){ 
                              
                              		$price = $this->settings->global_lead_price;
                              
                              } ?>
                           <a  
                              data-toggle="modal" 
                              data-target="#byModal" 
                              data-myvalue="<?php echo 	$price ?>" 
                              data-bb="<?php echo 	$project_data['title'] ?>"
                              data-link="<?php echo 	$project_data['project_slug'] ?>"
                              class="wt-btn pointer  block text-white">Buy
                           </a>
                           <br>	
                           <small>* After buying this lead you can contact the user who posted this lead.</small>
                           <?php break; } ?>
                        </div>
                     </div>
                  </div>
               </div>
				


					
                
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">


                  <div class="wt-projectdetail-holder wt-userlistingholdvtwo">
                     <div class="wt-projectdetail">
                        <div class="wt-title">
                           <span class="btn btn-success btn-sm">	
                           <?php 	
                              if($this->settings->lead_price==='custom'){
                              
                                $price = $project_data['price'];
                              
                              }elseif($this->settings->lead_price==='global'){ 
                              
                                $price = $this->settings->global_lead_price;
                              
                              } 
                              ?>
                           Lead Price  <?php echo 	get_currency() ?>
                           <?php echo 	$price ?>
                           </span>	
                        </div>
                        <br>
                        <br>	
                        <div class="wt-title">	
                        </div>
                        <div class="wt-description">
                           <img style="max-width: 100%" class="img-rounded" src="<?php echo 	base_url() ?><?php echo 	$project_data['file_path'] ?>" alt="">
                           <br>
                           <br>
                           <small>	<u>	 Lead Detail</u></small>
                           <?php echo 	$project_data['details'] ?>
                        </div>
                     </div>
                  </div>
               </div>

               
               <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                  <!-- share -->
                        <div class="wt-widget wt-sharejob wt-userlistingholdvtwo">
                           <div class="wt-widgettitle">
                              <h2>Share This Lead</h2>
                           </div>
                           <div class="wt-widgetcontent">
                              <ul class="wt-socialiconssimple">
                                 <?php $this->load->view('inc/socail_share') ?>
                              </ul>
                           </div>
                        </div>
               </div>

               <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                  <aside id="wt-sidebar" class="wt-sidebar">
                     <div class="wt-proposalsr_x">
                        <?php switch ($lead_status) {
                           case 'my_lead':
                           ?>
                        <p>My Lead</p>
                        <?php
                           break;
                              case 'purchased_lead':
                           ?>
                        <div class="wt-proposalsrcontent wt-userlistingholdvtwo">
                           <figure class="wt-userimg">
                           </figure>
                           <div class="wt-title">
                              <?php if (!empty($project_data['profile_img'])): ?>
                              <img style="max-width: 200px;" src="<?php echo base_url() ?>uploads/profile/<?php echo $project_data['profile_img'] ?>" alt="image description">
                              <?php endif ?>
                              <?php if (empty($project_data['profile_img'])): ?>
                              <img style="max-width: 200px;" src="<?php echo base_url() ?>uploads/profile/user.jpg" alt="image description">
                              <?php endif ?>
                           </div>
                           <div class="wt-title">
                              <small>Posted by</small>
                              <h4>
                                 <?php echo 	$project_data['first_name'].' '.$project_data['last_name'] ?>
                              </h4>
                              <p>
                                 <?php echo 	$project_data['seller_email'] ?> <br>
                              </p>
                              <small> Seller Joined : <?php echo my_date($project_data['seller_joined']) 	 ?></small>
                           </div>
                           <div class="wt-title">
                              <?php if (($this->user['id'])!=$project_data['posted_by']): ?>
                              <div class="wt-btnarea">
                                 <a style="min-width: 200px;" href="javascrip:void(0);" data-toggle="modal" data-target="#myModal" class="wt-btn">Send Message</a>
                              </div>
                              <button style="background: #17a2b8;min-width: 200px;margin-top: 10px;" data-toggle="modal" data-target="#emailModal" class="wt-btn ">Send Email</button>
                              <?php elseif (($this->user['id'])==$project_data['posted_by']): ?>
                              <div class="wt-btnarea"><button disabled class="wt-btn">Your Lead</button></div>
                              <?php endif ?>
                           </div>
                        </div>
                        
                        <?php break; } ?>
                     </div>
                  </aside>
               </div>
            </div>
         </div>
      </div>
      <!-- User Listing End-->
   </div>
</main>
<!--Main End-->
<!-- MSg Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Message</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <?php echo form_open('chat/send_msg_stat'); ?>
            <div class="form-group">
               <textarea name="message" maxlength="200" class="form-control"></textarea>
               <input type="hidden" value="<?php echo $project_data['id'] ?>" name="project_id">
            </div>
            <div class="from-group">
               <button class="btn btn-info" type="submit" >Send</button>
            </div>
            <?php echo form_close(); ?>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- Email -->
<div id="emailModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Send Email </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <?php echo form_open('chat/email'); ?>
            <div class="form-group">
               <textarea name="message" maxlength="200" class="form-control"></textarea>
               <input type="hidden" value="<?php echo $project_data['title'] ?>" name="project_name">
               <input type="hidden" value="<?php echo $project_data['seller_email'] ?>" name="seller_email">
               <input type="hidden" value="<?php echo $project_data['project_slug'] ?>" name="project_slug">
            </div>
            <div class="from-group">
               <button class="btn btn-info" type="submit" >Send</button>
            </div>
            <?php echo form_close(); ?>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- ad paymet -->
<div class="modal fade" id="addPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Payment method</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            Please add your payment method first ! 
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="byModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Buy Lead</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            Are you sure want to buy 
            <strong> <span id="modal-myvar"></span> <span id="modal-bb"></span></strong> ?<br>
            After buying this lead you can contact with the seller. <br>
            Lead Cost  <?= get_currency() ?> <span id="modal-myvalue"></span>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a id="buy-lead" href=""  class="btn btn-info">Buy</a>
         </div>
      </div>
   </div>
</div>
<script src="<?=base_url()?>assets/themes/default/js/popper.min.js"></script>									
<script>
   $(document).ready(function(){
     $('[data-toggle="popover"]').popover(); 
   
     // data-* attributes to scan when populating modal values
   	var ATTRIBUTES = ['myvalue', 'myvar', 'bb','link'];
   
   	$('[data-toggle="modal"]').on('click', function (e) {
   	  // convert target (e.g. the button) to jquery object
   	  var $target = $(e.target);
   	  // modal targeted by the button
   
   	  var myvalue = $(this).data('myvalue')
   	  console.log();
   	  var modalSelector = $target.data('target');
   
   	  var link = $(this).data('link');
   	  
   	  $("#buy-lead").attr("href", "<?php echo 	base_url() ?>lead/lead_buy/"+link+"/"+myvalue);
   	  // iterate over each possible data-* attribute
   	  ATTRIBUTES.forEach(function (attributeName) {
   	    // retrieve the dom element corresponding to current attribute
   	    var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
   	    var dataValue = $target.data(attributeName);
   	    
   	    // if the attribute value is empty, $target.data() will return undefined.
   	    // In JS boolean expressions return operands and are not coerced into
   	    // booleans. That way is dataValue is undefined, the left part of the following
   	    // Boolean expression evaluate to false and the empty string will be returned
   	    $modalAttribute.text(dataValue || '');
   	  });
   	});
   });
</script>